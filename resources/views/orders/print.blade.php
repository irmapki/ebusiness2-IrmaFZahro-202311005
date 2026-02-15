<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $order->order_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>
<body class="bg-white p-8">
    <div class="max-w-4xl mx-auto">
        <!-- Print Button -->
        <div class="no-print mb-6 flex justify-between items-center">
            <a href="{{ route('orders.show', $order) }}" 
               class="text-blue-600 hover:text-blue-800 font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Order
            </a>
            <button onclick="window.print()" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Print Invoice
            </button>
        </div>

        <!-- Invoice Content -->
        <div class="bg-white border-2 border-gray-200 rounded-xl p-8">
            <!-- Header -->
            <div class="flex justify-between items-start mb-8 pb-6 border-b-2 border-gray-200">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">INVOICE</h1>
                    <p class="text-gray-600">Order Number: <span class="font-semibold">{{ $order->order_number }}</span></p>
                    <p class="text-gray-600">Date: <span class="font-semibold">{{ $order->created_at->format('d F Y') }}</span></p>
                </div>
                <div class="text-right">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">ShowMy</h2>
                    <p class="text-gray-600">Jalan raya Pati-Trangkil km 4.5</p>
                    <p class="text-gray-600">Pati</p>
                    <p class="text-gray-600">Phone: 081354133568</p>
                    <p class="text-gray-600">Email: showmayisnotfood@gmail.com</p>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-3">Bill To:</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="font-semibold text-lg">{{ $order->shipping_name }}</p>
                    <p class="text-gray-700">{{ $order->shipping_email }}</p>
                    <p class="text-gray-700">{{ $order->shipping_phone }}</p>
                    <p class="text-gray-700 mt-2">{{ $order->shipping_address }}</p>
                    <p class="text-gray-700">{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</p>
                </div>
            </div>

            <!-- Order Items Table -->
            <div class="mb-8">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-900 text-white">
                            <th class="text-left py-3 px-4 rounded-tl-lg">Product</th>
                            <th class="text-center py-3 px-4">Quantity</th>
                            <th class="text-right py-3 px-4">Price</th>
                            <th class="text-right py-3 px-4 rounded-tr-lg">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr class="border-b border-gray-200">
                                <td class="py-4 px-4">
                                    <p class="font-semibold text-gray-900">{{ $item->product->name ?? 'Product Deleted' }}</p>
                                </td>
                                <td class="py-4 px-4 text-center">{{ $item->quantity }}</td>
                                <td class="py-4 px-4 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="py-4 px-4 text-right font-semibold">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Totals -->
            <div class="flex justify-end mb-8">
                <div class="w-80">
                    @php
                        $subtotal = $order->items->sum(fn($item) => $item->price * $item->quantity);
                        $tax = $subtotal * 0.11;
                        $total = $subtotal + $tax;
                    @endphp
                    
                    <div class="flex justify-between py-2 border-b">
                        <span class="text-gray-700">Subtotal:</span>
                        <span class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b">
                        <span class="text-gray-700">Tax:</span>
                        <span class="font-semibold">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between py-3 bg-gray-900 text-white px-4 rounded-lg mt-2">
                        <span class="font-bold text-lg">Total:</span>
                        <span class="font-bold text-xl">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <h3 class="font-bold text-gray-900 mb-2">Payment Information:</h3>
                <p class="text-gray-700">Payment Method: <span class="font-semibold capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</span></p>
                <p class="text-gray-700">Payment Status: <span class="font-semibold capitalize {{ $order->payment_status === 'paid' ? 'text-green-600' : 'text-yellow-600' }}">{{ $order->payment_status }}</span></p>
                <p class="text-gray-700">Order Status: <span class="font-semibold capitalize">{{ $order->status }}</span></p>
            </div>

            @if($order->notes)
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg mb-6">
                    <h3 class="font-bold text-gray-900 mb-2">Notes:</h3>
                    <p class="text-gray-700">{{ $order->notes }}</p>
                </div>
            @endif

            <!-- Footer -->
            <div class="text-center text-gray-600 text-sm pt-6 border-t-2 border-gray-200">
                <p class="font-semibold mb-2">Thank you for your purchase!</p>
                <p>If you have any questions about this invoice, please contact us at shop@example.com</p>
            </div>
        </div>
    </div>

    <script>
        // Auto print when page loads (optional)
        // window.onload = function() { window.print(); }
    </script>
</body>
</html>