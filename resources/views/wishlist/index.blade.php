<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ❤️ {{ __('My Wishlist') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
                    <p class="font-medium">{{ session('error') }}</p>
                </div>
            @endif

            @if(session('info'))
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-lg mb-6">
                    <p class="font-medium">{{ session('info') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-pink-600 to-rose-600 px-6 py-4">
                    <h3 class="text-xl font-bold text-white">Saved Items ({{ $wishlistItems->count() }})</h3>
                </div>

                <div class="p-6">
                    @if($wishlistItems->isEmpty())
                        <!-- Empty Wishlist -->
                        <div class="text-center py-12">
                            <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
                                </svg>
                            </div>
                            <h4 class="text-2xl font-bold text-gray-800 mb-2">Your Wishlist is Empty</h4>
                            <p class="text-gray-600 mb-6">Save your favorite products to buy them later!</p>
                            <a href="{{ route('shop.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-pink-600 to-rose-600 text-white font-bold rounded-lg shadow-lg hover:shadow-xl hover:scale-105 transition-all">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Browse Products
                            </a>
                        </div>
                    @else
                        <!-- Wishlist Items Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            @foreach($wishlistItems as $item)
                                <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                                    <div class="relative">
                                        <!-- Product Image -->
                                        <a href="{{ route('shop.show', $item->product->id) }}">
                                            <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : asset('images/no-image.png') }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                                        </a>
                                        
                                        <!-- Remove from Wishlist Button -->
                                        <form action="{{ route('wishlist.remove', $item->product->id) }}" method="POST" class="absolute top-2 right-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2 bg-white rounded-full shadow-lg hover:bg-red-50 transition"
                                                    onclick="return confirm('Remove from wishlist?')">
                                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
                                                </svg>
                                            </button>
                                        </form>

                                        <!-- Stock Badge -->
                                        @if($item->product->stock <= 0)
                                            <div class="absolute top-2 left-2 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                                                Out of Stock
                                            </div>
                                        @elseif($item->product->stock < 5)
                                            <div class="absolute top-2 left-2 bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                                                Only {{ $item->product->stock }} left
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="p-4">
                                        <a href="{{ route('shop.show', $item->product->id) }}" class="block">
                                            <h4 class="font-bold text-lg mb-2 hover:text-purple-600 transition">
                                                {{ Str::limit($item->product->name, 30) }}
                                            </h4>
                                        </a>
                                        
                                        <p class="text-gray-600 text-sm mb-2">{{ $item->product->category->name ?? 'Uncategorized' }}</p>
                                        
                                        <p class="text-purple-600 font-bold mb-3">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                        
                                        <!-- Add to Cart Button -->
                                        @if($item->product->stock > 0)
                                            <form action="{{ route('cart.add', $item->product->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded-lg font-semibold hover:bg-purple-700 transition">
                                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                    </svg>
                                                    Add to Cart
                                                </button>
                                            </form>
                                        @else
                                            <button disabled class="w-full bg-gray-300 text-gray-600 py-2 rounded-lg font-semibold cursor-not-allowed">
                                                Out of Stock
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-user-layout>