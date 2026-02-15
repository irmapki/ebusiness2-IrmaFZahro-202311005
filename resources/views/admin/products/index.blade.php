<x-admin-layout>
    <x-slot name="header">
        Manajemen Produk
    </x-slot>

    <!-- Header Section -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">ShowMy</h2>
                <p class="text-gray-600 text-sm mt-1">Kelola semua produk Anda dengan mudah</p>
            </div>
            <a href="{{ route('admin.products.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Produk
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl shadow-md" role="alert">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold uppercase">Total Produk</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalProducts }}</p>
                </div>
                <div class="p-4 bg-blue-100 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold uppercase">Produk Aktif</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $activeProducts }}</p>
                </div>
                <div class="p-4 bg-green-100 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-amber-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold uppercase">Total Nilai</p>
                    <p class="text-2xl font-bold text-gray-800 mt-2">Rp {{ number_format($totalValue, 0, ',', '.') }}</p>
                </div>
                <div class="p-4 bg-amber-100 rounded-full">
                    <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Search, Filter Kategori & Sort -->
    <form action="{{ route('admin.products.index') }}" method="GET" class="bg-white rounded-xl shadow-md p-5 mb-6">
        <div class="flex flex-col md:flex-row md:items-center gap-3">

            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari produk..."
                           class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all">
                </div>
            </div>

            <!-- Filter Kategori -->
            <select name="category"
                    class="px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all">
                <option value="">📂 Semua Kategori</option>
                <option value="Electronics" {{ request('category') == 'Electronics' ? 'selected' : '' }}>📱 Electronics</option>
                <option value="Fashion" {{ request('category') == 'Fashion' ? 'selected' : '' }}>👔 Fashion</option>
                <option value="Food & Beverage" {{ request('category') == 'Food & Beverage' ? 'selected' : '' }}>🍔 Food & Beverage</option>
                <option value="Books" {{ request('category') == 'Books' ? 'selected' : '' }}>📚 Books</option>
                <option value="Sports" {{ request('category') == 'Sports' ? 'selected' : '' }}>⚽ Sports</option>
                <option value="Toys" {{ request('category') == 'Toys' ? 'selected' : '' }}>🧸 Toys</option>
                <option value="Other" {{ request('category') == 'Other' ? 'selected' : '' }}>📦 Other</option>
            </select>

            <!-- Sort -->
            <select name="sort"
                    class="px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all">
                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>🕐 Terbaru</option>
                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>🔤 Nama A-Z</option>
                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>💰 Harga Termurah</option>
                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>💰 Harga Termahal</option>
            </select>

            <!-- Buttons -->
            <div class="flex gap-2">
                <button type="submit"
                        class="px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all">
                    Filter
                </button>

                @if(request('search') || request('category') || request('sort'))
                    <a href="{{ route('admin.products.index') }}"
                       class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 rounded-xl transition-all flex items-center text-gray-600 font-semibold">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Reset
                    </a>
                @endif
            </div>
        </div>
    </form>

    <!-- Products List -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
            @forelse ($products as $product)
                <div class="bg-white border border-gray-200 rounded-xl p-5 mb-4 hover:shadow-lg hover:border-indigo-300 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-5 flex-1">
                            <!-- Image -->
                            <div class="flex-shrink-0">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="h-20 w-20 object-cover rounded-xl shadow-md">
                                @else
                                    <div class="h-20 w-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Info -->
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <h3 class="text-lg font-bold text-gray-900">{{ $product->name }}</h3>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $product->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $product->is_active ? '✓ Aktif' : '⊗ Nonaktif' }}
                                    </span>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-700">
                                        {{ $product->category }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 mb-2">{{ $product->description ?: 'Tidak ada deskripsi' }}</p>
                                <div class="flex items-center space-x-6 text-sm">
                                    <div class="flex items-center text-indigo-600 font-semibold">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </div>
                                    <div class="flex items-center {{ $product->stock > 10 ? 'text-green-600' : 'text-red-600' }} font-medium">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                        Stok: {{ $product->stock }} unit
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center space-x-2 ml-4">
                            <a href="{{ route('admin.products.edit', $product) }}" 
                               class="p-2.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                               title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            <a href="{{ route('admin.products.edit', $product) }}" 
                               class="p-2.5 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors"
                               title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="p-2.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                        title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-16">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-100 mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada produk</h3>
                    <p class="text-gray-600 mb-6">Mulai tambahkan produk pertama Anda sekarang!</p>
                    <a href="{{ route('admin.products.create') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Produk Pertama
                    </a>
                </div>
            @endforelse

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>