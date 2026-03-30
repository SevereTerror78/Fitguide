@extends('layouts.shop')
<<<<<<< HEAD
<<<<<<< HEAD
@section('title', 'Checkout • FitGuide')

@section('content')
<div class="container" style="max-width: 1120px; margin: 0 auto; padding: 24px 16px;">
=======
=======
>>>>>>> 5c55d34 (new features)
@section('title', __('checkout.page_title') . ' • FitGuide')

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

<div
  id="checkoutPage"
  class="container"
  style="max-width: 1120px; margin: 0 auto; padding: 24px 16px;"
  data-quote-url="{{ route('checkout.quote') }}"
  data-currency="{{ auth()->user()?->currency ?? session('currency', 'HUF') }}"
>
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)

  {{-- FEJLÉC --}}
  <div class="checkout-header">
    <div class="checkout-icon"><i class="fa-solid fa-receipt"></i></div>
    <div>
<<<<<<< HEAD
<<<<<<< HEAD
      <h1>Checkout</h1>
      <p>Review your order and enter your details.</p>
=======
      <h1>{{ __('checkout.page_title') }}</h1>
      <p>{{ __('checkout.page_subtitle') }}</p>
>>>>>>> fc7673c (frontend update and some new feature)
=======
      <h1>{{ __('checkout.page_title') }}</h1>
      <p>{{ __('checkout.page_subtitle') }}</p>
>>>>>>> 5c55d34 (new features)
    </div>
  </div>

  {{-- FLASH üzenetek --}}
  @if(session('success'))
    <div class="flash flash--success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="flash flash--error">{{ session('error') }}</div>
  @endif

<<<<<<< HEAD
<<<<<<< HEAD
  <div class="checkout-grid">
    {{-- BAL: űrlap --}}
    <div class="checkout-main">
      <h2 class="section-title">Details</h2>
=======
=======
>>>>>>> 5c55d34 (new features)
  @php
    $countries = (array) config('countries', []);
    $countryValue = strtoupper((string) old('country', $selectedCountry ?? 'HU'));
    asort($countries);
  @endphp

  <div class="checkout-grid">
    {{-- BAL: űrlap --}}
    <div class="checkout-main">
      <h2 class="section-title">{{ __('checkout.details_title') }}</h2>
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)

      <form method="POST" action="{{ route('checkout.place') }}" class="checkout-form">
        @csrf

        <div class="field">
<<<<<<< HEAD
<<<<<<< HEAD
          <label for="full_name">Full name *</label>
=======
          <label for="full_name">{{ __('checkout.full_name') }} *</label>
>>>>>>> fc7673c (frontend update and some new feature)
=======
          <label for="full_name">{{ __('checkout.full_name') }} *</label>
>>>>>>> 5c55d34 (new features)
          <input class="input" type="text" id="full_name" name="full_name"
                 value="{{ old('full_name', Auth::user()->name) }}" required>
          @error('full_name') <div class="err">{{ $message }}</div> @enderror
        </div>

