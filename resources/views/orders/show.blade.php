@extends('layouts.store')
@section('title', 'Order #' . $order->id . ' • FitGuide')

@section('content')
<section class="section-cards" style="padding-top: 26px;">
  <div class="container order-page">

    <div class="order-top">
      <div>
        <h1 class="order-title">Order #{{ $order->id }}</h1>
        <div class="order-meta">Placed on: {{ $order->created_at->format('Y-m-d H:i') }}</div>
      </div>

      <div class="order-actions">
        <a href="{{ url()->previous() }}" class="btn pill ghost">
          <i class="fa-solid fa-arrow-left"></i> Back
        </a>
        <a href="{{ url('/orders') }}" class="btn pill">
          All orders
        </a>
      </div>
    </div>

    <div class="order-grid">
      <section class="order-card">
        <h2 class="section-title">Items</h2>

        <div class="order-items">
          @foreach ($order->items as $item)
            @php
              $product = $item->product;
              $img = $product?->image_url ?? asset('images/placeholder-product.png');
              $name = $product?->name ?? 'Product';
            @endphp

            <div class="order-item">
              <div class="item-img">
                <img src="{{ $img }}" alt="{{ $name }}">
              </div>

              <div class="item-info">
                <div class="item-name">{{ $name }}</div>
                <div class="item-sub">Quantity: {{ $item->quantity }}</div>
              </div>

              <div class="item-price">
                €{{ number_format($item->price * $item->quantity, 2) }}
              </div>
            </div>
          @endforeach
        </div>
      </section>

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
            <div class="status-pill">Status: {{ ucfirst($order->status) }}</div>
          @endif
        </div>
      </aside>
    </div>

  </div>
</section>
@endsection
