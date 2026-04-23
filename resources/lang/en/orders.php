<?php

return [

    'page_title' => 'My Orders',
    'empty' => 'You have no orders yet.',

    'order_number' => 'Order #:id',
    'order_title' => 'Order #:id',

    'status_label' => 'Status',

    'date' => 'Date',
    'total' => 'Total',

    'view_details' => 'View details',

    'placed_on' => 'Placed on',
    'items_title' => 'Items',

    'product_fallback' => 'Product',

    'quantity' => 'Quantity',

    'summary_title' => 'Summary',
    'subtotal' => 'Subtotal',
    'shipping' => 'Shipping',

    'back_to_orders' => 'Back to orders',

    /*
    |--------------------------------------------------------------------------
    | Cancel
    |--------------------------------------------------------------------------
    */

    'cancel_order' => 'Cancel order',
    'confirm_cancel' => 'Are you sure you want to cancel this order?',
    'cancel_success' => 'Order cancelled successfully.',
    'cancel_not_allowed' => 'This order can no longer be cancelled.',

    /*
    |--------------------------------------------------------------------------
    | Fulfillment statuses
    |--------------------------------------------------------------------------
    */

    'fulfillment_statuses' => [
        'new' => 'New',
        'processing' => 'Processing',
        'ready_for_pickup' => 'Ready for pickup',
        'shipped' => 'Shipped',
        'delivered' => 'Delivered',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ],
    'payment_statuses' => [
        'unpaid' => 'Unpaid',
        'pending' => 'Pending',
        'paid' => 'Paid',
        'failed' => 'Failed',
        'refunded' => 'Refunded',
    ],

    'payment_methods' => [
        'card' => 'Card',
        'cod' => 'Cash on delivery',
        'pickup' => 'Pickup',
    ],
];