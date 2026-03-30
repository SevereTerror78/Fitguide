<<<<<<< HEAD
<<<<<<< HEAD
@extends('layouts.store')
@section('title', 'Order #' . $order->id . ' • FitGuide')

@section('content')
<body data-theme="{{ auth()->check() ? (auth()->user()->theme ?? 'dark') : 'dark' }}">
<section class="section-cards" style="padding-top: 26px;">
  <div class="container order-page">

    {{-- HEADER --}}
    <div class="order-top">
      <div>
        <h1 class="order-title">Order #{{ $order->id }}</h1>
        <div class="order-meta">
          Placed on: {{ $order->created_at->format('Y-m-d H:i') }}
=======
@extends('layouts.main')
@section('title', __('orders.order_title', ['id' => $order->id]) . ' • FitGuide')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
@endsection

@section('content')
<section class="section-cards" style="padding-top:26px;">
  <div class="container order-page">

    <div class="order-top">
      <div>
        <h1 class="order-title">{{ __('orders.order_title', ['id' => $order->id]) }}</h1>
        <div class="order-meta">
          {{ __('orders.placed_on') }}: {{ $order->created_at->format('Y-m-d H:i') }}
>>>>>>> fc7673c (frontend update and some new feature)
        </div>
      </div>
    </div>

    <div class="order-grid">
<<<<<<< HEAD

      {{-- ITEMS --}}
      <section class="order-card">
        <h2 class="section-title">Items</h2>
=======
      <section class="order-card">
        <h2 class="section-title">{{ __('orders.items_title') }}</h2>
>>>>>>> fc7673c (frontend update and some new feature)

=======
@extends('layouts.main')
@section('title', __('orders.order_title', ['id' => $order->id]) . ' • FitGuide')
 
@section('head')
<link rel="stylesheet" href="{{ asset('css/orders.css') }}">
@endsection
 
@section('content')
@php
  $currency = auth()->user()?->currency ?? session('currency', 'HUF');
 
  $formatMoney = function ($amountHuf) use ($currency) {
      if ($currency === 'EUR') {
          $eur = round(((int) $amountHuf) / 381, 2);
          return '€' . number_format($eur, 2, '.', ' ');
      }
 
      return number_format((int) $amountHuf, 0, ',', ' ') . ' Ft';
  };
@endphp
 
<section class="section-cards" style="padding-top:26px;">
<div class="container order-page">
 
    <div class="order-top">
<div>
<h1 class="order-title">{{ __('orders.order_title', ['id' => $order->id]) }}</h1>
<div class="order-meta">
          {{ __('orders.placed_on') }}: {{ $order->created_at->format('Y-m-d H:i') }}
</div>
</div>
</div>
 
    <div class="order-grid">
<section class="order-card">
<h2 class="section-title">{{ __('orders.items_title') }}</h2>
 
>>>>>>> 5c55d34 (new features)
        <div class="order-items">
          @foreach ($order->items as $item)
            @php
              $product = $item->product;
<<<<<<< HEAD
<<<<<<< HEAD

              // Név: nálad OrderItem->name mentve van
              $name = $product?->name ?? $item->name ?? 'Product';

              // qty / ár: nálad ezek a mezők
              $qty  = (int) ($item->qty ?? 0);
              $unit = (float) ($item->unit_price ?? 0);

              // line_total: ha van kitöltve, használd, különben számold
              $line = (float) ($item->line_total ?? ($qty * $unit));

              // Kép: a Product accessor intézi (placeholdert is)
              $img = $product?->image_url ?? asset('images/placeholder-product.png');
              $placeholder = asset('images/placeholder-product.png');
            @endphp
            <div class="order-item">
              <div class="item-img">
                <img
                  src="{{ $img }}"
                  alt="{{ $name }}"
                  loading="lazy"
                  onerror="this.onerror=null;this.src='{{ $placeholder }}';"
                >
=======
              $name = $product?->name ?? $item->name ?? __('orders.product_fallback');
              $qty  = (int) ($item->qty ?? 0);
              $unit = (float) ($item->unit_price ?? 0);
              $line = (float) ($item->line_total ?? ($qty * $unit));

              $img = $product?->image_url ?? asset('images/placeholder-product.png');
              $placeholder = asset('images/placeholder-product.png');
            @endphp

            <div class="order-item">
              <div class="item-img">
                <img src="{{ $img }}" alt="{{ $name }}" loading="lazy"
                     onerror="this.onerror=null;this.src='{{ $placeholder }}';">
>>>>>>> fc7673c (frontend update and some new feature)
              </div>

              <div class="item-info">
                <div class="item-name">{{ $name }}</div>
                <div class="item-sub">
<<<<<<< HEAD
                  Quantity: <strong>{{ $qty }}</strong>
                </div>
              </div>

              <div class="item-price">
                €{{ number_format($line, 2) }}
              </div>
