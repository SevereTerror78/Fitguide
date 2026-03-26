@php
  $ps = $payment_status ?? 'unpaid';
  $fs = $fulfillment_status ?? 'new';
  $pm = $payment_method ?? 'card';

  $pretty = fn($s) => ucfirst(str_replace('_', ' ', $s));

  // Színek – visszafogott, de informatív
  $color = match($ps) {
    'paid' => 'text-green-700',
    'failed' => 'text-red-700',
    'pending' => 'text-yellow-700',
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
