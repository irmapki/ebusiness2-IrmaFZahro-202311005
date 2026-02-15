<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = auth()->user()
            ->wishlist()
            ->with('product')
            ->get();

        return view('wishlist.index', compact('wishlistItems'));
    }

    public function add(Request $request, Product $product)
    {
        $user = auth()->user();

        $exists = $user->wishlist()
            ->where('product_id', $product->id)
            ->exists();

        if ($exists) {
            // 🔥 AJAX RESPONSE
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Already in wishlist',
                ], 409);
            }

            return back()->with('error', 'Product already in wishlist!');
        }

        $user->wishlist()->create([
            'product_id' => $product->id,
        ]);

        $count = $user->wishlist()->count();

        // 🔥 AJAX RESPONSE
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Added to wishlist',
                'wishlist_count' => $count,
            ]);
        }

        // fallback kalau JS mati
        return back()->with('success', 'Product added to wishlist!');
    }

    public function remove(Product $product)
    {
        auth()->user()
            ->wishlist()
            ->where('product_id', $product->id)
            ->delete();

        return back()->with('success', 'Product removed from wishlist!');
    }
}
