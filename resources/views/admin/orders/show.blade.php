<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">Order Details</h2>
            <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                ← Back to Orders
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Order Info & Status Update -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Order Information -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Order Information</h3>
                    @if($order->status == 'pending')
                        <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Pending
                        </span>
                    @elseif($order->status == 'processing')
                        <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                            Processing
                        </span>
                    @elseif($order->status == 'shipped')
                        <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-purple-100 text-purple-800">
                            Shipped
                        </span>
                    @elseif($order->status == 'completed')
                        <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">
                            Completed
                        </span>
                    @else
                        <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-red-100 text-red-800">
                            Cancelled
                        </span>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-600">Order ID</p>
                        <p class="font-mono font-semibold text-gray-900 mt-1">{{ $order->order_number }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Order Date</p>
                        <p class="font-semibold text-gray-900 mt-1">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Payment Method</p>
                        <p class="font-semibold text-gray-900 mt-1 capitalize">{{ $order->payment_method ?? 'COD' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Total Amount</p>
                        <p class="font-bold text-indigo-600 mt-1 text-lg">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                    </div>
                </div>

                @if($order->notes)
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-gray-600 text-sm">Customer Notes</p>
                    <p class="text-gray-900 mt-1">{{ $order->notes }}</p>
                </div>
                @endif
            </div>

            <!-- Customer Information -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Customer Information</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-600">Name</p>
                        <p class="font-semibold text-gray-900 mt-1">{{ $order->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Email</p>
                        <p class="text-gray-900 mt-1">{{ $order->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Phone</p>
                        <p class="text-gray-900 mt-1">{{ $order->phone ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Shipping Address</p>
                        <p class="text-gray-900 mt-1">{{ $order->shipping_address ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Status Form -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Update Order Status</h3>
            <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="flex items-end gap-4">
                @csrf
                @method('PATCH')
                
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Change Status</label>
                    <select name="status" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            required>
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <button type="submit" 
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                    Update Status
                </button>
            </form>

            <!-- Status Flow Guide -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <p class="text-sm font-medium text-gray-700 mb-3">Status Flow:</p>
                <div class="flex items-center gap-2 text-xs">
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full">Pending</span>
                    <span>→</span>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full">Processing</span>
                    <span>→</span>
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full">Shipped</span>
                    <span>→</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full">Completed</span>
                </div>
                <p class="text-xs text-gray-500 mt-2">* You can cancel order at any status</p>
            </div>
        </div>

        <!-- Order Items -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Order Items</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($order->items as $item)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" 
                                         alt="{{ $item->product->name }}"
                                         class="h-12 w-12 rounded-lg object-cover mr-3">
                                    @else
                                    <div class="h-12 w-12 bg-gray-200 rounded-lg mr-3 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    @endif
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $item->product->name }}</p>
                                        <p class="text-xs text-gray-500">SKU: {{ $item->product->sku ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $item->quantity }}
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-right font-semibold text-gray-900">Total</td>
                            <td class="px-6 py-4 text-lg font-bold text-indigo-600">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between">
            <div class="flex gap-3">
                <a href="{{ route('admin.orders.print', $order) }}" 
                   target="_blank"
                   class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Print Invoice
                </a>
            </div>

            @if($order->status != 'completed' && $order->status != 'cancelled')
            <form method="POST" action="{{ route('admin.orders.destroy', $order) }}" 
                  onsubmit="return confirm('Are you sure you want to delete this order?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                    Delete Order
                </button>
            </form>
            @endif
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in">
            {{ session('error') }}
        </div>
    @endif
</x-admin-layout>