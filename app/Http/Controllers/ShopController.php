<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // Halaman list semua produk untuk user
    public function index()
    {
        // Ambil hanya produk yang active
        $products = Product::where('is_active', true)
            ->latest()
            ->paginate(12);
        
        return view('shop.index', compact('products'));
    }

    // Detail produk
    public function show(Product $product)
    {
        // Cek apakah produk active
        if (!$product->is_active) {
            abort(404);
        }

        return view('shop.show', compact('product'));
    }
}