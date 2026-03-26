@extends('layouts.shop')
@section('title', 'Checkout • FitGuide')

@section('content')
<div class="container" style="max-width: 1120px; margin: 0 auto; padding: 24px 16px;">

  {{-- FEJLÉC --}}
  <div class="checkout-header">
    <div class="checkout-icon"><i class="fa-solid fa-receipt"></i></div>
    <div>
      <h1>Checkout</h1>
      <p>Review your order and enter your details.</p>
    </div>
  </div>

  {{-- FLASH üzenetek --}}
  @if(session('success'))
    <div class="flash flash--success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="flash flash--error">{{ session('error') }}</div>
  @endif

  <div class="checkout-grid">
    {{-- BAL: űrlap --}}
    <div class="checkout-main">
      <h2 class="section-title">Details</h2>

      <form method="POST" action="{{ route('checkout.place') }}" class="checkout-form">
        @csrf

        <div class="field">
          <label for="full_name">Full name *</label>
          <input class="input" type="text" id="full_name" name="full_name"
                 value="{{ old('full_name', Auth::user()->name) }}" required>
          @error('full_name') <div class="err">{{ $message }}</div> @enderror
        </div>

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
              </div>
            </label>

            <label class="pmethod-option">
              <input type="radio" name="payment_method" value="cod">
              <div class="pmethod-content">
                <div class="pmethod-title">Cash on delivery</div>
                <div class="pmethod-sub">Pay the courier upon receiving the order</div>
              </div>
            </label>

            <label class="pmethod-option">
              <input type="radio" name="payment_method" value="pickup">
              <div class="pmethod-content">
                <div class="pmethod-title">Personal pickup</div>
                <div class="pmethod-sub">Pick up your order from our pickup point</div>
              </div>
            </label>
          </div>

          @error('payment_method') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div class="submit-row">
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