<<<<<<< HEAD
<<<<<<< HEAD
        {{-- Shipping (pickupnál nem kötelező) --}}
        <div class="field" data-shipping-field>
          <label for="address_line1">Address line 1 <span data-reqstar>*</span></label>
          <input class="input" type="text" id="address_line1" name="address_line1"
                 value="{{ old('address_line1') }}" data-shipping-required>
          @error('address_line1') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div class="field" data-shipping-field>
          <label for="address_line2">Address line 2 (optional)</label>
          <input class="input" type="text" id="address_line2" name="address_line2"
                 value="{{ old('address_line2') }}">
          @error('address_line2') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div class="field-row" data-shipping-field>
          <div class="field">
            <label for="city">City <span data-reqstar>*</span></label>
            <input class="input" type="text" id="city" name="city"
                   value="{{ old('city') }}" data-shipping-required>
            @error('city') <div class="err">{{ $message }}</div> @enderror
          </div>
          <div class="field">
            <label for="postal_code">Postal code <span data-reqstar>*</span></label>
            <input class="input" type="text" id="postal_code" name="postal_code"
                   value="{{ old('postal_code') }}" data-shipping-required>
            @error('postal_code') <div class="err">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="field" data-shipping-field>
          <label for="country">Country <span data-reqstar>*</span></label>
          <input class="input" type="text" id="country" name="country"
                 value="{{ old('country', 'Hungary') }}" data-shipping-required>
          @error('country') <div class="err">{{ $message }}</div> @enderror
        </div>

        {{-- ✅ Pickup info (csak pickupnál látszik) --}}
        <div class="field" id="pickupBox" style="display:none;">
          <label for="pickup_location">Pickup location</label>
          <input class="input" type="text" id="pickup_location" name="pickup_location"
                 value="{{ old('pickup_location', 'Pickup point') }}">
          <div class="muted" style="margin-top:8px;">
            Shipping address is not required for personal pickup.
          </div>
        </div>

        {{-- ✅ Payment method (ALULRA TÉVE) --}}
        <div class="field" style="margin-top: 26px;">
          <label>Payment method *</label>

          <div class="pmethod">
            <label class="pmethod-option">
              <input type="radio" name="payment_method" value="card" checked>
              <div class="pmethod-content">
                <div class="pmethod-title">Pay with card</div>
                <div class="pmethod-sub">(Credit/debit card via Stripe)</div>
=======
=======
>>>>>>> 5c55d34 (new features)
        {{-- SHIPPING FIELDS --}}
        <div data-shipping-field>

          <div class="field">
            <label for="address_line1">{{ __('checkout.address_line1') }} <span data-reqstar>*</span></label>
            <input class="input" type="text" id="address_line1" name="address_line1"
                   value="{{ old('address_line1') }}" data-shipping-required>
            @error('address_line1') <div class="err">{{ $message }}</div> @enderror
          </div>

          <div class="field">
            <label for="address_line2">{{ __('checkout.address_line2') }}</label>
            <input class="input" type="text" id="address_line2" name="address_line2"
                   value="{{ old('address_line2') }}">
            @error('address_line2') <div class="err">{{ $message }}</div> @enderror
          </div>

          <div class="field-row">
            <div class="field">
              <label for="city">{{ __('checkout.city') }} <span data-reqstar>*</span></label>
              <input class="input" type="text" id="city" name="city"
                     value="{{ old('city') }}" data-shipping-required>
              @error('city') <div class="err">{{ $message }}</div> @enderror
            </div>
            <div class="field">
              <label for="postal_code">{{ __('checkout.postal_code') }} <span data-reqstar>*</span></label>
              <input class="input" type="text" id="postal_code" name="postal_code"
                     value="{{ old('postal_code') }}" data-shipping-required>
              @error('postal_code') <div class="err">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="field">
            <label for="country">{{ __('checkout.country') }} <span data-reqstar>*</span></label>
            <select class="input" id="country" name="country" data-shipping-required>
              <option value="">{{ __('checkout.select_country') }}</option>
              @foreach($countries as $code => $name)
                @php $code = strtoupper($code); @endphp
                <option value="{{ $code }}" @selected($countryValue === $code)>
                  {{ country_flag($code) }} {{ $name }}
                </option>
              @endforeach
            </select>

            @error('country') <div class="err">{{ $message }}</div> @enderror
          </div>

        </div>

        {{-- PICKUP --}}
        <div class="field" id="pickupBox" style="display:none;">
          <label for="pickup_location">{{ __('checkout.pickup_location') }} *</label>

          <select class="input" id="pickup_location" name="pickup_location">
            <option value="">{{ __('checkout.select_pickup') }}</option>
            <option value="budapest" @selected(old('pickup_location') === 'budapest')>
              {{ __('checkout.pickup_points.budapest') }}
            </option>
            <option value="debrecen" @selected(old('pickup_location') === 'debrecen')>
              {{ __('checkout.pickup_points.debrecen') }}
            </option>
            <option value="miskolc" @selected(old('pickup_location') === 'miskolc')>
              {{ __('checkout.pickup_points.miskolc') }}
            </option>
            <option value="szeged" @selected(old('pickup_location') === 'szeged')>
              {{ __('checkout.pickup_points.szeged') }}
            </option>
            <option value="gyor" @selected(old('pickup_location') === 'gyor')>
              {{ __('checkout.pickup_points.gyor') }}
            </option>
          </select>

          @error('pickup_location') <div class="err">{{ $message }}</div> @enderror
        </div>

        {{-- PAYMENT --}}
        <div class="field" style="margin-top: 26px;">
          <label>{{ __('checkout.payment_method') }} *</label>

          <div class="pmethod">
            <label class="pmethod-option">
              <input type="radio" name="payment_method" value="card"
                     {{ old('payment_method', $selectedMethod ?? 'card') === 'card' ? 'checked' : '' }}>
              <div class="pmethod-content">
                <div class="pmethod-title">{{ __('checkout.pay_with_card') }}</div>
                <div class="pmethod-sub">{{ __('checkout.pay_with_card_sub') }}</div>
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
              </div>
            </label>

            <label class="pmethod-option">
