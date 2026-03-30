@extends('layouts.main')

<<<<<<< HEAD
<<<<<<< HEAD
@section('title', 'Discounts • FitGuide')
=======
@section('title', __('profile.discounts.page_title') . ' • FitGuide')
>>>>>>> fc7673c (frontend update and some new feature)
=======
@section('title', __('profile.discounts.page_title') . ' • FitGuide')
>>>>>>> 5c55d34 (new features)
@section('head')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile-container">

    @include('profile.sidebar')

    <section class="profile-main">
<<<<<<< HEAD
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
=======
>>>>>>> 5c55d34 (new features)
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
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
                        <div class="discount-left">
                            <strong class="discount-code">{{ $d->discountCode }}</strong>
                            <span class="amount">-{{ $d->discountAmount }}%</span>

                            @if($d->usedOrNot)
<<<<<<< HEAD
<<<<<<< HEAD
                                <span class="status used">✔ Used</span>
                            @elseif($d->expiryDate && $d->expiryDate->isPast())
                                <span class="status expired">✖ Expired</span>
                            @else
                                <span class="status active">Usable 🎉</span>
=======
=======
>>>>>>> 5c55d34 (new features)
                                <span class="status used">✔ {{ __('profile.discounts.used') }}</span>
                            @elseif($d->expiryDate && $d->expiryDate->isPast())
                                <span class="status expired">✖ {{ __('profile.discounts.expired') }}</span>
                            @else
                                <span class="status active">{{ __('profile.discounts.usable') }} 🎉</span>
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
                            @endif
                        </div>

                        <div class="discount-right">
<<<<<<< HEAD
<<<<<<< HEAD
                            <span class="expiry-label">Expiry date</span>
                            <span class="expiry">
                                <i class="fa-regular fa-clock"></i>
                                {{ $d->expiryDate?->format('Y-m-d') ?? 'No limit' }}
=======
=======
>>>>>>> 5c55d34 (new features)
                            <span class="expiry-label">{{ __('profile.discounts.expiry_label') }}</span>
                            <span class="expiry">
                                <i class="fa-regular fa-clock"></i>
                                {{ $d->expiryDate?->format('Y-m-d') ?? __('profile.discounts.no_limit') }}
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </section>
</div>
<<<<<<< HEAD
<<<<<<< HEAD
@endsection


=======
@endsection
>>>>>>> fc7673c (frontend update and some new feature)
=======
@endsection
>>>>>>> 5c55d34 (new features)
