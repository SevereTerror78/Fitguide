@extends('layouts.shop')
@section('title', __('checkout.payment_cancelled_title') . ' • FitGuide')

@section('content')
<div class="container" style="max-width: 900px; margin: 0 auto; padding: 48px 16px;">
  <div style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 18px; padding: 24px;">
    <h1 style="margin: 0 0 8px;">⚠️ {{ __('checkout.payment_cancelled_heading') }}</h1>
    <p style="opacity:.85; margin:0 0 16px;">
      {{ __('checkout.payment_cancelled_desc') }}
    </p>

    @if(request('order_id'))
      <p style="margin:0 0 16px;">
        {{ __('checkout.order_id') }}: <strong>#{{ request('order_id') }}</strong>
      </p>
    @endif

    <a href="{{ route('checkout.show') }}" class="btn pill">{{ __('checkout.back_to_checkout') }}</a>
    <a href="{{ route('store.index') }}" class="btn pill" style="margin-left:8px;">{{ __('checkout.back_to_store') }}</a>
  </div>
</div>
@endsection