<?php

return [
  'page_title' => 'Fizetés',
  'page_subtitle' => 'Ellenőrizd a rendelésed, és add meg az adataidat.',
  'details_title' => 'Adatok',

  'full_name' => 'Teljes név',
  'address_line1' => 'Cím (1. sor)',
  'address_line2' => 'Cím (2. sor) (opcionális)',
  'city' => 'Város',
  'postal_code' => 'Irányítószám',
  'country' => 'Ország',
  'select_country' => 'Válassz országot...',

  'pickup_location' => 'Átvételi pont',
  'select_pickup' => 'Válassz átvételi pontot...',

  'pickup_points' => [
    'budapest' => 'Budapest — 1051, Arany János utca 10. (HU)',
    'debrecen' => 'Debrecen — 4025, Piac utca 12. (HU)',
    'miskolc' => 'Miskolc — 3525, Széchenyi utca 15. (HU)',
    'szeged' => 'Szeged — 6720, Kárász utca 9. (HU)',
    'gyor' => 'Győr — 9022, Baross Gábor út 18. (HU)',
  ],

  'payment_method' => 'Fizetési mód',

  'pay_with_card' => 'Bankkártyás fizetés',
  'pay_with_card_sub' => '(Hitel-/betéti kártya Stripe-on keresztül)',

  'cash_on_delivery' => 'Utánvét',
  'cash_on_delivery_sub' => 'Fizetés a futárnak átvételkor',

  'personal_pickup' => 'Személyes átvétel',
  'personal_pickup_sub' => 'Vedd át a rendelést az átvételi pontunkon',

  'btn_pay_card' => 'Fizetés bankkártyával',
  'btn_place_cod' => 'Rendelés leadása (utánvét)',
  'btn_place_pickup' => 'Rendelés leadása (átvétel)',

  'order_summary' => 'Rendelés összegzés',
  'subtotal' => 'Részösszeg',
  'shipping' => 'Szállítás',
  'total' => 'Végösszeg',

  'order_id' => 'Rendelés azonosító',
  'back_to_store' => 'Vissza a boltba',
  'back_to_checkout' => 'Vissza a fizetéshez',

  'payment_success_title' => 'Sikeres fizetés',
  'payment_success_heading' => 'Sikeres fizetés',
  'payment_success_desc' => 'Köszönjük! A fizetés sikeres volt. A rendelésedet a háttérben véglegesítjük (webhook).',

  'payment_cancelled_title' => 'Fizetés megszakítva',
  'payment_cancelled_heading' => 'Fizetés megszakítva',
  'payment_cancelled_desc' => 'Megszakítottad a fizetést. A rendelés nincs kifizetve.',
];