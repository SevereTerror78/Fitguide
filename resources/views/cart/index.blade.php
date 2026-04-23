@extends('layouts.main')
@section('title', __('cart.page_title') . ' • FitGuide')

@push('head')
  <link rel="stylesheet" href="{{ asset('css/cart.css') }}" />
@endpush

@push('scripts')
  <script src="{{ asset('js/shop.js') }}" defer></script>
  <script src="{{ asset('js/navbar.js') }}" defer></script>
@endpush

@section('content')

@php
  $currency = auth()->user()?->currency ?? session('currency', 'HUF');

  $formatMoney = function ($amountHuf) use ($currency) {
      if ($currency === 'EUR') {
          $eur = round($amountHuf / 381, 2);
          return '€' . number_format($eur, 2, '.', ' ');
      }

      return number_format($amountHuf, 0, ',', ' ') . ' Ft';
  };
@endphp

  <div class="cart-header">
    <div class="cart-icon">
      <i class="fa-solid fa-cart-shopping"></i>
    </div>
    <div class="cart-text">
      <h1>{{ __('cart.title') }}</h1>
      <p>{{ __('cart.subtitle') }}</p>
    </div>
  </div>

  <section class="section-cards">
    <div class="container" style="max-width: 1000px;">

      @if(empty($cart))
        <div class="empty-cart">
          <div class="empty-cart__icon">
            <i class="fa-solid fa-store"></i>
          </div>
          <h2>{{ __('cart.empty.title') }}</h2>
          <p>{{ __('cart.empty.subtitle') }}</p>
          <a class="btn pill empty-cart__cta" href="{{ route('store.index') }}">
            {{ __('cart.empty.go_to_store') }}
          </a>
        </div>

      @else
        <div class="cart-card container">

          <div class="cart-card__main">
            <div class="cart-table">

              <div class="cart-head row">
                <div class="Fejlec">{{ __('cart.table.product') }}</div>
                <div class="Fejlec">{{ __('cart.table.price') }}</div>
                <div class="Fejlec">{{ __('cart.table.quantity') }}</div>
                <div class="Fejlec">{{ __('cart.table.total') }}</div>
                <div class="Fejlec">{{ __('cart.table.actions') }}</div>
              </div>

              @foreach ($cart as $item)
                @php
                  $unitPriceHuf = $item['price_huf'] ?? 0;
                  $lineTotalHuf = $unitPriceHuf * $item['qty'];
                @endphp

                <div class="cart-row row">

                  <div class="cell cell--name">
                    <div class="title">
                      @php
                        $p = \App\Models\Product::find($item['product_id']);
                      @endphp
                      {{ $p?->translated_name ?? $item['name'] }}
                    </div>
                  </div>

                  <div class="cell cell--price">
                    <span class="price">
                      {{ $formatMoney($unitPriceHuf) }}
                    </span>
                  </div>

                  <div class="cell cell--qty">
                    <form class="qty-form" data-update-url="{{ route('cart.update', $item['product_id']) }}">
                      @csrf
                      <button type="button" class="qty-btn minus">−</button>
                      <input type="number" name="qty" min="1" value="{{ $item['qty'] }}" class="qty-input" />
                      <button type="button" class="qty-btn plus">+</button>
                    </form>
                  </div>

                  <div class="cell cell--total">
                    <span class="line-total" data-price-huf="{{ $unitPriceHuf }}">
                      {{ $formatMoney($lineTotalHuf) }}
                    </span>
                  </div>

                  <div class="cell cell--actions">
                    <form method="POST" action="{{ route('cart.remove', $item['product_id']) }}">
                      @csrf
                      <button type="submit" class="icon-btn is-danger">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    </form>
                  </div>

                </div>
              @endforeach

            </div>

            <form method="POST" action="{{ route('cart.clear') }}">
              @csrf
              <button class="btn ghost danger clear-cart-btn">
                <i class="fa-solid fa-trash-can"></i>
                {{ __('cart.clear_cart') }}
              </button>
            </form>

          </div>

          <aside class="cart-card__aside">
            <div class="summary-card"
              data-discount-percent="{{ session('discount.percent', 0) }}"
              data-discount-code="{{ session('discount.code', '') }}">

              <h3>{{ __('cart.summary.title') }}</h3>

              <div class="discount-box">
                <label class="discount-label">{{ __('cart.summary.discount_label') }}</label>

                <div class="discount-row">
                  <input
                    type="text"
                    id="discount-code"
                    class="discount-input"
                    placeholder="{{ __('cart.summary.discount_placeholder') }}"
                    autocomplete="off"
                    value="{{ session('discount.code', '') }}"
                  />

                  <button
                    type="button"
                    id="apply-discount"
                    class="btn pill discount-apply"
                    data-mode="{{ session()->has('discount') ? 'remove' : 'apply' }}"
                    data-label-apply="{{ __('cart.summary.apply') }}"
                    data-label-remove="{{ __('cart.summary.remove') }}"
                  >
                    {{ session()->has('discount') ? __('cart.summary.remove') : __('cart.summary.apply') }}
                  </button>
                </div>

                <div
                    id="discount-message"
                    class="discount-message"
                    data-msg-enter="{{ __('cart.discount.msg_enter') }}"
                    data-msg-failed="{{ __('cart.discount.msg_failed') }}"
                    data-msg-network="{{ __('cart.discount.msg_network') }}"
                  >
                  @if(session()->has('discount'))
                    {{ __('cart.summary.discount_applied', ['percent' => session('discount.percent')]) }}
                  @endif
                </div>
              </div>

              <div class="sum-row">
                <span>{{ __('cart.summary.subtotal') }}</span>
                <strong id="cart-subtotal">{{ $formatMoney($subtotal) }}</strong>
              </div>

              <div class="sum-row {{ session()->has('discount') ? '' : 'is-hidden' }}" id="discount-line">
                <span>{{ __('cart.summary.discount') }}</span>
                <strong id="cart-discount">{{ $formatMoney($discount ?? 0) }}</strong>
              </div>

              <div class="sum-row total">
                <span>{{ __('cart.summary.total') }}</span>
                <strong id="cart-total">{{ $formatMoney($total) }}</strong>
              </div>

              <a href="{{ route('checkout.show') }}" class="btn pill large" style="width:100%; margin-top:12px;">
                {{ __('cart.summary.checkout') }}
              </a>

            </div>
          </aside>

        </div>
      @endif

    </div>
  </section>

@endsection