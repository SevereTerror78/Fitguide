@extends('layouts.shop')
<<<<<<< HEAD
@section('title', 'Payment successful • FitGuide')
=======
@section('title', __('checkout.payment_success_title') . ' • FitGuide')
>>>>>>> fc7673c (frontend update and some new feature)

@section('content')
<div class="container" style="max-width: 900px; margin: 0 auto; padding: 48px 16px;">
  <div style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 18px; padding: 24px;">
<<<<<<< HEAD
    <h1 style="margin: 0 0 8px;">✅ Payment successful</h1>
    <p style="opacity:.85; margin:0 0 16px;">
      Thanks! Your payment went through. We’re finalizing your order in the background (webhook).
=======
    <h1 style="margin: 0 0 8px;">✅ {{ __('checkout.payment_success_heading') }}</h1>
    <p style="opacity:.85; margin:0 0 16px;">
      {{ __('checkout.payment_success_desc') }}
>>>>>>> fc7673c (frontend update and some new feature)
    </p>

    @if(request('order_id'))
      <p style="margin:0 0 16px;">
<<<<<<< HEAD
        Order ID: <strong>#{{ request('order_id') }}</strong>
      </p>
    @endif

    <a href="{{ route('store.index') }}" class="btn pill">Back to store</a>
  </div>
</div>
@endsection
=======
        {{ __('checkout.order_id') }}: <strong>#{{ request('order_id') }}</strong>
      </p>
    @endif

    <a href="{{ route('store.index') }}" class="btn pill">{{ __('checkout.back_to_store') }}</a>
  </div>
</div>
@endsection
>>>>>>> fc7673c (frontend update and some new feature)
