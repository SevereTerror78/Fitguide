@extends('layouts.main')

<<<<<<< HEAD
@section('title', 'Discounts • FitGuide')
=======
@section('title', __('profile.discounts.page_title') . ' • FitGuide')
>>>>>>> fc7673c (frontend update and some new feature)
@section('head')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile-container">

    @include('profile.sidebar')

    <section class="profile-main">
<<<<<<< HEAD
        <h2 class="section-title">My Discounts</h2>

        @if ($discounts->isEmpty())
            <p style="color:#ccc">You currently have no discounts.</p>
        @else
            <div class="discount-list">
                @foreach ($discounts as $d)
                    <div class="discount-card {{ 
                        $d->usedOrNot 
                            ? 'used' 
                            : ($d->expiryDate && $d->expiryDate->isPast() 
                                ? 'expired' 
                                : 'active') 
                    }}">
                        
=======
        <h2 class="section-title">{{ __('profile.discounts.title') }}</h2>

        @if ($discounts->isEmpty())
            <p style="color:#ccc">{{ __('profile.discounts.empty') }}</p>
        @else
            <div class="discount-list">
                @foreach ($discounts as $d)
                    @php
                        $stateClass = $d->usedOrNot
                            ? 'used'
                            : (($d->expiryDate && $d->expiryDate->isPast()) ? 'expired' : 'active');
                    @endphp

                    <div class="discount-card {{ $stateClass }}">
>>>>>>> fc7673c (frontend update and some new feature)
                        <div class="discount-left">
                            <strong class="discount-code">{{ $d->discountCode }}</strong>
                            <span class="amount">-{{ $d->discountAmount }}%</span>

                            @if($d->usedOrNot)
<<<<<<< HEAD
                                <span class="status used">✔ Used</span>
                            @elseif($d->expiryDate && $d->expiryDate->isPast())
                                <span class="status expired">✖ Expired</span>
                            @else
                                <span class="status active">Usable 🎉</span>
=======
                                <span class="status used">✔ {{ __('profile.discounts.used') }}</span>
                            @elseif($d->expiryDate && $d->expiryDate->isPast())
                                <span class="status expired">✖ {{ __('profile.discounts.expired') }}</span>
                            @else
                                <span class="status active">{{ __('profile.discounts.usable') }} 🎉</span>
>>>>>>> fc7673c (frontend update and some new feature)
                            @endif
                        </div>

                        <div class="discount-right">
<<<<<<< HEAD
                            <span class="expiry-label">Expiry date</span>
                            <span class="expiry">
                                <i class="fa-regular fa-clock"></i>
                                {{ $d->expiryDate?->format('Y-m-d') ?? 'No limit' }}
=======
                            <span class="expiry-label">{{ __('profile.discounts.expiry_label') }}</span>
                            <span class="expiry">
                                <i class="fa-regular fa-clock"></i>
                                {{ $d->expiryDate?->format('Y-m-d') ?? __('profile.discounts.no_limit') }}
>>>>>>> fc7673c (frontend update and some new feature)
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </section>
</div>
<<<<<<< HEAD
@endsection


=======
@endsection
>>>>>>> fc7673c (frontend update and some new feature)
