@component('mail::message')
# Order Cancelled 

Hello {{ $order->customer_name }},

Your order **{{ $order->order_number }}** has been cancelled as requested.

## Cancellation Details

**Order Number:** {{ $order->order_number }}  
**Cancelled Date:** {{ now()->format('F d, Y \a\t g:i A') }}  
**Original Amount:** LKR {{ number_format($order->total_amount, 2) }}

## Cancelled Items

@component('mail::table')
| Product | Quantity | Unit Price | Total |
|:--------|:--------:|:----------:|------:|
@foreach($order->orderItems as $item)
| {{ $item->product_name }} | {{ $item->quantity }} | LKR {{ number_format($item->unit_price, 2) }} | LKR {{ number_format($item->total_price, 2) }} |
@endforeach
@endcomponent

@if($order->payment_status === 'paid')
@component('mail::panel')
**Refund Information** 💰

Since your payment was already processed, we'll issue a full refund:

- **Refund Amount:** LKR {{ number_format($order->total_amount, 2) }}
- **Processing Time:** 3-5 business days
- **Method:** Refund to original payment method
- **Reference:** Will be provided separately

You'll receive a separate email confirmation once the refund is processed.
@endcomponent
@elseif($order->payment_method === 'bank_transfer' && $order->payment_status === 'pending')
@component('mail::panel')
**Payment Instructions** ❌

Since your order is cancelled:
- **Do not proceed with bank transfer**
- If already transferred, contact us immediately for refund
- Ignore previous payment instructions
@endcomponent
@endif

@if($order->notes)
## Cancellation Reason

{{ $order->notes }}
@endif

@if($order->admin_notes)
## Additional Information

{{ $order->admin_notes }}
@endif

## What's Next?

### Browse Our Products
Even though this order was cancelled, we'd love to help you find what you need:

@component('mail::button', ['url' => route('home')])
Continue Shopping
@endcomponent

### Need Alternative Products?
Our team can help you find similar or better alternatives:

- **WhatsApp:** {{ config('bank.whatsapp_payment_display') }} (Chat with our experts)
- **Email:** info@ceylonitsolutions.com

### Visit Our Store
Get hands-on experience with our products:

**Ceylon IT Solutions showroom**  
No.12, Maradana Road, Colombo 08  
**Hours:** Monday-Saturday 9AM-7PM, Sunday 10AM-6PM

@component('mail::panel')
**Why choose Ceylon IT Solutions?**

✅ **Best Prices** - Competitive pricing guaranteed  
✅ **Genuine Products** - 100% authentic items  
✅ **Expert Support** - Technical assistance available  
✅ **Fast Delivery** - Island-wide shipping  
✅ **Warranty Service** - Comprehensive after-sales support
@endcomponent

## Get Exclusive Offers

Don't miss out on our latest deals and new arrivals:

- 📧 **Email Updates:** Already subscribed with {{ $order->customer_email }}
- 📱 **WhatsApp Alerts:** {{ config('bank.whatsapp_payment_display') }}
- 📘 **Facebook:** Like our page for daily updates

## Customer Support

If you have any questions about this cancellation or need assistance:

- **Refund Status:** {{ config('bank.whatsapp_payment_display') }}
- **Email Support:** info@ceylonitsolutions.com

We're sorry this order didn't work out, but we hope to serve you again soon!

Best regards,  
Ceylon IT Solutions customer service team

@component('mail::subcopy')
Order cancelled: {{ now()->format('F d, Y \a\t g:i A') }}  
Order Number: {{ $order->order_number }}  
@if($order->payment_status === 'paid')Refund will be processed within 3-5 business days@endif
@endcomponent
@endcomponent
