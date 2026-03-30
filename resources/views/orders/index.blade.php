@extends('layouts.main')
<<<<<<< HEAD

<<<<<<< HEAD
@section('title', 'My Orders • FitGuide')
@section('head')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection
<body data-theme="{{ auth()->check() ? (auth()->user()->theme ?? 'dark') : 'dark' }}">
@section('content')
<div class="profile-container">

    {{-- LEFT SIDEBAR --}}
    @include('profile.sidebar')

    {{-- RIGHT CONTENT --}}
    <section class="profile-main">
        <h2 class="section-title">My Orders</h2>

        @if($orders->isEmpty())
            <p style="color:#ccc">You have no orders yet.</p>
        @else
            <div class="orders-list">
                @foreach($orders as $order)
                    <div class="order-card">

                        <div class="order-top">
                            <span class="order-id">Order #{{ $order->id }}</span>
                            <span class="order-status status-{{ strtolower($order->status) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>

                        <div class="order-details">
                            <p><strong>Date:</strong> {{ $order->created_at->format('Y-m-d') }}</p>
                            <p><strong>Total:</strong> €{{ number_format($order->total, 2) }}</p>
                        </div>

                        <a href="{{ route('orders.show', $order->id) }}" class="view-btn">
                            View Details →
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

    </section>
</div>
</body>
@endsection
=======
@section('title', __('orders.page_title') . ' • FitGuide')

=======
 
@section('title', __('orders.page_title') . ' • FitGuide')
 
>>>>>>> 5c55d34 (new features)
@section('head')
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
  <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
@endsection
<<<<<<< HEAD

@section('content')
<div class="profile-container">

  {{-- LEFT SIDEBAR --}}
  @include('profile.sidebar')

  {{-- RIGHT CONTENT --}}
  <section class="profile-main">
    <h2 class="section-title">{{ __('orders.page_title') }}</h2>

=======
 
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
 
>>>>>>> 5c55d34 (new features)
    @if($orders->isEmpty())
      <p style="color:#ccc">{{ __('orders.empty') }}</p>
    @else
      <div class="orders-list">
        @foreach($orders as $order)
          <div class="order-card">
            <div class="order-top">
              <span class="order-id">{{ __('orders.order_number', ['id' => $order->id]) }}</span>
<<<<<<< HEAD

=======
 
>>>>>>> 5c55d34 (new features)
              <span class="order-status status-{{ strtolower($order->status) }}">
                {{ __('orders.status_label') }}: {{ __('orders.statuses.' . strtolower($order->status)) }}
              </span>
            </div>
<<<<<<< HEAD

            <div class="order-details">
              <p><strong>{{ __('orders.date') }}:</strong> {{ $order->created_at->format('Y-m-d') }}</p>
              <p><strong>{{ __('orders.total') }}:</strong> €{{ number_format($order->total, 2) }}</p>
            </div>

=======
 
            <div class="order-details">
              <p><strong>{{ __('orders.date') }}:</strong> {{ $order->created_at->format('Y-m-d') }}</p>
              <p><strong>{{ __('orders.total') }}:</strong> {{ $formatMoney($order->total) }}</p>
            </div>
 
>>>>>>> 5c55d34 (new features)
            <a href="{{ route('orders.show', $order->id) }}" class="view-btn">
              {{ __('orders.view_details') }} →
            </a>
          </div>
        @endforeach
      </div>
    @endif
<<<<<<< HEAD

  </section>
</div>
@endsection
>>>>>>> fc7673c (frontend update and some new feature)
=======
 
  </section>
</div>
@endsection
>>>>>>> 5c55d34 (new features)
