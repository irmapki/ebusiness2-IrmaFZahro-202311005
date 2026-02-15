<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🛒 {{ __('My Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- FLASH MESSAGE --}}
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- CART ITEMS --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">

                        <div class="bg-gradient-to-r from-purple-600 to-indigo-600 px-6 py-4">
                            <h3 class="text-xl font-bold text-white">
                                Cart Items ({{ $cartItems->count() }})
                            </h3>
                        </div>

                        <div class="p-6">
                            @if($cartItems->isEmpty())
                                <div class="text-center py-12">
                                    <p class="text-gray-600 text-lg mb-4">Your cart is empty</p>
                                    <a href="{{ route('shop.index') }}"
                                       class="inline-block bg-purple-600 text-white px-6 py-3 rounded-lg">
                                        Continue Shopping
                                    </a>
                                </div>
                            @else
                                <div class="space-y-4">
                                    @foreach($cartItems as $item)
                                        <div class="flex items-center gap-4 border p-4 rounded-lg">

                                            {{-- IMAGE --}}
                                            <img src="{{ $item->product->image
                                                ? asset('storage/'.$item->product->image)
                                                : asset('images/no-image.png') }}"
                                                 class="w-24 h-24 object-cover rounded">

                                            {{-- INFO --}}
                                            <div class="flex-1">
                                                <h4 class="font-bold">{{ $item->product->name }}</h4>
                                                <p class="text-sm text-gray-500">
                                                    {{ $item->product->category->name ?? 'Uncategorized' }}
                                                </p>
                                                <p class="font-bold text-purple-600">
                                                    Rp {{ number_format($item->price,0,',','.') }}
                                                </p>
                                            </div>

                                            {{-- QTY CONTROLS --}}
                                            <div class="flex items-center gap-2">

                                                {{-- MINUS --}}
                                                <form method="POST" action="{{ route('cart.update', $item->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                                                    <button class="px-3 py-1 bg-gray-200 rounded">-</button>
                                                </form>

                                                <span class="font-bold">{{ $item->quantity }}</span>

                                                {{-- PLUS --}}
                                                <form method="POST" action="{{ route('cart.update', $item->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                                    <button class="px-3 py-1 bg-gray-200 rounded"
                                                        {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>
                                                        +
                                                    </button>
                                                </form>
                                            </div>

                                            {{-- SUBTOTAL --}}
                                            <div class="text-right">
                                                <p class="text-sm text-gray-500">Subtotal</p>
                                                <p class="font-bold">
                                                    Rp {{ number_format($item->price * $item->quantity,0,',','.') }}
                                                </p>
                                            </div>

                                            {{-- REMOVE --}}
                                            <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-600">🗑</button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- CLEAR CART --}}
                                <div class="mt-6 text-right">
                                    <form method="POST" action="{{ route('cart.clear') }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 font-semibold">
                                            Clear Cart
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ORDER SUMMARY --}}
                <div>
                    <div class="bg-white rounded-xl shadow p-6 sticky top-6">
                        <h3 class="font-bold text-lg mb-4">Order Summary</h3>

                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($subtotal,0,',','.') }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Tax </span>
                            <span>Rp {{ number_format($tax,0,',','.') }}</span>
                        </div>

                        <hr class="my-3">

                        <div class="flex justify-between font-bold text-purple-600">
                            <span>Total</span>
                            <span>
                                Rp {{ number_format($total,0,',','.') }}
                            </span>
                        </div>

                        <a href="{{ route('checkout.index') }}"
                           class="block mt-4 text-center bg-purple-600 text-white py-3 rounded-lg">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-user-layout>
