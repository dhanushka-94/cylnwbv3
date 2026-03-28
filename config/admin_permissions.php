<?php

/**
 * Staff may access only the route names listed here (exact match).
 * Admins bypass this list and may access all admin routes.
 *
 * @see \App\Models\User::canAccessAdminRoute()
 */
return [
    'staff_routes' => [
        // Dashboard
        'admin.dashboard',
        'admin.analytics',

        // Orders (no delete)
        'admin.orders.index',
        'admin.orders.create',
        'admin.orders.store',
        'admin.orders.show',
        'admin.orders.statistics',
        'admin.orders.update-status',
        'admin.orders.update-payment',

        // Quotations (no delete, no bulk destructive)
        'admin.quotations.index',
        'admin.quotations.show',
        'admin.quotations.statistics',
        'admin.quotations.update-status',
        'admin.quotations.add-notes',
        'admin.quotations.download',

        // Payments: view / export only
        'admin.transactions.index',
        'admin.transactions.show',
        'admin.transactions.export',

        // Homepage sliders (full CRUD for merchandising)
        'admin.sliders.index',
        'admin.sliders.create',
        'admin.sliders.store',
        'admin.sliders.show',
        'admin.sliders.edit',
        'admin.sliders.update',
        'admin.sliders.destroy',
    ],
];
