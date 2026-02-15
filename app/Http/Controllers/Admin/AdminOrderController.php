<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    /**
     * Display all orders (Admin)
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items.product']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by order ID or customer name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $orders = $query->latest()->paginate(15);

        // Statistics - FIX: Ganti 'total_amount' dengan 'total'
        $stats = [
            'total' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
            'total_revenue' => Order::whereIn('status', ['completed', 'processing', 'shipped'])->sum('total'), // GANTI 'total_amount' jadi 'total'
        ];

        return view('admin.orders.index', compact('orders', 'stats'));
    }

    /**
     * Show order detail (Admin)
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled'
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        DB::beginTransaction();

        try {
            // If cancelling order, return stock
            if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
                foreach ($order->items as $item) {
                    $item->product->increment('stock', $item->quantity);
                }
            }

            // If un-cancelling order, reduce stock again
            if ($oldStatus === 'cancelled' && $newStatus !== 'cancelled') {
                foreach ($order->items as $item) {
                    if ($item->product->stock < $item->quantity) {
                        DB::rollBack();
                        return back()->with('error', 'Stok produk tidak mencukupi untuk mengubah status');
                    }
                    $item->product->decrement('stock', $item->quantity);
                }
            }

            $order->update([
                'status' => $newStatus
            ]);

            DB::commit();

            return back()->with('success', 'Status order berhasil diupdate!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal update status: ' . $e->getMessage());
        }
    }

    /**
     * Print invoice (Admin)
     */
    public function print(Order $order)
    {
        $order->load(['user', 'items.product']);
        
        return view('admin.orders.print', compact('order'));
    }

    /**
     * Delete order (Admin only)
     */
    public function destroy(Order $order)
    {
        DB::beginTransaction();

        try {
            // Return stock if order is not completed or cancelled
            if (!in_array($order->status, ['completed', 'cancelled'])) {
                foreach ($order->items as $item) {
                    $item->product->increment('stock', $item->quantity);
                }
            }

            $order->delete();

            DB::commit();

            return redirect()
                ->route('admin.orders.index')
                ->with('success', 'Order berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus order');
        }
    }
}