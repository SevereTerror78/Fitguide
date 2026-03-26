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
        </div>
      </div>
    </div>

    <div class="order-grid">

      {{-- ITEMS --}}
      <section class="order-card">
        <h2 class="section-title">Items</h2>

        <div class="order-items">
          @foreach ($order->items as $item)
            @php
              $product = $item->product;

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
              </div>

              <div class="item-info">
                <div class="item-name">{{ $name }}</div>
                <div class="item-sub">
                  Quantity: <strong>{{ $qty }}</strong>
                </div>
              </div>

              <div class="item-price">
                €{{ number_format($line, 2) }}
              </div>
            </div>
          @endforeach
        </div>
      </section>

      {{-- SUMMARY --}}
      <aside class="order-summary">
        <div class="summary-card">
          <h2 class="section-title">Summary</h2>

          <div class="sum-row">
            <span>Subtotal</span>
            <span>€{{ number_format($order->subtotal, 2) }}</span>
          </div>

          <div class="sum-row">
            <span>Shipping</span>
            <span>€{{ number_format($order->shipping ?? 0, 2) }}</span>
          </div>

          <div class="sum-divider"></div>

          <div class="sum-row total">
            <span>Total</span>
            <span>€{{ number_format($order->total, 2) }}</span>
          </div>

          @if(!empty($order->status))
            <div class="status-pill">
              Status: {{ ucfirst($order->status) }}
            </div>
          @endif
        </div>

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
