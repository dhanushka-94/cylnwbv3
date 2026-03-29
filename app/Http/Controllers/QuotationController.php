<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\SmaProduct;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Throwable;

class QuotationController extends Controller
{
    /**
     * Build cart query: session cart and/or logged-in user's cart rows.
     */
    private function getCartItems()
    {
        $sessionId = session()->getId();

        return Cart::query()
            ->where(function ($q) use ($sessionId) {
                $q->where('session_id', $sessionId);
                if (Auth::check()) {
                    $q->orWhere('user_id', Auth::id());
                }
            })
            ->get();
    }

    /**
     * JSON-serializable snapshot for quotations.items_data (no Eloquent in JSON).
     */
    private function serializeItemsForStorage(array $cartProducts): array
    {
        return array_map(function (array $row) {
            $c = $row['cart_item'];
            $p = $row['product'];

            return [
                'line_total' => $row['line_total'],
                'original_line_total' => $row['original_line_total'],
                'line_discount' => $row['line_discount'],
                'cart_item' => [
                    'id' => $c->id,
                    'product_id' => $c->product_id,
                    'quantity' => $c->quantity,
                ],
                'product' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'sku' => $p->sku ?? null,
                    'price' => (float) $p->price,
                    'final_price' => (float) $p->final_price,
                    'main_image' => $p->main_image,
                ],
            ];
        }, $cartProducts);
    }

    /**
     * Generate and download quotation PDF
     */
    public function generateQuotation(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:30',
            'terms' => 'required|accepted',
        ]);

        try {
            $cartItems = $this->getCartItems();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
            }

            $subtotal = 0;
            $originalSubtotal = 0;
            $totalDiscount = 0;
            $cartProducts = [];

            foreach ($cartItems as $item) {
                $product = SmaProduct::find($item->product_id);
                if ($product) {
                    $lineTotal = $item->quantity * $product->final_price;
                    $originalLineTotal = $item->quantity * $product->price;
                    $lineDiscount = $originalLineTotal - $lineTotal;

                    $subtotal += $lineTotal;
                    $originalSubtotal += $originalLineTotal;
                    $totalDiscount += $lineDiscount;

                    $cartProducts[] = [
                        'cart_item' => $item,
                        'product' => $product,
                        'line_total' => $lineTotal,
                        'original_line_total' => $originalLineTotal,
                        'line_discount' => $lineDiscount,
                    ];
                }
            }

            if (empty($cartProducts)) {
                return redirect()->route('cart.index')->with('error', 'No valid products in your cart.');
            }

            $shippingCost = 0;
            $taxAmount = 0;
            $total = $subtotal + $shippingCost + $taxAmount;

            $quotationNumber = 'QUO-' . date('Y') . '-' . strtoupper(substr(uniqid(), -8));

            $itemsForDb = $this->serializeItemsForStorage($cartProducts);

            Quotation::create([
                'quotation_number' => $quotationNumber,
                'user_id' => Auth::id(),
                'session_id' => session()->getId(),
                'customer_name' => $request->first_name.' '.$request->last_name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'customer_email' => $request->customer_email ?? null,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->billing_address_line_1 ?? null,
                'customer_city' => $request->billing_city ?? null,
                'customer_state' => $request->billing_state ?? null,
                'customer_postal_code' => $request->billing_postal_code ?? null,
                'customer_country' => $request->billing_country ?? 'Sri Lanka',
                'subtotal' => $subtotal,
                'original_subtotal' => $originalSubtotal,
                'total_discount' => $totalDiscount,
                'shipping_cost' => $shippingCost,
                'tax_amount' => $taxAmount,
                'total_amount' => $total,
                'valid_until' => now()->addDays(7),
                'notes' => $request->notes ?? null,
                'items_data' => $itemsForDb,
            ]);

            $quotationData = [
                'quotation_number' => $quotationNumber,
                'date' => now()->format('F d, Y'),
                'valid_until' => now()->addDays(7)->format('F d, Y'),
                'customer' => [
                    'name' => $request->first_name.' '.$request->last_name,
                    'email' => $request->customer_email ?? 'Not provided',
                    'phone' => $request->customer_phone,
                    'address' => $request->billing_address_line_1 ?? 'Not provided',
                    'city' => $request->billing_city ?? 'Not provided',
                    'state' => $request->billing_state ?? '',
                    'postal_code' => $request->billing_postal_code ?? '',
                    'country' => $request->billing_country ?? 'Sri Lanka',
                ],
                'items' => $cartProducts,
                'subtotal' => $subtotal,
                'original_subtotal' => $originalSubtotal,
                'total_discount' => $totalDiscount,
                'shipping_cost' => $shippingCost,
                'tax_amount' => $taxAmount,
                'total' => $total,
                'notes' => $request->notes ?? '',
            ];

            $pdf = Pdf::loadView('quotations.pdf', $quotationData);
            $pdf->setPaper('A4', 'portrait');
            $pdf->setOptions([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
                'defaultFont' => 'DejaVu Sans',
            ]);

            return $pdf->download('CeylonIT-Quotation-'.$quotationNumber.'.pdf');
        } catch (Throwable $e) {
            \Log::error('Quotation generate failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->route('checkout.index')
                ->withInput()
                ->with('error', 'Could not generate your quotation. Please try again or contact us if this continues.');
        }
    }
}
