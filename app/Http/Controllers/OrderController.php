<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display user's order history
     */
    public function index()
    {
        $orders = auth()->user()
            ->orders()
            ->with('items.product')
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Show single order detail
     */
    public function show(Order $order)
    {
        // Make sure user can only see their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $order->load('items.product');

        return view('orders.show', compact('order'));
    }

    /**
     * Print invoice
     */
    public function print(Order $order)
    {
        // Make sure user can only print their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $order->load('items.product');

        return view('orders.print', compact('order'));
    }

    /**
     * Cancel order (only if status is pending)
     */
    public function cancel(Order $order)
    {
        // 🔐 Pastikan milik user
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // ❌ Tidak bisa cancel selain pending
        if ($order->status !== 'pending') {
            return back()->with('error', 'Order tidak bisa dibatalkan');
        }

        DB::beginTransaction();

        try {
            // 🔄 Balikin stok
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }

            // ❌ Update status
            $order->update([
                'status' => 'cancelled'
            ]);

            DB::commit();

            return redirect()
                ->route('orders.index')
                ->with('success', 'Order berhasil dibatalkan');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal cancel order');
        }
    }

    /**
     * ✅ BARU: Confirm delivery - Customer terima paket
     */
    public function confirmDelivery(Order $order)
    {
        // 🔐 Pastikan milik user yang login
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // ✅ Hanya bisa confirm kalau status = shipped
        if ($order->status !== 'shipped') {
            return back()->with('error', 'Order belum dikirim atau sudah dikonfirmasi');
        }

        DB::beginTransaction();

        try {
            // ✅ Update status jadi completed + paid
            $order->update([
                'status' => 'completed',
                'payment_status' => 'paid',
                'received_at' => now()
            ]);

            DB::commit();

            return redirect()
                ->route('orders.index')
                ->with('success', '✅ Terima kasih! Pesanan telah dikonfirmasi dan pembayaran berhasil.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal konfirmasi pesanan');
        }
    }
}