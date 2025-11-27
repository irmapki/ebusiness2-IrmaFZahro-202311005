<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{ route('products.index') }}" class="mr-4 text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Detail Produk') }}
                </h2>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Gambar Produk -->
                        <div>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-96 object-cover rounded-lg shadow-lg">
                            @else
                                <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Detail Produk -->
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                            
                            <div class="mb-6">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Harga</h3>
                                <p class="text-3xl font-bold text-indigo-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Stok Tersedia</h3>
                                <div class="flex items-center">
                                    <span class="text-2xl font-semibold text-gray-900">{{ $product->stock }}</span>
                                    <span class="ml-2 text-gray-600">unit</span>
                                    @if($product->stock <= 10)
                                        <span class="ml-3 px-2 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">Stok Terbatas</span>
                                    @endif
                                </div>
                            </div>

                            @if($product->description)
                            <div class="mb-6">
                                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Deskripsi</h3>
                                <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                            </div>
                            @endif

                            <div class="border-t pt-6">
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <p class="text-gray-500">Dibuat pada</p>
                                        <p class="font-semibold text-gray-900">{{ $product->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Terakhir diupdate</p>
                                        <p class="font-semibold text-gray-900">{{ $product->updated_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>