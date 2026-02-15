<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart;

        $cartItems = $cart
            ? $cart->items()->with('product')->get()
            : collect();

        $subtotal = $cartItems->sum(fn ($i) => $i->price * $i->quantity);
        $tax = $subtotal * 0.11;
        $total = $subtotal + $tax;

        return view('cart.index', compact(
            'cartItems',
            'subtotal',
            'tax',
            'total'
        ));
    }

    /**
     * ADD PRODUCT FROM SHOP
     * Support both AJAX and regular form submission
     */
    public function add(Request $request, Product $product)
    {
        $user = auth()->user();
        $cart = $user->cart()->firstOrCreate([]);

        $quantity = $request->input('quantity', 1);

        $item = $cart->items()->where('product_id', $product->id)->first();

        if ($item) {
            $item->increment('quantity', $quantity);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'price' => $product->price,
                'quantity' => $quantity,
            ]);
        }

        $cartCount = $cart->items()->sum('quantity');

        // Check if request is AJAX
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Added to cart',
                'cart_count' => $cartCount,
            ]);
        }

        // Regular form submission - redirect back
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    /**
     * UPDATE QTY FROM CART (with AJAX support for +/- buttons)
     */
    public function update(Request $request, $cartItemId)
    {
        $cart = auth()->user()->cart;
        
        if (!$cart) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart not found'
                ], 404);
            }
            return back()->with('error', 'Cart not found');
        }

        $item = $cart->items()->findOrFail($cartItemId);
        
        $newQuantity = max(1, $request->quantity);
        
        // Check stock
        if ($newQuantity > $item->product->stock) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Not enough stock. Only ' . $item->product->stock . ' available.'
                ], 400);
            }
            return back()->with('error', 'Not enough stock available');
        }

        $item->update(['quantity' => $newQuantity]);

        // Calculate new totals for AJAX response
        if ($request->ajax()) {
            $cartItems = $cart->items()->with('product')->get();
            $subtotal = $cartItems->sum(fn ($i) => $i->price * $i->quantity);
            $tax = $subtotal * 0.11;
            $total = $subtotal + $tax;

            return response()->json([
                'success' => true,
                'message' => 'Cart updated',
                'item_subtotal' => $item->price * $item->quantity,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total
            ]);
        }

        return back()->with('success', 'Cart updated');
    }

    /**
     * REMOVE SINGLE ITEM
     */
    public function remove($cartItemId)
    {
        auth()->user()
            ->cart
            ->items()
            ->where('id', $cartItemId)
            ->delete();

        return back()->with('success', 'Item removed');
    }

    /**
     * CLEAR CART
     */
    public function clear()
    {
        $cart = auth()->user()->cart;
        
        if ($cart) {
            $cart->items()->delete();
        }

        return back()->with('success', 'Cart cleared');
    }

    /**
     * CHECKOUT - Create Order
     */
    public function checkout(Request $request)
    {
        $user = auth()->user();
        $cart = $user->cart;

        if (!$cart || $cart->items()->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $request->validate([
            'notes' => 'nullable|string|max:1000'
        ]);

        DB::beginTransaction();
        try {
            $cartItems = $cart->items()->with('product')->get();

            // Calculate total
            $subtotal = $cartItems->sum(fn ($i) => $i->price * $i->quantity);
            $tax = $subtotal * 0.11;
            $total = $subtotal + $tax;

            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'total' => $total,
                'status' => 'pending',
                'payment_method' => null,
                'notes' => $request->notes
            ]);

            // Create order items and reduce stock
            foreach ($cartItems as $cartItem) {
                // Check stock
                if ($cartItem->quantity > $cartItem->product->stock) {
                    throw new \Exception("Not enough stock for {$cartItem->product->name}");
                }

                // Create order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price
                ]);

                // Reduce product stock
                $cartItem->product->decrement('stock', $cartItem->quantity);
            }

            // Clear cart
            $cart->items()->delete();

            DB::commit();

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }
}