=======
                  {{ __('orders.quantity') }}: <strong>{{ $qty }}</strong>
                </div>
              </div>

              <div class="item-price">€{{ number_format($line, 2) }}</div>
>>>>>>> fc7673c (frontend update and some new feature)
            </div>
          @endforeach
        </div>
      </section>

<<<<<<< HEAD
      {{-- SUMMARY --}}
      <aside class="order-summary">
        <div class="summary-card">
          <h2 class="section-title">Summary</h2>

          <div class="sum-row">
            <span>Subtotal</span>
=======
      <aside class="order-summary">
        <div class="summary-card">
          <h2 class="section-title">{{ __('orders.summary_title') }}</h2>

          <div class="sum-row">
            <span>{{ __('orders.subtotal') }}</span>
>>>>>>> fc7673c (frontend update and some new feature)
            <span>€{{ number_format($order->subtotal, 2) }}</span>
          </div>

          <div class="sum-row">
<<<<<<< HEAD
            <span>Shipping</span>
=======
            <span>{{ __('orders.shipping') }}</span>
>>>>>>> fc7673c (frontend update and some new feature)
            <span>€{{ number_format($order->shipping ?? 0, 2) }}</span>
          </div>

          <div class="sum-divider"></div>

          <div class="sum-row total">
<<<<<<< HEAD
            <span>Total</span>
=======
            <span>{{ __('orders.total') }}</span>
>>>>>>> fc7673c (frontend update and some new feature)
            <span>€{{ number_format($order->total, 2) }}</span>
          </div>

          @if(!empty($order->status))
            <div class="status-pill">
<<<<<<< HEAD
              Status: {{ ucfirst($order->status) }}
=======
              {{ __('orders.status_label') }}: {{ __('orders.statuses.' . strtolower($order->status)) }}
>>>>>>> fc7673c (frontend update and some new feature)
            </div>
          @endif
        </div>

<<<<<<< HEAD
        {{-- ACTION --}}
        <div class="summary-actions">
          <a href="{{ url('/orders') }}" class="btn pill ghost">
            <i class="fa-solid fa-arrow-left"></i> Back to orders
          </a>
        </div>
      </aside>

    </div>
  </div>
</section>
</body>
@endsection
=======
        <div class="summary-actions">
          <a href="{{ route('orders.index') }}" class="btn pill ghost">
            <i class="fa-solid fa-arrow-left"></i> {{ __('orders.back_to_orders') }}
          </a>
        </div>
      </aside>
    </div>

  </div>
</section>
@endsection
>>>>>>> fc7673c (frontend update and some new feature)
=======
              $name = $product?->translated_name ?? $item->name ?? __('orders.product_fallback');
              $qty  = (int) ($item->qty ?? 0);
              $unit = (int) ($item->unit_price ?? 0);
              $line = (int) ($item->line_total ?? ($qty * $unit));
 
              $img = $product?->image_url ?? asset('images/placeholder-product.png');
              $placeholder = asset('images/placeholder-product.png');
            @endphp
 
            <div class="order-item">
<div class="item-img">
<img src="{{ $img }}" alt="{{ $name }}" loading="lazy"
                     onerror="this.onerror=null;this.src='{{ $placeholder }}';">
</div>
 
              <div class="item-info">
<div class="item-name">{{ $name }}</div>
<div class="item-sub">
                  {{ __('orders.quantity') }}: <strong>{{ $qty }}</strong>
</div>
</div>
 
              <div class="item-price">{{ $formatMoney($line) }}</div>
</div>
          @endforeach
</div>
</section>
 
      <aside class="order-summary">
<div class="summary-card">
<h2 class="section-title">{{ __('orders.summary_title') }}</h2>
 
          <div class="sum-row">
<span>{{ __('orders.subtotal') }}</span>
<span>{{ $formatMoney($order->subtotal) }}</span>
</div>
 
          <div class="sum-row">
<span>{{ __('orders.shipping') }}</span>
<span>{{ $formatMoney($order->shipping ?? 0) }}</span>
</div>
 
          <div class="sum-divider"></div>
 
          <div class="sum-row total">
<span>{{ __('orders.total') }}</span>
<span>{{ $formatMoney($order->total) }}</span>
</div>
 
          @if(!empty($order->status))
<div class="status-pill">
              {{ __('orders.status_label') }}: {{ __('orders.statuses.' . strtolower($order->status)) }}
</div>
          @endif
</div>
 
        <div class="summary-actions">
<a href="{{ route('orders.index') }}" class="btn pill ghost">
<i class="fa-solid fa-arrow-left"></i> {{ __('orders.back_to_orders') }}
</a>
</div>
</aside>
</div>
 
  </div>
</section>
@endsection
>>>>>>> 5c55d34 (new features)
