<?php

return [

    'page_title' => 'Rendeléseim',
    'empty' => 'Még nincs rendelésed.',

    'order_number' => 'Rendelés #:id',
    'order_title' => 'Rendelés #:id',

    'status_label' => 'Státusz',

    'date' => 'Dátum',
    'total' => 'Összesen',

    'view_details' => 'Részletek',

    'placed_on' => 'Leadva',
    'items_title' => 'Termékek',

    'product_fallback' => 'Termék',

    'quantity' => 'Mennyiség',

    'summary_title' => 'Összegzés',
    'subtotal' => 'Részösszeg',
    'shipping' => 'Szállítás',

    'back_to_orders' => 'Vissza a rendelésekhez',

    /*
    |--------------------------------------------------------------------------
    | Lemondás
    |--------------------------------------------------------------------------
    */

    'cancel_order' => 'Rendelés lemondása',
    'confirm_cancel' => 'Biztosan le szeretnéd mondani ezt a rendelést?',
    'cancel_success' => 'A rendelést sikeresen lemondtuk.',
    'cancel_not_allowed' => 'Ez a rendelés már nem mondható le.',

    /*
    |--------------------------------------------------------------------------
    | Fulfillment státuszok
    |--------------------------------------------------------------------------
    */

    'fulfillment_statuses' => [
        'new' => 'Új',
        'processing' => 'Feldolgozás alatt',
        'ready_for_pickup' => 'Átvételre kész',
        'shipped' => 'Kiszállítva',
        'delivered' => 'Kézbesítve',
        'completed' => 'Lezárva',
        'cancelled' => 'Lemondva',
    ],
    'payment_statuses' => [
        'unpaid' => 'Nincs fizetve',
        'pending' => 'Függőben',
        'paid' => 'Fizetve',
        'failed' => 'Sikertelen',
        'refunded' => 'Visszatérítve',
    ],

    'payment_methods' => [
        'card' => 'Kártya',
        'cod' => 'Utánvét',
        'pickup' => 'Személyes átvétel',
    ],
];