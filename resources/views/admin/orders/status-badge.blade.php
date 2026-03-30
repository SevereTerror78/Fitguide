@php
  $ps = $payment_status ?? 'unpaid';
  $fs = $fulfillment_status ?? 'new';
  $pm = $payment_method ?? 'card';

<<<<<<< HEAD
<<<<<<< HEAD
  $pretty = fn($s) => ucfirst(str_replace('_', ' ', $s));

=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
  // Színek – visszafogott, de informatív
  $color = match($ps) {
    'paid' => 'text-green-700',
    'failed' => 'text-red-700',
    'pending' => 'text-yellow-700',
<<<<<<< HEAD
<<<<<<< HEAD
    default => 'text-gray-700', // unpaid
  };

  $method = match($pm) {
    'cod' => 'COD',
    'pickup' => 'Pickup',
    default => 'Card',
  };
@endphp

<span class="font-semibold {{ $color }}">
  {{ $pretty($ps) }}
</span>
<span class="mx-1 text-gray-400">·</span>
<span class="text-gray-700">
  {{ $pretty($fs) }}
</span>
<span class="text-gray-400">
  ({{ $method }})
</span>
=======
=======
>>>>>>> 5c55d34 (new features)
    default => 'text-gray-700', // unpaid, refunded, stb.
  };

  $psLabel = __('admin.orders.payment_status.' . $ps);
  $fsLabel = __('admin.orders.fulfillment_status.' . $fs);
  $pmLabel = __('admin.orders.payment_method.' . $pm);
@endphp

<span class="font-semibold {{ $color }}">
  {{ $psLabel }}
</span>
<span class="mx-1 text-gray-400">·</span>
<span class="text-gray-700">
  {{ $fsLabel }}
</span>
<span class="text-gray-400">
  ({{ $pmLabel }})
<<<<<<< HEAD
</span>
>>>>>>> fc7673c (frontend update and some new feature)
=======
</span>
>>>>>>> 5c55d34 (new features)
