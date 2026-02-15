<x-user-layout>
    <div class="p-8">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-xl p-8 mb-8 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-2">Order Details</h1>
                    <p class="text-blue-100">{{ $order->order_number }}</p>
                </div>
                <a href="{{ route('orders.index') }}" 
                   class="bg-white text-blue-600 px-6 py-3 rounded-xl font-semibold hover:bg-blue-50 transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Orders
                </a>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Order Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Status -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Order Status
                    </h2>
                    <div class="flex items-center gap-4">
                        @if($order->status === 'pending')
                            <span class="bg-yellow-100 text-yellow-800 px-6 py-3 rounded-xl text-lg font-bold">
                                ⏳ Pending
                            </span>
                            <p class="text-gray-600">Your order is waiting for confirmation</p>
                        @elseif($order->status === 'processing')
                            <span class="bg-blue-100 text-blue-800 px-6 py-3 rounded-xl text-lg font-bold">
                                🔄 Processing
                            </span>
                            <p class="text-gray-600">We're preparing your order</p>
                        @elseif($order->status === 'shipped')
                            <span class="bg-purple-100 text-purple-800 px-6 py-3 rounded-xl text-lg font-bold">
                                🚚 Shipped
                            </span>
                            <p class="text-gray-600">Your order is on the way!</p>
                        @elseif($order->status === 'delivered')
                            <span class="bg-green-100 text-green-800 px-6 py-3 rounded-xl text-lg font-bold">
                                ✓ Delivered
                            </span>
                            <p class="text-gray-600">Order has been delivered successfully</p>
                        @elseif($order->status === 'cancelled')
                            <span class="bg-red-100 text-red-800 px-6 py-3 rounded-xl text-lg font-bold">
                                ✗ Cancelled
                            </span>
                            <p class="text-gray-600">This order has been cancelled</p>
                        @endif
                    </div>
                </div>

                <!-- Order Items -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        Order Items
                    </h2>
                    
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div class="flex items-center gap-4 pb-4 border-b last:border-b-0">
                                @if($item->product && $item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" 
                                         alt="{{ $item->product->name ?? 'Product' }}" 
                                         class="w-24 h-24 object-cover rounded-lg shadow-md">
                                @else
                                    <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <div class="flex-1">
                                    <h4 class="font-bold text-lg text-gray-800">
                                        {{ $item->product->name ?? 'Product Deleted' }}
                                    </h4>
                                    <p class="text-gray-600">Quantity: {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                                
                                <div class="text-right">
                                    <p class="font-bold text-xl text-gray-800">
                                        Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Shipping Information -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Shipping Information
                    </h2>
                    
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-600">Name</p>
                            <p class="font-semibold">{{ $order->shipping_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            <p class="font-semibold">{{ $order->shipping_email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Phone</p>
                            <p class="font-semibold">{{ $order->shipping_phone }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Address</p>
                            <p class="font-semibold">{{ $order->shipping_address }}</p>
                            <p class="font-semibold">{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</p>
                        </div>
                        @if($order->notes)
                            <div>
                                <p class="text-sm text-gray-600">Notes</p>
                                <p class="font-semibold">{{ $order->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-4">
                    <h2 class="text-2xl font-bold mb-4">Order Summary</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Order Number</span>
                            <span class="font-semibold">{{ $order->order_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Order Date</span>
                            <span class="font-semibold">{{ $order->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Payment Method</span>
                            <span class="font-semibold capitalize">
                                {{ str_replace('_', ' ', $order->payment_method) }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Payment Status</p>
                            @if($order->payment_status == 'paid')
                                <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                    💰 Paid
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    💵 Unpaid
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="border-t pt-4 space-y-2">
                        @php
                            $subtotal = $order->items->sum(fn($item) => $item->price * $item->quantity);
                            $tax = $subtotal * 0.11;
                        @endphp
                        
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Tax</span>
                            <span class="font-semibold">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t pt-2">
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-lg">Total</span>
                                <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 space-y-3">
                        <!-- Print Invoice Button -->
                        <a href="{{ route('orders.print', $order) }}" 
                           target="_blank"
                           class="block w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white text-center py-3 rounded-xl font-semibold transition-all shadow-md hover:shadow-lg">
                            Print Invoice
                        </a>

                        <!-- Confirm Delivery Button - Shows when status is shipped and payment is unpaid -->
                        @if($order->status == 'shipped' && $order->payment_status == 'unpaid')
                            <form method="POST" action="{{ route('orders.confirm-delivery', $order) }}" 
                                  onsubmit="return confirm('Apakah Anda sudah menerima paket ini? Setelah konfirmasi, pembayaran akan diproses.')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white py-3 rounded-xl font-semibold transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    ✅ Terima Pesanan
                                </button>
                            </form>
                        @endif

                        <!-- Cancel Order Button - Shows when status is pending -->
                        @if($order->status === 'pending')
                            <form action="{{ route('orders.cancel', $order) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to cancel this order?')">
                                @csrf
                                @method('PUT')
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white py-3 rounded-xl font-semibold transition-all shadow-md hover:shadow-lg">
                                    Cancel Order
                                </button>
                            </form>
                        @endif

                        <!-- Back to Orders Button -->
                        <a href="{{ route('orders.index') }}" 
                           class="block w-full text-center border-2 border-gray-300 text-gray-700 py-3 rounded-xl font-semibold hover:bg-gray-50 transition-all">
                            Back to Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>