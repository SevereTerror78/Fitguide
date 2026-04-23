@extends('layouts.shop')
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

  {{-- FEJLÉC --}}
  <div class="checkout-header">
    <div class="checkout-icon"><i class="fa-solid fa-receipt"></i></div>
    <div>
      <h1>{{ __('checkout.page_title') }}</h1>
      <p>{{ __('checkout.page_subtitle') }}</p>
    </div>
  </div>

  {{-- FLASH üzenetek --}}
  @if(session('success'))
    <div class="flash flash--success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="flash flash--error">{{ session('error') }}</div>
  @endif

  @php
    $countries = (array) config('countries', []);
    $countryValue = strtoupper((string) old('country', $selectedCountry ?? 'HU'));
    asort($countries);
  @endphp

  <div class="checkout-grid">
    {{-- BAL: űrlap --}}
    <div class="checkout-main">
      <h2 class="section-title">{{ __('checkout.details_title') }}</h2>

      <form method="POST" action="{{ route('checkout.place') }}" class="checkout-form">
        @csrf

        <div class="field">
          <label for="full_name">{{ __('checkout.full_name') }} *</label>
          <input class="input" type="text" id="full_name" name="full_name"
                 value="{{ old('full_name', Auth::user()->name) }}" required>
          @error('full_name') <div class="err">{{ $message }}</div> @enderror
        </div>

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
              </div>
            </label>

            <label class="pmethod-option">
              <input type="radio" name="payment_method" value="cod"
                     {{ old('payment_method', $selectedMethod ?? '') === 'cod' ? 'checked' : '' }}>
              <div class="pmethod-content">
                <div class="pmethod-title">{{ __('checkout.cash_on_delivery') }}</div>
                <div class="pmethod-sub">{{ __('checkout.cash_on_delivery_sub') }}</div>
              </div>
            </label>

            <label class="pmethod-option">
              <input type="radio" name="payment_method" value="pickup"
                     {{ old('payment_method', $selectedMethod ?? '') === 'pickup' ? 'checked' : '' }}>
              <div class="pmethod-content">
                <div class="pmethod-title">{{ __('checkout.personal_pickup') }}</div>
                <div class="pmethod-sub">{{ __('checkout.personal_pickup_sub') }}</div>
              </div>
            </label>
          </div>

          @error('payment_method') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div class="submit-row">
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

  </div>
</div>
@endsection

@push('scripts')
  <script src="{{ asset('js/checkout.js') }}" defer></script>
@endpush