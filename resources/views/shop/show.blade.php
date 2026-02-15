<x-user-layout>
    <div class="p-8">
        <!-- Back Button & Header -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('shop.index') }}" class="p-2 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="text-3xl font-bold text-gray-800">
                {{ __('Product Details') }}
            </h2>
        </div>

        <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
                    
                    <!-- Product Image -->
                    <div>
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-96 object-cover rounded-lg shadow-md">
                        @else
                            <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                                <svg class="w-32 h-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div>
                        <!-- Category -->
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full mb-4">
                            {{ $product->category }}
                        </span>

                        <!-- Product Name -->
                        <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>

                        <!-- Price -->
                        <div class="mb-6">
                            <span class="text-4xl font-bold text-blue-600">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                        </div>

                        <!-- Stock Status -->
                        <div class="mb-6">
                            <div class="flex items-center gap-2">
                                <span class="text-gray-600">Availability:</span>
                                @if($product->stock > 0)
                                    <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full">
                                        In Stock ({{ $product->stock }} available)
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-800 text-sm font-semibold rounded-full">
                                        Out of Stock
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Description</h3>
                            <p class="text-gray-700 leading-relaxed">
                                {{ $product->description ?? 'No description available for this product.' }}
                            </p>
                        </div>

                        <!-- Quantity Selector -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Quantity</label>
                            <div class="flex items-center gap-3">
                                <button onclick="decreaseQty()" type="button" class="bg-gray-200 hover:bg-gray-300 text-gray-800 w-10 h-10 rounded-lg font-bold transition duration-200">
                                    -
                                </button>
                                <input type="number" id="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                       class="w-20 text-center border border-gray-300 rounded-lg py-2 font-semibold">
                                <button onclick="increaseQty()" type="button" class="bg-gray-200 hover:bg-gray-300 text-gray-800 w-10 h-10 rounded-lg font-bold transition duration-200">
                                    +
                                </button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            @if($product->stock > 0)
                                <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="quantity" id="cart-quantity" value="1">
                                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-bold text-lg rounded-lg transition duration-200">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <button disabled class="flex-1 bg-gray-400 text-white px-6 py-3 rounded-lg font-bold text-lg cursor-not-allowed">
                                    Out of Stock
                                </button>
                            @endif
                            
                            <form action="{{ route('wishlist.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-lg font-bold transition duration-200">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <script>
                            function increaseQty() {
                                const qtyInput = document.getElementById('quantity');
                                const cartQty = document.getElementById('cart-quantity');
                                const max = parseInt(qtyInput.max);
                                const current = parseInt(qtyInput.value);
                                if (current < max) {
                                    qtyInput.value = current + 1;
                                    cartQty.value = current + 1;
                                }
                            }

                            function decreaseQty() {
                                const qtyInput = document.getElementById('quantity');
                                const cartQty = document.getElementById('cart-quantity');
                                const current = parseInt(qtyInput.value);
                                if (current > 1) {
                                    qtyInput.value = current - 1;
                                    cartQty.value = current - 1;
                                }
                            }

                            document.getElementById('quantity').addEventListener('change', function() {
                                document.getElementById('cart-quantity').value = this.value;
                            });
                        </script>

                        <!-- Additional Info -->
                        <div class="mt-8 pt-8 border-t border-gray-200">
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-600">Product ID:</span>
                                    <span class="font-semibold text-gray-800 ml-2">#{{ $product->id }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-600">Category:</span>
                                    <span class="font-semibold text-gray-800 ml-2">{{ $product->category }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-user-layout>