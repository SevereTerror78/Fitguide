@extends('layouts.main')
 
@section('title', __('orders.page_title') . ' • FitGuide')
 
@section('head')
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
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
@endphp
 
<div class="profile-container">
 
  {{-- LEFT SIDEBAR --}}
  @include('profile.sidebar')
 
  {{-- RIGHT CONTENT --}}
  <section class="profile-main">
    <h2 class="section-title">{{ __('orders.page_title') }}</h2>
 
    @if($orders->isEmpty())
      <p style="color:#ccc">{{ __('orders.empty') }}</p>
    @else
      <div class="orders-list">
        @foreach($orders as $order)
          <div class="order-card">
            <div class="order-top">
              <span class="order-id">{{ __('orders.order_number', ['id' => $order->id]) }}</span>
 
              <span class="order-status status-{{ strtolower($order->status) }}">
                {{ __('orders.status_label') }}: {{ __('orders.statuses.' . strtolower($order->status)) }}
              </span>
            </div>
 
            <div class="order-details">
              <p><strong>{{ __('orders.date') }}:</strong> {{ $order->created_at->format('Y-m-d') }}</p>
              <p><strong>{{ __('orders.total') }}:</strong> {{ $formatMoney($order->total) }}</p>
            </div>
 
            <a href="{{ route('orders.show', $order->id) }}" class="view-btn">
              {{ __('orders.view_details') }} →
            </a>
          </div>
        @endforeach
      </div>
    @endif
 
  </section>
</div>
@endsection