<?php

/**
 * Primary bank account for bank transfers (checkout, emails, bank details page).
 */
return [
    'account_name' => 'CEYLON IT SOLUTIONS PVT LTD',
    'account_number' => '1001079620',
    'bank_name' => 'Commercial Bank',
    'branch' => 'Embilipitiya',

    /** WhatsApp (digits only, country code, no +) — contact, floating button, payment slips, wa.me links */
    'whatsapp_payment_number' => env('WHATSAPP_NUMBER', env('PAYMENT_WHATSAPP_NUMBER', '971581811579')),
    'whatsapp_payment_display' => env('WHATSAPP_DISPLAY', env('PAYMENT_WHATSAPP_DISPLAY', '+971 58 181 1579')),
];
