<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // ===============================
    // LIST PRODUCTS (ADMIN)
    // ===============================
    public function index(Request $request)
    {
        $query = Product::query();

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filter kategori — pakai kolom 'category' (string), bukan category_id
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Sort
        switch ($request->get('sort', 'latest')) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();

        // ===============================
        // STATISTIK ADMIN
        // ===============================
        $totalProducts  = Product::count();
        $activeProducts = Product::where('stock', '>', 0)->count();
        $totalValue     = Product::sum(DB::raw('price * stock'));

        return view('admin.products.index', compact(
            'products',
            'totalProducts',
            'activeProducts',
            'totalValue'
        ));
    }

    // ===============================
    // CREATE
    // ===============================
    public function create()
    {
        return view('admin.products.create');
    }

    // ===============================
    // STORE
    // ===============================
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    // ===============================
    // EDIT
    // ===============================
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // ===============================
    // UPDATE
    // ===============================
    public function update(StoreProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diupdate!');
    }

    // ===============================
    // DELETE
    // ===============================
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}