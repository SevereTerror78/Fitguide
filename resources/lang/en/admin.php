<?php

return [
    'layout' => [
        'title' => 'FitGuide Admin',
        'admin' => 'Admin',
    ],

    'nav' => [
        'dashboard' => 'Dashboard',
        'products' => 'Products',
        'orders' => 'Orders',
        'users' => 'Users',
        'notifications' => 'Notifications',
        'settings' => 'Settings',
        'back_to_site' => 'Back to Site',
        'logout' => 'Logout',
    ],

    'dashboard' => [
        'title' => 'Dashboard',
        'sales_today' => 'Sales Today',
        'active_products' => 'Active Products',
        'out_of_stock' => 'Out of Stock',
        'active_users' => 'Active Users',
        'sales_this_week' => 'Sales This Week',
        'recent_orders' => 'Recent Orders',
        'unknown_customer' => 'Unknown',
        'no_recent_orders' => 'No recent orders.',
        'table' => [
            'order' => 'Order',
            'customer' => 'Customer',
            'date' => 'Date',
            'total' => 'Total',
        ],
    ],
    'users' => [
    'title' => 'Users',
    'search_placeholder' => 'Search users...',
    'search_button' => 'Search',

    'roles' => [
        'all' => 'All Roles',
        'admin' => 'Admin',
        'user' => 'User',
    ],

    'table' => [
        'name' => 'Name',
        'email' => 'Email',
        'role' => 'Role',
        'registered' => 'Registered',
        'actions' => 'Actions',
    ],

    'actions' => [
        'edit_title' => 'Edit User',
        'delete_title' => 'Delete User',
    ],

    'confirm_delete' => 'Are you sure you want to delete this user?',
    'no_users_found' => 'No users found.',

    'edit_title' => 'Edit User',

    'form' => [
        'name' => 'Name',
        'email' => 'Email',
        'role' => 'Role',
    ],

    'save_changes' => 'Save Changes',
    ],
    'common' => [
    'cancel' => 'Cancel',
],

'pagination' => [
    'showing' => 'Showing :from to :to of :total results',
],

'products' => [
    'title' => 'Products',
    'search_placeholder' => 'Search products',
    'add_product' => 'Add Product',
    'flash' => [
        'created' => 'Product created successfully!',
        'updated' => 'Product updated successfully.',
        'deleted' => 'Product deleted successfully.',
    ],

    'filters' => [
        'all_categories' => 'All Categories',
        'all' => 'All',
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    'table' => [
        'image' => 'Image',
        'name' => 'Name',
        'price' => 'Price',
        'stock' => 'Stock',
        'category' => 'Category',
        'status' => 'Status',
        'actions' => 'Actions',
    ],

    'actions' => [
        'edit_title' => 'Edit',
        'delete_title' => 'Delete',
    ],

    'no_products_found' => 'No products found.',
    'confirm_delete' => 'Are you sure you want to delete this product?',

    'edit_title' => 'Edit Product',
    'create_title' => 'Add New Product',

    'form' => [
        'name' => 'Name',
        'description' => 'Description',
        'price' => 'Price',
        'price_eur' => 'Price (€)',
        'stock' => 'Stock',
        'category' => 'Category',
        'status' => 'Status',
        'image' => 'Image',
        'product_image' => 'Product Image',
        'image_help' => "JPG, PNG, WebP • max 2MB. If you don’t upload a new image, the current one will stay.",
    ],

    'alt' => [
        'product_image' => 'Product image',
    ],

    'save_changes' => 'Save Changes',
    'save_product' => 'Save Product',
    ],
    
    'notifications' => [
        'title' => 'Notifications',
        'subtitle' => 'System alerts & low stock warnings',

        'unread' => 'Unread',
        'mark_all_read' => 'Mark all as read',

        'badges' => [
            'unread' => 'UNREAD',
            'read' => 'Read',
        ],

        'types' => [
            'general' => 'General',
            'low_stock' => 'Low stock',
            'order_new' => 'New order',
            'order_paid' => 'Paid order',
        ],

        'meta' => [
            'stock' => 'Stock',
            'threshold' => 'Threshold',
        ],

        'actions' => [
            'view_product' => 'View product',
            'mark_read' => 'Mark read',
        ],

        'empty' => [
            'title' => 'No notifications yet.',
            'subtitle' => 'Low stock and system alerts will appear here.',
        ],

        'low_stock_title' => 'Low stock',
        'low_stock_message' => 'Product ":name" is below :threshold in stock.',
    ],
    'orders' => [
    'title' => 'Orders',

    'filters' => [
        'payment' => 'Payment',
        'fulfillment' => 'Fulfillment',
        'method' => 'Method',
        'all' => 'All',
        'filter_button' => 'Filter',
        'reset_button' => 'Reset',
    ],

    'table' => [
        'order' => 'Order',
        'user' => 'User',
        'total' => 'Total',
        'date' => 'Date',
        'status' => 'Status',
    ],

    'payment_status' => [
        'unpaid' => 'Unpaid',
        'pending' => 'Pending',
        'paid' => 'Paid',
        'failed' => 'Failed',
        'refunded' => 'Refunded',
    ],

    'fulfillment_status' => [
        'new' => 'New',
        'processing' => 'Processing',
        'ready_for_pickup' => 'Ready for pickup',
        'shipped' => 'Shipped',
        'delivered' => 'Delivered',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ],

    'payment_method' => [
        'card' => 'Card',
        'cod' => 'COD',
        'pickup' => 'Pickup',
    ],
    ],
];