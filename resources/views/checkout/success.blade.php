@extends('layouts.shop')
@section('title', 'Payment successful • FitGuide')

@section('content')
<div class="container" style="max-width: 900px; margin: 0 auto; padding: 48px 16px;">
  <div style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 18px; padding: 24px;">
    <h1 style="margin: 0 0 8px;">✅ Payment successful</h1>
    <p style="opacity:.85; margin:0 0 16px;">
      Thanks! Your payment went through. We’re finalizing your order in the background (webhook).
    </p>

    @if(request('order_id'))
      <p style="margin:0 0 16px;">
        Order ID: <strong>#{{ request('order_id') }}</strong>
      </p>
    @endif

    <a href="{{ route('store.index') }}" class="btn pill">Back to store</a>
  </div>
</div>
@endsection