<<<<<<< HEAD
<<<<<<< HEAD
              <input type="radio" name="payment_method" value="cod">
              <div class="pmethod-content">
                <div class="pmethod-title">Cash on delivery</div>
                <div class="pmethod-sub">Pay the courier upon receiving the order</div>
=======
=======
>>>>>>> 5c55d34 (new features)
              <input type="radio" name="payment_method" value="cod"
                     {{ old('payment_method', $selectedMethod ?? '') === 'cod' ? 'checked' : '' }}>
              <div class="pmethod-content">
                <div class="pmethod-title">{{ __('checkout.cash_on_delivery') }}</div>
                <div class="pmethod-sub">{{ __('checkout.cash_on_delivery_sub') }}</div>
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
              </div>
            </label>

            <label class="pmethod-option">
<<<<<<< HEAD
<<<<<<< HEAD
              <input type="radio" name="payment_method" value="pickup">
              <div class="pmethod-content">
                <div class="pmethod-title">Personal pickup</div>
                <div class="pmethod-sub">Pick up your order from our pickup point</div>
=======
=======
>>>>>>> 5c55d34 (new features)
              <input type="radio" name="payment_method" value="pickup"
                     {{ old('payment_method', $selectedMethod ?? '') === 'pickup' ? 'checked' : '' }}>
              <div class="pmethod-content">
                <div class="pmethod-title">{{ __('checkout.personal_pickup') }}</div>
                <div class="pmethod-sub">{{ __('checkout.personal_pickup_sub') }}</div>
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
              </div>
            </label>
          </div>

          @error('payment_method') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div class="submit-row">
<<<<<<< HEAD
<<<<<<< HEAD
          <button id="checkoutSubmitBtn" type="submit" class="btn pill large">Pay with card</button>
        </div>
      </form>
    </div>

    {{-- JOBB: összegzés + tételek képpel --}}
    <aside class="checkout-aside">
      <div class="summary-card">
        <h3>Order summary</h3>

        <div class="items-list">
          @foreach($cart as $item)
            @php
              // Bélyegkép beszerzése a product_id alapján
              $product = \App\Models\Product::find($item['product_id'] ?? null);
              $img = $product?->image
                    ? (\Illuminate\Support\Str::startsWith($product->image, ['http://','https://'])
                        ? $product->image
                        : \Illuminate\Support\Facades\Storage::url($product->image))
                    : asset('images/placeholder-product.png');
            @endphp
            <div class="item-row">
              <div class="thumb"><img src="{{ $img }}" alt="{{ $item['name'] }}"></div>
              <div class="meta">
                <div class="name">{{ $item['name'] }}</div>
                <div class="muted">Qty: {{ $item['qty'] }}</div>
              </div>
              <div class="line-total">€{{ number_format($item['price'] * $item['qty'], 2) }}</div>
            </div>
          @endforeach
        </div>

        <div class="sum-row">
          <span>Subtotal</span>
          <strong id="summary-subtotal">€{{ number_format($subtotal, 2) }}</strong>
        </div>

        @if(($percent ?? 0) > 0)
          <div class="sum-row">
            <span>Discount ({{ (int)$percent }}%)</span>
            <strong id="summary-discount">-€{{ number_format($discountAmount, 2) }}</strong>
          </div>
        @endif

        <div class="sum-row">
          <span>Shipping</span>
          <strong id="summary-shipping">€{{ number_format($shipping, 2) }}</strong>
        </div>

        <div class="sum-row total">
          <span>Total</span>
          <strong id="summary-total">€{{ number_format($total, 2) }}</strong>
        </div>
      </div>
    </aside>
  </div>
