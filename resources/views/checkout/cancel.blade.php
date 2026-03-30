@extends('layouts.shop')
@section('title', 'Payment cancelled • FitGuide')

@section('content')
<div class="container" style="max-width: 900px; margin: 0 auto; padding: 48px 16px;">
  <div style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 18px; padding: 24px;">
    <h1 style="margin: 0 0 8px;">⚠️ Payment cancelled</h1>
    <p style="opacity:.85; margin:0 0 16px;">
      You cancelled the payment. Your order is not paid.
    </p>

    @if(request('order_id'))
      <p style="margin:0 0 16px;">
        Order ID: <strong>#{{ request('order_id') }}</strong>
      </p>
    @endif

    <a href="{{ route('checkout.show') }}" class="btn pill">Back to checkout</a>
    <a href="{{ route('store.index') }}" class="btn pill" style="margin-left:8px;">Back to store</a>
  </div>
</div>
@endsection
