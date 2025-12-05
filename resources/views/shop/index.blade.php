<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Header Section -->
            <div class="mb-8">
                <h3 class="text-3xl font-bold text-gray-800 mb-2">Explore Our Products</h3>
                <p class="text-gray-600">Discover amazing products at great prices!</p>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                        <!-- Product Image -->
                        <div class="relative h-64 bg-gray-200">
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Stock Badge -->
                            @if($product->stock < 10)
                                <div class="absolute top-2 right-2">
                                    <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                        Only {{ $product->stock }} left!
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="p-4">
                            <!-- Category -->
                            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                {{ $product->category }}
                            </span>
                            
                            <!-- Product Name -->
                            <h4 class="text-lg font-bold text-gray-800 mt-1 mb-2 line-clamp-2">
                                {{ $product->name }}
                            </h4>
                            
                            <!-- Description -->
                            <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                {{ $product->description ?? 'No description available.' }}
                            </p>
                            
                            <!-- Price & Stock -->
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <span class="text-2xl font-bold text-blue-600">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs text-gray-500">Stock:</span>
                                    <span class="text-sm font-semibold text-gray-700">{{ $product->stock }}</span>
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex gap-2">
                                <a href="{{ route('shop.show', $product) }}" 
                                   class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center px-4 py-2 rounded-lg font-semibold transition duration-200">
                                    View Details
                                </a>
                                <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-semibold transition duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">No Products Available</h3>
                            <p class="text-gray-600">Check back later for new products!</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>

        </div>
    </div>
</x-app-layout>