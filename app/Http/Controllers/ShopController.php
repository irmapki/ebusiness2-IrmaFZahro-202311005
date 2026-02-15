<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // ===============================
    // LIST PRODUCT (SHOP)
    // ===============================
    public function index(Request $request)
    {
        $query = Product::query()
            ->where('stock', '>', 0);

        // 🔍 Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 🗂 Filter kategori (PAKAI category_id)
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        // ✅ Ambil kategori untuk dropdown
        $categories = Category::orderBy('name')->get();

        return view('shop.index', compact(
            'products',
            'categories'
        ));
    }

    // ===============================
    // DETAIL PRODUCT
    // ===============================
    public function show(Product $product)
    {
        // 🔁 Related products (kategori sama)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->limit(4)
            ->get();

        return view('shop.show', compact(
            'product',
            'relatedProducts'
        ));
    }
}
