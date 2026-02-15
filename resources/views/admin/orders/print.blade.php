<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $order->order_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; padding: 40px; background: #f5f5f5; }
        .invoice { max-width: 800px; margin: 0 auto; background: white; padding: 40px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .header { text-align: center; border-bottom: 3px solid #4F46E5; padding-bottom: 20px; margin-bottom: 30px; }
        .header h1 { color: #4F46E5; font-size: 32px; margin-bottom: 5px; }
        .header p { color: #666; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px; }
        .info-section h3 { color: #4F46E5; font-size: 14px; text-transform: uppercase; margin-bottom: 10px; border-bottom: 2px solid #E5E7EB; padding-bottom: 5px; }
        .info-section p { margin: 5px 0; color: #333; font-size: 14px; }
        .info-section .label { color: #666; font-size: 12px; }
        .table { width: 100%; border-collapse: collapse; margin: 30px 0; }
        .table thead { background: #4F46E5; color: white; }
        .table th { padding: 12px; text-align: left; font-size: 12px; text-transform: uppercase; }
        .table td { padding: 12px; border-bottom: 1px solid #E5E7EB; font-size: 14px; }
        .table tbody tr:hover { background: #F9FAFB; }
        .total-section { text-align: right; margin-top: 20px; }
        .total-row { display: flex; justify-content: flex-end; gap: 20px; margin: 10px 0; }
        .total-label { font-weight: bold; min-width: 150px; }
        .total-value { min-width: 150px; text-align: right; }
        .grand-total { font-size: 20px; color: #4F46E5; font-weight: bold; border-top: 2px solid #4F46E5; padding-top: 10px; margin-top: 10px; }
        .status-badge { display: inline-block; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; text-transform: uppercase; }
        .status-pending { background: #FEF3C7; color: #92400E; }
        .status-processing { background: #DBEAFE; color: #1E40AF; }
        .status-shipped { background: #E9D5FF; color: #6B21A8; }
        .status-completed { background: #D1FAE5; color: #065F46; }
        .status-cancelled { background: #FEE2E2; color: #991B1B; }
        .footer { margin-top: 40px; padding-top: 20px; border-top: 1px solid #E5E7EB; text-align: center; color: #666; font-size: 12px; }
        .print-btn { background: #4F46E5; color: white; padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer; font-size: 14px; margin-bottom: 20px; }
        .print-btn:hover { background: #4338CA; }
        @media print {
            body { padding: 0; background: white; }
            .invoice { box-shadow: none; }
            .print-btn { display: none; }
        }
    </style>
</head>
<body>
    <div class="invoice">
        <button onclick="window.print()" class="print-btn">🖨️ Print Invoice</button>

        <div class="header">
            <h1>ShowMy</h1>
            <p>{{ config('app.name', 'ShowMy Store') }}</p>
        </div>

        <div class="info-grid">
            <div class="info-section">
                <h3>Invoice Details</h3>
                <p><span class="label">Invoice Number:</span><br><strong>{{ $order->order_number }}</strong></p>
                <p><span class="label">Date:</span><br>{{ $order->created_at->format('d F Y') }}</p>
                <p><span class="label">Status:</span><br>
                    <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                </p>
            </div>

            <div class="info-section">
                <h3>Customer Information</h3>
                <p><span class="label">Name:</span><br><strong>{{ $order->user->name }}</strong></p>
                <p><span class="label">Email:</span><br>{{ $order->user->email }}</p>
                @if($order->phone)
                <p><span class="label">Phone:</span><br>{{ $order->phone }}</p>
                @endif
                @if($order->shipping_address)
                <p><span class="label">Shipping Address:</span><br>{{ $order->shipping_address }}</p>
                @endif
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>
                        <strong>{{ $item->product->name }}</strong>
                        @if($item->product->sku)
                        <br><small style="color: #666;">SKU: {{ $item->product->sku }}</small>
                        @endif
                    </td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td><strong>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            <div class="total-row">
                <div class="total-label">Subtotal:</div>
                <div class="total-value">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
            </div>
            <div class="total-row">
                <div class="total-label">Shipping:</div>
                <div class="total-value">Rp 0</div>
            </div>
            <div class="total-row grand-total">
                <div class="total-label">Grand Total:</div>
                <div class="total-value">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
            </div>
        </div>

        @if($order->notes)
        <div style="margin-top: 30px; padding: 15px; background: #F9FAFB; border-left: 4px solid #4F46E5;">
            <strong>Customer Notes:</strong><br>
            {{ $order->notes }}
        </div>
        @endif

        <div class="footer">
            <p><strong>Thank you for your purchase!</strong></p>
            <p>This is a computer-generated invoice and does not require a signature.</p>
            <p>© {{ date('Y') }} {{ config('app.name', 'ShowMy Store') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>