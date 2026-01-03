<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->order_number }} - MSK COMPUTERS</title>
    <style>
        @page {
            size: A4;
            margin: 15mm;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            background: white;
        }
        
        .container {
            width: 100%;
            max-width: 100%;
        }
        
        .header {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 30px;
            margin-bottom: 30px;
            border-radius: 8px;
        }
        
        .header-content {
            display: table;
            width: 100%;
        }
        
        .company-info {
            display: table-cell;
            vertical-align: top;
            width: 60%;
        }
        
        .invoice-info {
            display: table-cell;
            vertical-align: top;
            width: 40%;
            text-align: right;
        }
        
        .company-name {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        
        .company-tagline {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 15px;
        }
        
        .company-details {
            font-size: 11px;
            line-height: 1.8;
        }
        
        .invoice-title {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        
        .invoice-number {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .details-section {
            margin-bottom: 30px;
        }
        
        .details-grid {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        
        .details-left, .details-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 20px;
        }
        
        .details-right {
            padding-right: 0;
            padding-left: 20px;
        }
        
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 15px;
            border-bottom: 2px solid #f59e0b;
            padding-bottom: 5px;
        }
        
        .detail-item {
            margin-bottom: 8px;
            font-size: 12px;
        }
        
        .detail-label {
            font-weight: bold;
            color: #555;
            display: inline-block;
            width: 120px;
        }
        
        .detail-value {
            color: #1f2937;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
        }
        
        .status-paid {
            background: #10b981;
            color: white;
        }
        
        .status-pending {
            background: #f59e0b;
            color: white;
        }
        
        .status-failed {
            background: #ef4444;
            color: white;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        
        th {
            background: #f3f4f6;
            color: #1f2937;
            font-weight: bold;
            padding: 12px;
            text-align: left;
            border: 1px solid #d1d5db;
            font-size: 11px;
        }
        
        td {
            padding: 12px;
            border: 1px solid #d1d5db;
            font-size: 11px;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .summary-box {
            background: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            margin-left: auto;
            width: 50%;
        }
        
        .summary-row {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }
        
        .summary-label {
            display: table-cell;
            width: 60%;
            font-size: 12px;
            color: #555;
        }
        
        .summary-value {
            display: table-cell;
            width: 40%;
            text-align: right;
            font-size: 12px;
            font-weight: bold;
            color: #1f2937;
        }
        
        .summary-total {
            border-top: 2px solid #d1d5db;
            padding-top: 10px;
            margin-top: 10px;
        }
        
        .summary-total .summary-label,
        .summary-total .summary-value {
            font-size: 16px;
            font-weight: bold;
            color: #f59e0b;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
            font-size: 10px;
            color: #666;
        }
        
        .footer-grid {
            display: table;
            width: 100%;
        }
        
        .footer-left, .footer-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        
        .footer-title {
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
            font-size: 12px;
        }
        
        .footer-item {
            margin-bottom: 5px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <div class="company-info">
                    <div class="company-name">MSK COMPUTERS</div>
                    <div class="company-tagline">Your Trusted IT Partner</div>
                    <div class="company-details">
                        <div>No.296/3D, Delpe Junction, Ragama, Sri Lanka</div>
                        <div>Tel: 0112 95 9005 | 0777 50 69 39 | 071 53 21 750</div>
                        <div>Email: info@mskcomputers.lk | Web: www.mskcomputers.lk</div>
                    </div>
                </div>
                <div class="invoice-info">
                    <div class="invoice-title">INVOICE</div>
                    <div class="invoice-number">Invoice #{{ $order->order_number }}</div>
                </div>
            </div>
        </div>

        <!-- Details Section -->
        <div class="details-section">
            <div class="details-grid">
                <div class="details-left">
                    <div class="section-title">Bill To:</div>
                    <div class="detail-item">
                        <div style="font-weight: bold; font-size: 13px; margin-bottom: 5px;">{{ $order->customer_name }}</div>
                        @if($order->customer_email)
                            <div style="margin-bottom: 3px;">{{ $order->customer_email }}</div>
                        @endif
                        @if($order->customer_phone)
                            <div style="margin-bottom: 3px;">{{ $order->customer_phone }}</div>
                        @endif
                        @if($order->billing_address_line_1)
                            <div style="margin-top: 8px;">
                                {{ $order->billing_address_line_1 }}<br>
                                @if($order->billing_address_line_2)
                                    {{ $order->billing_address_line_2 }}<br>
                                @endif
                                {{ $order->billing_city }}, {{ $order->billing_state }}<br>
                                {{ $order->billing_postal_code }}, {{ $order->billing_country }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="details-right">
                    <div class="section-title">Invoice Information:</div>
                    <div class="detail-item">
                        <span class="detail-label">Invoice Date:</span>
                        <span class="detail-value">{{ $order->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Order Status:</span>
                        <span class="detail-value">{{ ucfirst($order->status) }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Payment Status:</span>
                        <span class="detail-value">
                            <span class="status-badge {{ $order->payment_status === 'paid' ? 'status-paid' : ($order->payment_status === 'pending' ? 'status-pending' : 'status-failed') }}">
                                {{ $order->payment_status === 'paid' ? 'Paid' : ucfirst(str_replace('_', ' ', $order->payment_status)) }}
                            </span>
                        </span>
                    </div>
                    @if($order->payment_method)
                        <div class="detail-item">
                            <span class="detail-label">Payment Method:</span>
                            <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span>
                        </div>
                    @endif
                    @if($order->payment_reference)
                        <div class="detail-item">
                            <span class="detail-label">Transaction ID:</span>
                            <span class="detail-value" style="font-family: monospace; font-size: 10px;">{{ $order->payment_reference }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Order Items Table -->
        <div class="section-title">Order Items:</div>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 50%;">Item</th>
                    <th style="width: 10%;" class="text-center">Qty</th>
                    <th style="width: 17.5%;" class="text-right">Unit Price</th>
                    <th style="width: 17.5%;" class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <div style="font-weight: bold; margin-bottom: 3px;">{{ $item->product_name }}</div>
                        @if($item->product_code)
                            <div style="font-size: 10px; color: #666;">Code: {{ $item->product_code }}</div>
                        @elseif($item->product_sku)
                            <div style="font-size: 10px; color: #666;">SKU: {{ $item->product_sku }}</div>
                        @endif
                    </td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">LKR {{ number_format($item->unit_price, 2) }}</td>
                    <td class="text-right" style="font-weight: bold;">LKR {{ number_format($item->total_price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Order Summary -->
        <div class="summary-box">
            <div class="section-title" style="margin-bottom: 15px;">Order Summary</div>
            <div class="summary-row">
                <div class="summary-label">Subtotal:</div>
                <div class="summary-value">LKR {{ number_format($order->subtotal, 2) }}</div>
            </div>
            @if($order->tax_amount > 0)
            <div class="summary-row">
                <div class="summary-label">Tax:</div>
                <div class="summary-value">LKR {{ number_format($order->tax_amount, 2) }}</div>
            </div>
            @endif
            @if($order->shipping_cost > 0)
            <div class="summary-row">
                <div class="summary-label">Shipping:</div>
                <div class="summary-value">LKR {{ number_format($order->shipping_cost, 2) }}</div>
            </div>
            @endif
            @if($order->discount_amount > 0)
            <div class="summary-row">
                <div class="summary-label" style="color: #10b981;">Discount:</div>
                <div class="summary-value" style="color: #10b981;">-LKR {{ number_format($order->discount_amount, 2) }}</div>
            </div>
            @endif
            <div class="summary-row summary-total">
                <div class="summary-label">Total Amount:</div>
                <div class="summary-value">LKR {{ number_format($order->total_amount, 2) }}</div>
            </div>
        </div>

        @if($order->notes)
        <!-- Order Notes -->
        <div style="margin-top: 30px;">
            <div class="section-title">Order Notes:</div>
            <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 4px; padding: 15px; font-size: 11px; color: #1e40af;">
                {{ $order->notes }}
            </div>
        </div>
        @endif

        @if($order->shipping_address_line_1)
        <!-- Shipping Information -->
        <div style="margin-top: 30px;">
            <div class="section-title">Shipping Address:</div>
            <div style="background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 4px; padding: 15px; font-size: 11px; color: #374151;">
                {{ $order->shipping_address_line_1 }}<br>
                @if($order->shipping_address_line_2)
                    {{ $order->shipping_address_line_2 }}<br>
                @endif
                {{ $order->shipping_city }}, {{ $order->shipping_state }}<br>
                {{ $order->shipping_postal_code }}, {{ $order->shipping_country }}
            </div>
        </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <div class="footer-grid">
                <div class="footer-left">
                    <div class="footer-title">Terms & Conditions:</div>
                    <div class="footer-item">• Thank you for choosing MSK Computers - Your Trusted IT Partner</div>
                    <div class="footer-item">• All sales are final unless otherwise specified</div>
                    <div class="footer-item">• Products come with manufacturer warranty</div>
                    <div class="footer-item">• For technical support and inquiries, please contact us</div>
                    <div class="footer-item">• Sri Lanka's leading computer specialist since establishment</div>
                </div>
                <div class="footer-right">
                    <div class="footer-title">Thank You!</div>
                    <div class="footer-item">We appreciate your business and look forward to serving you again.</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

