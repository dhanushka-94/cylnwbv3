<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation - {{ $quotation_number }}</title>
    <style>
        @page {
            size: A4;
            margin: 0; /* Remove page margin, we'll handle it manually */
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: white;
            margin: 0;
            padding: 10mm; /* 1cm padding all around */
        }
        
        .container {
            width: 100%;
            margin: 0;
            padding: 0;
        }
        
        .header {
            border-bottom: 3px solid #f59e0b;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .company-info {
            display: table;
            width: 100%;
        }
        
        .company-logo {
            display: table-cell;
            width: 60%;
            vertical-align: top;
        }
        
        .company-name {
            font-size: 32px;
            font-weight: bold;
            color: #1a1a1c;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }
        
        .company-tagline {
            font-size: 16px;
            color: #f59e0b;
            margin-bottom: 15px;
            font-style: italic;
            font-weight: 500;
        }
        
        .company-details {
            font-size: 12px;
            color: #555;
            line-height: 1.6;
        }
        
        .company-details div {
            margin-bottom: 3px;
        }
        
        .quotation-info {
            display: table-cell;
            width: 40%;
            text-align: right;
            vertical-align: top;
        }
        
        .quotation-title {
            font-size: 28px;
            font-weight: bold;
            color: #f59e0b;
            margin-bottom: 15px;
        }
        
        .quotation-details {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #f59e0b;
        }
        
        .quotation-details table {
            width: 100%;
            font-size: 11px;
        }
        
        .quotation-details td {
            padding: 3px 0;
        }
        
        .quotation-details .label {
            font-weight: bold;
            color: #333;
        }
        
        .customer-section {
            margin: 30px 0;
            display: flex;
            justify-content: space-between;
        }
        
        .customer-info {
            flex: 1;
            margin-right: 30px;
        }
        
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #1a1a1c;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid #f59e0b;
        }
        
        .customer-details {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            font-size: 11px;
            line-height: 1.6;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
            font-size: 11px;
        }
        
        .items-table th {
            background: #1a1a1c;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
        }
        
        .items-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #e5e5e5;
        }
        
        .items-table tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        .items-table .item-name {
            font-weight: bold;
            color: #1a1a1c;
        }
        
        .items-table .item-description {
            color: #666;
            font-size: 10px;
            margin-top: 2px;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .totals-section {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
        }
        
        .totals-table {
            width: 300px;
            font-size: 12px;
        }
        
        .totals-table td {
            padding: 8px 12px;
            border-bottom: 1px solid #e5e5e5;
        }
        
        .totals-table .label {
            font-weight: bold;
            color: #333;
        }
        
        .totals-table .total-row {
            background: #1a1a1c;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }
        
        .totals-table .total-row .label {
            color: white;
        }
        
        .terms-section {
            margin-top: 40px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 5px;
            border-left: 4px solid #f59e0b;
        }
        
        .terms-title {
            font-size: 14px;
            font-weight: bold;
            color: #1a1a1c;
            margin-bottom: 10px;
        }
        
        .terms-list {
            font-size: 11px;
            line-height: 1.6;
            color: #555;
        }
        
        .terms-list li {
            margin-bottom: 5px;
        }
        
        .notes-section {
            margin-top: 30px;
        }
        
        .notes-content {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 5px;
            font-size: 11px;
            line-height: 1.6;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #f59e0b;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        
        .highlight {
            color: #f59e0b;
            font-weight: bold;
        }
        
        .discount {
            color: #dc3545;
            font-weight: bold;
        }
        
        @media print {
            .container {
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="company-info">
                <div class="company-logo">
                    <div class="company-name">MSK COMPUTERS</div>
                    <div class="company-tagline">Empowering Tech Solutions, Every Day.</div>
                    <div class="company-details">
                        <div>NO. 74, MAIN STREET, PALLEGAMA, EMBILIPITIYA, Sri Lanka</div>
                        <div>0112 95 9005 / 0777 50 69 39</div>
                        <div>info@ceylonitsolutions.com</div>
                    </div>
                </div>
                <div class="quotation-info">
                    <div class="quotation-title">QUOTATION</div>
                    <div class="quotation-details">
                        <table>
                            <tr>
                                <td class="label">Quotation #:</td>
                                <td>{{ $quotation_number }}</td>
                            </tr>
                            <tr>
                                <td class="label">Date:</td>
                                <td>{{ $date }}</td>
                            </tr>
                            <tr>
                                <td class="label">Valid Until:</td>
                                <td>{{ $valid_until }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="customer-section">
            <div class="customer-info">
                <div class="section-title">Quote To</div>
                <div class="customer-details">
                    <strong>{{ $customer['name'] }}</strong><br>
                    <strong>Phone:</strong> {{ $customer['phone'] }}
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 40%">Product Description</th>
                    <th style="width: 8%" class="text-center">Qty</th>
                    <th style="width: 15%" class="text-right">Unit Price</th>
                    @if($total_discount > 0)
                    <th style="width: 17%; white-space: nowrap;" class="text-right">Discount</th>
                    @endif
                    <th style="width: 15%" class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <div class="item-name">{{ $item['product']->name }}</div>
                        @if($item['product']->description)
                        <div class="item-description">{{ Str::limit($item['product']->description, 100) }}</div>
                        @endif
                    </td>
                    <td class="text-center">{{ $item['cart_item']->quantity }}</td>
                    <td class="text-right">{{ number_format($item['product']->price, 2) }}</td>
                    @if($total_discount > 0)
                    <td class="text-right discount" style="white-space: nowrap;">
                        @if($item['line_discount'] > 0)
                        -{{ number_format($item['line_discount'], 2) }}
                        @else
                        -
                        @endif
                    </td>
                    @endif
                    <td class="text-right">{{ number_format($item['line_total'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Currency Note -->
        <div style="text-align: right; margin-top: 10px; margin-bottom: 20px; font-size: 11px; color: #666; font-style: italic;">
            <strong>All amounts are in Sri Lankan Rupees (LKR)</strong>
        </div>

        <!-- Totals -->
        <div class="totals-section">
            <table class="totals-table">
                <tr>
                    <td class="label">Subtotal:</td>
                    <td class="text-right">{{ number_format($original_subtotal > 0 ? $original_subtotal : $subtotal, 2) }}</td>
                </tr>
                @if($total_discount > 0)
                <tr>
                    <td class="label discount">Total Discount:</td>
                    <td class="text-right discount">-{{ number_format($total_discount, 2) }}</td>
                </tr>
                @endif
                @if($shipping_cost > 0)
                <tr>
                    <td class="label">Shipping:</td>
                    <td class="text-right">{{ number_format($shipping_cost, 2) }}</td>
                </tr>
                @endif
                @if($tax_amount > 0)
                <tr>
                    <td class="label">Tax:</td>
                    <td class="text-right">{{ number_format($tax_amount, 2) }}</td>
                </tr>
                @endif
                <tr class="total-row">
                    <td class="label">TOTAL:</td>
                    <td class="text-right">{{ number_format($total, 2) }}</td>
                </tr>
            </table>
        </div>

        <!-- Notes -->
        @if($notes)
        <div class="notes-section">
            <div class="section-title">Special Instructions</div>
            <div class="notes-content">
                {{ $notes }}
            </div>
        </div>
        @endif

        <!-- Terms and Conditions -->
        <div class="terms-section">
            <div class="terms-title">Terms & Conditions</div>
            <ul class="terms-list">
                <li><strong>This quotation is valid for 7 days from the date of issue.</strong></li>
                <li>Prices are quoted in Sri Lankan Rupees (LKR) and are subject to change without notice.</li>
                <li>All products are subject to availability at the time of order confirmation.</li>
                <li>Delivery charges may apply based on location and will be confirmed at the time of order.</li>
                <li>Payment terms: 50% advance payment required, balance on delivery.</li>
                <li>Warranty terms apply as per manufacturer specifications.</li>
                <li>For any clarifications, please contact us using the information provided above.</li>
            </ul>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you for considering <span class="highlight">MSK COMPUTERS</span> for your technology needs.</p>
            <p>This is a computer-generated quotation and does not require a signature.</p>
        </div>
    </div>
</body>
</html>

