<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart;

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Cart kosong!');
        }

        $cartItems = $cart->items()->with('product')->get();
        $subtotal  = $cart->totalAmount();
        $adminFee = 2000;
        $tax = 0;
        $total = $subtotal + $adminFee;

        return view('checkout.index', compact(
            'cartItems',
            'subtotal',
            'adminFee',
            'tax',
            'total'
        ));
    }

    public function process(Request $request)
    {
        // ✅ SESUAI FORM
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'payment_method' => 'required',
        ]);

        $cart = auth()->user()->cart;

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Cart kosong!');
        }

        DB::beginTransaction();

        try {
            $subtotal = $cart->totalAmount();
            $adminFee = 2000;
            $tax = 0;
            $total = $subtotal + $adminFee;

            // ✅ SESUAI STRUKTUR TABEL orders
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . time() . rand(1000, 9999),
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping_cost' => $adminFee,
                'total' => $total, // ✅ FIX: total_amount bukan total
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'payment_method' => $request->payment_method,
                'phone' => $request->phone,
                'shipping_address' => $request->address,
                'shipping_city' => $request->city,
                'shipping_postal_code' => $request->postal_code,
                'shipping_name' => $request->name, // ✅ TAMBAHIN NAME
                'shipping_email' => $request->email, // ✅ TAMBAHIN EMAIL
                'shipping_phone' => $request->phone,
                'notes' => $request->notes,
            ]);

            // ✅ Create order items dari cart items
            foreach ($cart->items as $item) {
                // Check stock dulu
                if ($item->product->stock < $item->quantity) {
                    throw new \Exception('Stock ' . $item->product->name . ' tidak cukup');
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);

                // Kurangi stock
                $item->product->decrement('stock', $item->quantity);
            }

            // Clear cart
            $cart->items()->delete();

            DB::commit();

            return redirect()->route('orders.show', $order)
                ->with('success', '✅ Order berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membuat order: ' . $e->getMessage());
        }
    }
}