</div>

<script>
  (function () {
    const radios = document.querySelectorAll('input[name="payment_method"]');
    const requiredInputs = document.querySelectorAll('[data-shipping-required]');
    const stars = document.querySelectorAll('[data-reqstar]');
    const btn = document.getElementById('checkoutSubmitBtn');
    const pickupBox = document.getElementById('pickupBox');

    function applyMode(mode) {
      const isPickup = mode === 'pickup';

      // 🔹 csak a kötelező státusz változik
      requiredInputs.forEach(inp => inp.required = !isPickup);

      // 🔹 csillagok eltűnnek pickupnál
      stars.forEach(s => s.style.display = isPickup ? 'none' : 'inline');

      // 🔹 pickup info box
      if (pickupBox) pickupBox.style.display = isPickup ? 'block' : 'none';

      // 🔹 gomb szöveg
      if (btn) {
        btn.textContent =
          mode === 'card' ? 'Pay with card' :
          mode === 'cod' ? 'Place order (COD)' :
          'Place order (Pickup)';
      }
    }

    radios.forEach(r => r.addEventListener('change', e => applyMode(e.target.value)));
    const checked = document.querySelector('input[name="payment_method"]:checked');
    applyMode(checked ? checked.value : 'card');
  })();
</script>


@endsection
=======
=======
>>>>>>> 5c55d34 (new features)
          <button
            id="checkoutSubmitBtn"
            type="submit"
            class="btn pill large"
            data-label-card="{{ __('checkout.btn_pay_card') }}"
            data-label-cod="{{ __('checkout.btn_place_cod') }}"
            data-label-pickup="{{ __('checkout.btn_place_pickup') }}"
          >
            {{ __('checkout.btn_pay_card') }}
          </button>
        </div>

      </form>
    </div>

    {{-- SUMMARY --}}
<<<<<<< HEAD
    <aside class="checkout-aside">
      <div class="summary-card">
        <h3>{{ __('checkout.order_summary') }}</h3>

        <div class="sum-row">
          <span>{{ __('checkout.subtotal') }}</span>
          <strong id="sumSubtotal">{{ $formatMoney($subtotal) }}</strong>
        </div>

        <div class="sum-row">
          <span>{{ __('checkout.shipping') }}</span>
          <strong id="sumShipping">{{ $formatMoney($shipping) }}</strong>
        </div>

        <div class="sum-row total">
          <span>{{ __('checkout.total') }}</span>
          <strong id="sumTotal">{{ $formatMoney($total) }}</strong>
        </div>
      </div>
    </aside>
=======
  <aside class="checkout-aside">
    <div class="summary-card">
      <h3>{{ __('checkout.order_summary') }}</h3>

      <div class="sum-row">
        <span>{{ __('checkout.subtotal') }}</span>
        <strong id="sumSubtotal">{{ $formatMoney($discountedSubtotal) }}</strong>
      </div>

      <div class="sum-row">
        <span>{{ __('checkout.shipping') }}</span>
        <strong id="sumShipping">{{ $formatMoney($shipping) }}</strong>
      </div>

      <div class="sum-row total">
        <span>{{ __('checkout.total') }}</span>
        <strong id="sumTotal">{{ $formatMoney($total) }}</strong>
      </div>
    </div>
  </aside>
>>>>>>> 5c55d34 (new features)

  </div>
</div>
@endsection

@push('scripts')
  <script src="{{ asset('js/checkout.js') }}" defer></script>
<<<<<<< HEAD
@endpush
>>>>>>> fc7673c (frontend update and some new feature)
=======
@endpush
>>>>>>> 5c55d34 (new features)
