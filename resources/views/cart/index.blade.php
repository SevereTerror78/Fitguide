@extends('layouts.main')
<<<<<<< HEAD
@section('title', 'Cart • FitGuide')
=======
@section('title', __('cart.page_title') . ' • FitGuide')
>>>>>>> fc7673c (frontend update and some new feature)

@push('head')
  <link rel="stylesheet" href="{{ asset('css/cart.css') }}" />
@endpush

@push('scripts')
  <script src="{{ asset('js/shop.js') }}" defer></script>
<<<<<<< HEAD
=======
  <script src="{{ asset('js/navbar.js') }}" defer></script>
>>>>>>> fc7673c (frontend update and some new feature)
@endpush

@section('content')

<<<<<<< HEAD
=======
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

>>>>>>> fc7673c (frontend update and some new feature)
  <div class="cart-header">
    <div class="cart-icon">
      <i class="fa-solid fa-cart-shopping"></i>
    </div>
    <div class="cart-text">
<<<<<<< HEAD
      <h1>Shopping Cart</h1>
      <p>Review your items and proceed to checkout</p>
=======
      <h1>{{ __('cart.title') }}</h1>
      <p>{{ __('cart.subtitle') }}</p>
>>>>>>> fc7673c (frontend update and some new feature)
    </div>
  </div>

  <section class="section-cards">
    <div class="container" style="max-width: 1000px;">

      @if(empty($cart))
        <div class="empty-cart">
          <div class="empty-cart__icon">
            <i class="fa-solid fa-store"></i>
          </div>
<<<<<<< HEAD
          <h2>Your cart is empty</h2>
          <p>Looks like you haven’t added anything yet.</p>
          <a class="btn pill empty-cart__cta" href="{{ route('store.index') }}">Go to store</a>
=======
          <h2>{{ __('cart.empty.title') }}</h2>
          <p>{{ __('cart.empty.subtitle') }}</p>
          <a class="btn pill empty-cart__cta" href="{{ route('store.index') }}">
            {{ __('cart.empty.go_to_store') }}
          </a>
>>>>>>> fc7673c (frontend update and some new feature)
        </div>

      @else
        <div class="cart-card container">

          <div class="cart-card__main">
            <div class="cart-table">

              <div class="cart-head row">
<<<<<<< HEAD
                <div class="Fejlec">Product</div>
                <div class="Fejlec">Price</div>
                <div class="Fejlec">Quantity</div>
                <div class="Fejlec">Total</div>
                <div class="Fejlec">Actions</div>
              </div>

              @foreach ($cart as $item)
                <div class="cart-row row">

                  <div class="cell cell--name">
                    <div class="title">{{ $item['name'] }}</div>
=======
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
>>>>>>> fc7673c (frontend update and some new feature)
                  </div>

                  <div class="cell cell--price">
                    <span class="price">
<<<<<<< HEAD
                      {{ number_format($item['price'], 2, ',', ' ') }} €
=======
                      {{ $formatMoney($unitPriceHuf) }}
>>>>>>> fc7673c (frontend update and some new feature)
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
<<<<<<< HEAD
                    <span class="line-total" data-price="{{ $item['price'] }}">
                      {{ number_format($item['price'] * $item['qty'], 2, ',', ' ') }} €
=======
                    <span class="line-total" data-price-huf="{{ $unitPriceHuf }}">
                      {{ $formatMoney($lineTotalHuf) }}
>>>>>>> fc7673c (frontend update and some new feature)
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
<<<<<<< HEAD
                <i class="fa-solid fa-trash-can"></i> Clear cart
=======
                <i class="fa-solid fa-trash-can"></i>
                {{ __('cart.clear_cart') }}
>>>>>>> fc7673c (frontend update and some new feature)
              </button>
            </form>

          </div>

          <aside class="cart-card__aside">
            <div class="summary-card"
              data-discount-percent="{{ session('discount.percent', 0) }}"
              data-discount-code="{{ session('discount.code', '') }}">

<<<<<<< HEAD
              <h3>Order summary</h3>

              <div class="discount-box">
                <label class="discount-label">Have a discount code?</label>
=======
              <h3>{{ __('cart.summary.title') }}</h3>

              <div class="discount-box">
                <label class="discount-label">{{ __('cart.summary.discount_label') }}</label>
>>>>>>> fc7673c (frontend update and some new feature)

                <div class="discount-row">
                  <input
                    type="text"
                    id="discount-code"
                    class="discount-input"
<<<<<<< HEAD
                    placeholder="Enter discount code"
=======
                    placeholder="{{ __('cart.summary.discount_placeholder') }}"
>>>>>>> fc7673c (frontend update and some new feature)
                    autocomplete="off"
                    value="{{ session('discount.code', '') }}"
                  />

<<<<<<< HEAD
                  <button type="button" id="apply-discount" class="btn pill discount-apply">
                    {{ session()->has('discount') ? 'Remove' : 'Apply' }}
                  </button>
                </div>

                <div id="discount-message" class="discount-message">
                  @if(session()->has('discount'))
                    Discount applied ({{ session('discount.percent') }}%).
=======
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
>>>>>>> fc7673c (frontend update and some new feature)
                  @endif
                </div>
              </div>

              <div class="sum-row">
<<<<<<< HEAD
                <span>Subtotal</span>
                <strong id="cart-subtotal">{{ number_format($subtotal, 2, ',', ' ') }} €</strong>
              </div>

              <div class="sum-row {{ session()->has('discount') ? '' : 'is-hidden' }}" id="discount-line">
                <span>Discount</span>
                <strong id="cart-discount">{{ number_format($discount ?? 0, 2, ',', ' ') }} €</strong>
              </div>

              <div class="sum-row">
                <span>Shipping</span>
                <strong id="cart-shipping">{{ number_format($shipping, 2, ',', ' ') }} €</strong>
              </div>

              <div class="sum-row total">
                <span>Total</span>
                <strong id="cart-total">{{ number_format($total, 2, ',', ' ') }} €</strong>
              </div>

              <a href="{{ route('checkout.show') }}" class="btn pill large" style="width:100%; margin-top:12px;">
                Proceed to checkout
=======
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
>>>>>>> fc7673c (frontend update and some new feature)
              </a>

            </div>
          </aside>

        </div>
      @endif

    </div>
  </section>

<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> fc7673c (frontend update and some new feature)
