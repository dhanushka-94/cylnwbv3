<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation - {{ $quotation_number }}</title>
    @php
        $logoPath = public_path('cts-sys-logo-clr.png');
        $logoData = (is_string($logoPath) && file_exists($logoPath))
            ? base64_encode(file_get_contents($logoPath))
            : null;
    @endphp
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            line-height: 1.45;
            color: #1f2937;
            background: #ffffff;
            margin: 0;
            padding: 0;
        }

        .doc-wrap {
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
        }

        /* Bluish header — solid fill so DomPDF always renders (div gradients often print white) */
        .header-gradient {
            width: 100%;
            border-collapse: collapse;
        }

        .header-gradient td.header-cell {
            background-color: #1e40af;
            padding: 22px 28px;
            color: #ffffff;
        }

        .header-inner {
            width: 100%;
            border-collapse: collapse;
        }

        .header-inner td {
            vertical-align: top;
            padding: 0;
        }

        .header-left {
            padding-right: 16px;
        }

        .logo {
            height: 44px;
            width: auto;
            display: block;
            margin-bottom: 10px;
        }

        .doc-title {
            font-size: 26px;
            font-weight: bold;
            color: #ffffff;
            letter-spacing: 0.5px;
        }

        .doc-sub {
            font-size: 11px;
            color: #dbeafe;
            margin-top: 4px;
        }

        .header-right {
            text-align: right;
            color: #ffffff;
        }

        .header-right h2 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .header-right p {
            font-size: 11px;
            color: #dbeafe;
            line-height: 1.5;
        }

        .body-pad {
            padding: 28px;
        }

        .grid-2 {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 22px;
        }

        .grid-2 td {
            vertical-align: top;
            width: 50%;
            padding: 0 10px 0 0;
        }

        .grid-2 td:last-child {
            padding: 0 0 0 10px;
        }

        h3.section-h {
            font-size: 13px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 12px;
        }

        .bill-block {
            color: #1f2937;
            font-size: 11px;
            line-height: 1.55;
        }

        .bill-block strong.name {
            font-weight: bold;
            color: #111827;
        }

        .info-rows {
            font-size: 11px;
            color: #1f2937;
        }

        .info-row {
            width: 100%;
            margin-bottom: 6px;
        }

        .info-row table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-row td {
            padding: 2px 0;
        }

        .info-label {
            color: #374151;
        }

        .info-val {
            font-weight: 600;
            text-align: right;
            color: #111827;
        }

        .items-h {
            font-size: 13px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
            font-size: 10px;
            border: 1px solid #d1d5db;
        }

        .items-table th {
            background: #f9fafb;
            color: #1f2937;
            padding: 10px 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #d1d5db;
        }

        .items-table th.text-center { text-align: center; }
        .items-table th.text-right { text-align: right; }

        .items-table td {
            padding: 9px 8px;
            border: 1px solid #d1d5db;
            vertical-align: top;
            color: #111827;
        }

        .items-table tbody tr:nth-child(even) {
            background: #f9fafb;
        }

        .item-name {
            font-weight: 600;
            color: #111827;
        }

        .item-description {
            color: #4b5563;
            font-size: 9px;
            margin-top: 3px;
        }

        .text-right { text-align: right; }
        .text-center { text-align: center; }

        .currency-note {
            text-align: right;
            margin: 0 0 14px 0;
            font-size: 10px;
            color: #4b5563;
            font-style: italic;
        }

        .summary-wrap {
            width: 100%;
            margin-bottom: 18px;
        }

        .summary-wrap table {
            margin-left: auto;
            width: 50%;
            max-width: 320px;
        }

        .summary-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 18px;
        }

        .summary-box h3 {
            font-size: 13px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 12px;
        }

        .sum-row {
            width: 100%;
            font-size: 11px;
            margin-bottom: 6px;
        }

        .sum-row table {
            width: 100%;
            border-collapse: collapse;
        }

        .sum-row td {
            padding: 3px 0;
            color: #374151;
        }

        .sum-row .amt {
            text-align: right;
            font-weight: 600;
            color: #111827;
        }

        .sum-discount td {
            color: #15803d;
        }

        .sum-total {
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px solid #d1d5db;
            font-size: 13px;
            font-weight: bold;
            color: #111827;
        }

        .sum-total table {
            width: 100%;
        }

        .sum-total td {
            padding: 4px 0;
        }

        .notes-block {
            margin-top: 18px;
        }

        .notes-inner {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            padding: 14px;
            font-size: 10px;
            line-height: 1.55;
            color: #1e3a8a;
        }

        .footer-split {
            margin-top: 22px;
            padding-top: 22px;
            border-top: 1px solid #e5e7eb;
        }

        .footer-grid {
            width: 100%;
            border-collapse: collapse;
        }

        .footer-grid td {
            vertical-align: top;
            width: 50%;
            padding: 0 12px 0 0;
            font-size: 10px;
            line-height: 1.55;
            color: #374151;
        }

        .footer-grid td:last-child {
            padding: 0 0 0 12px;
        }

        .footer-h {
            font-weight: bold;
            color: #111827;
            margin-bottom: 10px;
            font-size: 11px;
        }

        .terms-quote {
            font-size: 9.5px;
            color: #4b5563;
            padding-left: 14px;
        }

        .terms-quote li {
            margin-bottom: 5px;
        }

        .footer-closing {
            margin-top: 20px;
            padding-top: 14px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 9px;
            color: #6b7280;
        }

        .accent {
            color: #2563eb;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="doc-wrap">
        {{-- Full-width table + bgcolor so DomPDF always paints the top strip (avoids white header bug) --}}
        <table class="header-gradient" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#1e40af" style="width:100%;border-collapse:collapse;background-color:#1e40af;">
            <tr>
                <td class="header-cell" bgcolor="#1e40af" style="background-color:#1e40af;padding:22px 28px;">
                    <table class="header-inner" width="100%" cellpadding="0" cellspacing="0" style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td class="header-left" style="width:55%;vertical-align:top;">
                                @if($logoData)
                                    <img class="logo" src="data:image/png;base64,{{ $logoData }}" alt="Ceylon IT Solutions">
                                @endif
                                <div class="doc-title">QUOTATION</div>
                                <div class="doc-sub">Quotation #{{ $quotation_number }}</div>
                            </td>
                            <td class="header-right" style="width:45%;vertical-align:top;text-align:right;">
                                <h2>CEYLON IT SOLUTIONS</h2>
                                <p>CITS — IT solutions &amp; retail</p>
                                <p>Sri Lanka &amp; United Arab Emirates</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="body-pad">
            <table class="grid-2" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <h3 class="section-h">Quote To:</h3>
                        <div class="bill-block">
                            <p class="name"><strong class="name">{{ $customer['name'] }}</strong></p>
                            @if(!empty($customer['email']) && $customer['email'] !== 'Not provided')
                                <p>{{ $customer['email'] }}</p>
                            @endif
                            @if(!empty($customer['phone']))
                                <p>{{ $customer['phone'] }}</p>
                            @endif
                            @php
                                $hasStreet = !empty($customer['address']) && $customer['address'] !== 'Not provided';
                                $hasCity = !empty($customer['city']) && $customer['city'] !== 'Not provided';
                                $hasState = !empty($customer['state']);
                                $hasPostal = !empty($customer['postal_code']);
                                $hasCountry = !empty($customer['country']);
                            @endphp
                            @if($hasStreet || $hasCity || $hasState || $hasPostal || $hasCountry)
                                <p style="margin-top: 8px;">
                                    @if($hasStreet)
                                        {{ $customer['address'] }}<br>
                                    @endif
                                    @if($hasCity || $hasState)
                                        @if($hasCity){{ $customer['city'] }}@endif
                                        @if($hasCity && $hasState), @endif
                                        @if($hasState){{ $customer['state'] }}@endif
                                        <br>
                                    @endif
                                    @if($hasPostal || $hasCountry)
                                        @if($hasPostal){{ $customer['postal_code'] }}@endif
                                        @if($hasPostal && $hasCountry), @endif
                                        @if($hasCountry){{ $customer['country'] }}@endif
                                    @endif
                                </p>
                            @endif
                        </div>
                    </td>
                    <td>
                        <h3 class="section-h">Quotation Information:</h3>
                        <div class="info-rows">
                            <div class="info-row">
                                <table cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="info-label" style="width: 45%;">Quotation #:</td>
                                        <td class="info-val">{{ $quotation_number }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="info-row">
                                <table cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="info-label" style="width: 45%;">Date:</td>
                                        <td class="info-val">{{ $date }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="info-row">
                                <table cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="info-label" style="width: 45%;">Valid until:</td>
                                        <td class="info-val">{{ $valid_until }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

            <div class="items-h">Line items:</div>
            <table class="items-table" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 5%;" class="text-center">#</th>
                        <th style="width: 38%;">Item</th>
                        <th style="width: 8%;" class="text-center">Qty</th>
                        <th style="width: 14%;" class="text-right">Unit Price</th>
                        @if($total_discount > 0)
                        <th style="width: 15%;" class="text-right">Discount</th>
                        @endif
                        <th style="width: 14%;" class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $index => $item)
                    @php
                        $pName = data_get($item, 'product.name');
                        $pDesc = data_get($item, 'product.description');
                        $pPrice = (float) data_get($item, 'product.price', 0);
                        $qty = (int) data_get($item, 'cart_item.quantity', 0);
                        $lineDisc = (float) data_get($item, 'line_discount', 0);
                        $lineTot = (float) data_get($item, 'line_total', 0);
                    @endphp
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            <div class="item-name">{{ $pName }}</div>
                            @if($pDesc)
                            <div class="item-description">{{ Str::limit($pDesc, 100) }}</div>
                            @endif
                        </td>
                        <td class="text-center">{{ $qty }}</td>
                        <td class="text-right">LKR {{ number_format($pPrice, 2) }}</td>
                        @if($total_discount > 0)
                        <td class="text-right" style="color: #15803d;">
                            @if($lineDisc > 0)
                                -LKR {{ number_format($lineDisc, 2) }}
                            @else
                                —
                            @endif
                        </td>
                        @endif
                        <td class="text-right"><strong>LKR {{ number_format($lineTot, 2) }}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="currency-note">
                <strong>All amounts are in Sri Lankan Rupees (LKR)</strong>
            </div>

            <div class="summary-wrap">
                <table cellpadding="0" cellspacing="0" align="right">
                    <tr>
                        <td>
                            <div class="summary-box">
                                <h3>Quotation Summary</h3>
                                <div class="sum-row">
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td>Subtotal:</td>
                                            <td class="amt">LKR {{ number_format($original_subtotal > 0 ? $original_subtotal : $subtotal, 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                @if($total_discount > 0)
                                <div class="sum-row sum-discount">
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td>Discount:</td>
                                            <td class="amt">-LKR {{ number_format($total_discount, 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                @endif
                                @if($shipping_cost > 0)
                                <div class="sum-row">
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td>Shipping:</td>
                                            <td class="amt">LKR {{ number_format($shipping_cost, 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                @endif
                                @if($tax_amount > 0)
                                <div class="sum-row">
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td>Tax:</td>
                                            <td class="amt">LKR {{ number_format($tax_amount, 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                @endif
                                <div class="sum-total">
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td>Total Amount:</td>
                                            <td class="amt" style="text-align: right;">LKR {{ number_format($total, 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            @if($notes)
            <div class="notes-block">
                <h3 class="section-h">Special instructions:</h3>
                <div class="notes-inner">{{ $notes }}</div>
            </div>
            @endif

            <div class="footer-split">
                <table class="footer-grid" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <div class="footer-h">Company Information:</div>
                            <p style="margin-bottom: 6px;"><strong>{{ config('bank.account_name') }}</strong></p>
                            <p style="margin-bottom: 6px;">Ceylon IT Solutions (CITS)</p>
                            <p style="margin-bottom: 6px;">Sharjah, UAE · Embilipitiya &amp; Kandy, Sri Lanka</p>
                            <p style="margin-bottom: 6px;">Registered: No. 74, Main Street, Pallegama, Embilipitiya</p>
                            <p style="margin-bottom: 6px;">WhatsApp: {{ config('bank.whatsapp_payment_display') }}</p>
                            <p style="margin-bottom: 6px; font-size: 9px; color: #6b7280;">SL branches: +94 47 223 0429 · +94 74 184 7422</p>
                            <p style="margin-bottom: 6px;">info@ceylonitsolutions.com</p>
                            <p>www.ceylonitsolutions.com</p>
                        </td>
                        <td>
                            <div class="footer-h">Terms &amp; Conditions:</div>
                            <ul class="terms-quote">
                                <li><strong>This quotation is valid for 7 days from the date of issue.</strong></li>
                                <li>Prices are quoted in Sri Lankan Rupees (LKR) and are subject to change without notice.</li>
                                <li>All products are subject to availability at the time of order confirmation.</li>
                                <li>Delivery charges may apply based on location and will be confirmed at the time of order.</li>
                                <li>Payment terms may be agreed at order confirmation.</li>
                                <li>Warranty terms apply as per manufacturer specifications.</li>
                                <li>For clarifications, contact us using the details shown.</li>
                                <li>Thank you for choosing Ceylon IT Solutions (CITS). All sales are subject to our standard terms unless otherwise agreed.</li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="footer-closing">
                <p>Thank you for considering <span class="accent">Ceylon IT Solutions</span> for your technology needs.</p>
                <p style="margin-top: 6px;">This is a computer-generated quotation and does not require a signature.</p>
            </div>
        </div>
    </div>
</body>
</html>
