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

  $fulfillmentStatus = strtolower($order->fulfillment_status ?? 'new');
  $confirmCancelText = __('orders.confirm_cancel');
@endphp

<section class="section-cards" style="padding-top:26px;">
  <div class="container order-page">

    @if(session('success'))
      <div class="alert alert-success" style="margin-bottom:16px;">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-error" style="margin-bottom:16px;">
        {{ session('error') }}
      </div>
    @endif

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

        <div class="order-items">
          @foreach ($order->items as $item)
            @php
              $product = $item->product;
              $name = $product?->translated_name ?? $item->name ?? __('orders.product_fallback');
              $qty  = (int) ($item->qty ?? 0);
              $unit = (int) ($item->unit_price ?? 0);
              $line = (int) ($item->line_total ?? ($qty * $unit));

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

          <div class="status-pill">
            {{ __('orders.payment_statuses.' . $order->payment_status) }}
            ·
            {{ __('orders.fulfillment_statuses.' . $order->fulfillment_status) }}

            @if($order->payment_method)
              ({{ __('orders.payment_methods.' . $order->payment_method) }})
            @endif
          </div>
        </div>

        <div class="summary-actions">
          <a href="{{ route('orders.index') }}" class="btn pill ghost">
            <i class="fa-solid fa-arrow-left"></i>
            {{ __('orders.back_to_orders') }}
          </a>

          @if($order->canBeCancelledByUser())
            <form method="POST"
                  action="{{ route('orders.cancel', $order) }}"
                  class="js-cancel-order-form"
                  data-confirm="{{ $confirmCancelText }}">
              @csrf
              @method('PATCH')

              <button type="submit" class="btn pill danger">
                <i class="fa-solid fa-xmark"></i>
                {{ __('orders.cancel_order') }}
              </button>
            </form>
          @endif
        </div>
      </aside>
    </div>

  </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.js-cancel-order-form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            var message = form.getAttribute('data-confirm') || 'Are you sure?';
            if (!window.confirm(message)) {
                e.preventDefault();
            }
        });
    });
});
</script>
@endpush