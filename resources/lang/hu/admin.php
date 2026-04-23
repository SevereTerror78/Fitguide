<?php

return [
    'layout' => [
        'title' => 'FitGuide Admin',
        'admin' => 'Admin',
    ],

    'nav' => [
        'dashboard' => 'Vezérlőpult',
        'products' => 'Termékek',
        'orders' => 'Rendelések',
        'users' => 'Felhasználók',
        'notifications' => 'Értesítések',
        'settings' => 'Beállítások',
        'back_to_site' => 'Vissza az oldalra',
        'logout' => 'Kijelentkezés',
    ],

    'common' => [
        'cancel' => 'Mégse',
    ],

    'pagination' => [
        'showing' => ':from–:to / összesen :total találat',
    ],

    'notifications' => [
    'title' => 'Értesítések',
    'subtitle' => 'Rendszerüzenetek és alacsony készlet figyelmeztetések',

    'unread' => 'Olvasatlan',
    'mark_all_read' => 'Megjelölés olvasottként',

    'badges' => [
        'unread' => 'OLVASATLAN',
        'read' => 'Olvasott',
    ],

    'types' => [
        'general' => 'Általános',
        'low_stock' => 'Alacsony készlet',
        'order_new' => 'Új rendelés',
        'order_paid' => 'Fizetett rendelés',
    ],

    'meta' => [
        'stock' => 'Készlet',
        'threshold' => 'Küszöb',
    ],

    'actions' => [
        'view_product' => 'Termék megnyitása',
        'mark_read' => 'Olvasottra',
    ],

    'actions' => [
        'back' => 'Vissza',
    ],

    'empty' => [
        'title' => 'Még nincs értesítés.',
        'subtitle' => 'Az alacsony készlet és rendszerüzenetek itt fognak megjelenni.',
    ],

    // Ezeket meghagyjuk, mert a low stock üzenetet a controller is használhatja:
    'low_stock_title' => 'Alacsony készlet',
    'low_stock_message' => 'A(z) ":name" termék készlete :threshold alá csökkent.',
    ],

    'dashboard' => [
        'title' => 'Vezérlőpult',
        'sales_today' => 'Mai eladások',
        'active_products' => 'Aktív termékek',
        'out_of_stock' => 'Kifogyott',
        'active_users' => 'Aktív felhasználók',
        'sales_this_week' => 'Heti eladások',
        'recent_orders' => 'Legutóbbi rendelések',
        'unknown_customer' => 'Ismeretlen',
        'no_recent_orders' => 'Nincs friss rendelés.',
        'table' => [
            'order' => 'Rendelés',
            'customer' => 'Vásárló',
            'date' => 'Dátum',
            'total' => 'Összeg',
        ],
    ],

    'users' => [
        'title' => 'Felhasználók',
        'search_placeholder' => 'Felhasználók keresése...',
        'search_button' => 'Keresés',

        'roles' => [
            'all' => 'Összes szerepkör',
            'admin' => 'Admin',
            'user' => 'Felhasználó',
        ],

        'table' => [
            'name' => 'Név',
            'email' => 'Email',
            'role' => 'Szerepkör',
            'registered' => 'Regisztráció',
            'actions' => 'Műveletek',
        ],

        'actions' => [
            'edit_title' => 'Felhasználó szerkesztése',
            'delete_title' => 'Felhasználó törlése',
        ],

        'confirm_delete' => 'Biztosan törölni szeretnéd ezt a felhasználót?',
        'no_users_found' => 'Nincs találat.',
        'edit_title' => 'Felhasználó szerkesztése',

        'form' => [
            'name' => 'Név',
            'email' => 'Email',
            'role' => 'Szerepkör',
        ],

        'save_changes' => 'Változtatások mentése',
    ],

    'products' => [
        'title' => 'Termékek',
        'search_placeholder' => 'Termékek keresése',
        'add_product' => 'Termék hozzáadása',

        'flash' => [
            'created' => 'A termék sikeresen létrehozva.',
            'updated' => 'A termék sikeresen frissítve.',
            'deleted' => 'A termék sikeresen törölve.',
        ],

        'filters' => [
            'all_categories' => 'Összes kategória',
            'all' => 'Összes',
            'active' => 'Aktív',
            'inactive' => 'Inaktív',
        ],

        'table' => [
            'image' => 'Kép',
            'name' => 'Név',
            'price' => 'Ár',
            'stock' => 'Készlet',
            'category' => 'Kategória',
            'status' => 'Státusz',
            'actions' => 'Műveletek',
        ],

        'actions' => [
            'edit_title' => 'Szerkesztés',
            'delete_title' => 'Törlés',
            'back' => 'Vissza',
        ],

        'no_products_found' => 'Nincs találat.',
        'confirm_delete' => 'Biztosan törölni szeretnéd ezt a terméket?',

        'edit_title' => 'Termék szerkesztése',
        'create_title' => 'Új termék hozzáadása',

        'form' => [
            'name' => 'Név',
            'description' => 'Leírás',
            'price' => 'Ár',
            'price_eur' => 'Ár (€)',
            'stock' => 'Készlet',
            'category' => 'Kategória',
            'status' => 'Státusz',
            'image' => 'Kép',
            'product_image' => 'Termékkép',
            'image_help' => 'JPG, PNG, WebP • max 2MB. Ha nem töltesz fel új képet, a jelenlegi megmarad.',
        ],

        'alt' => [
            'product_image' => 'Termékkép',
        ],

        'save_changes' => 'Változtatások mentése',
        'save_product' => 'Termék mentése',
    ],
    'orders' => [
    'title' => 'Rendelések',

    'filters' => [
        'payment' => 'Fizetés',
        'fulfillment' => 'Teljesítés',
        'method' => 'Mód',
        'all' => 'Összes',
        'filter_button' => 'Szűrés',
        'reset_button' => 'Visszaállítás',
    ],

    'table' => [
        'order' => 'Rendelés',
        'user' => 'Felhasználó',
        'total' => 'Összeg',
        'date' => 'Dátum',
        'status' => 'Státusz',
    ],

    'payment_status' => [
        'unpaid' => 'Nincs fizetve',
        'pending' => 'Függőben',
        'paid' => 'Fizetve',
        'failed' => 'Sikertelen',
        'refunded' => 'Visszatérítve',
    ],

    'fulfillment_status' => [
        'new' => 'Új',
        'processing' => 'Feldolgozás alatt',
        'ready_for_pickup' => 'Átvételre kész',
        'shipped' => 'Kiszállítva',
        'delivered' => 'Kézbesítve',
        'completed' => 'Lezárva',
        'cancelled' => 'Törölve',
    ],

    'payment_method' => [
        'card' => 'Kártya',
        'cod' => 'Utánvét',
        'pickup' => 'Személyes átvétel',
    ],
    'empty' => 'Nincs találat.',
    ],
];