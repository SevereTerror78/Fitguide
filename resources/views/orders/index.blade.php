@extends('layouts.main')

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

@section('head')
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
  <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
@endsection

@section('content')
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
              <p><strong>{{ __('orders.total') }}:</strong> €{{ number_format($order->total, 2) }}</p>
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
>>>>>>> fc7673c (frontend update and some new feature)
