@extends('layouts.main')

<<<<<<< HEAD
<<<<<<< HEAD
@section('title', 'My Rewards • FitGuide')
=======
@section('title', __('profile.rewards.page_title') . ' • FitGuide')
>>>>>>> fc7673c (frontend update and some new feature)
=======
@section('title', __('profile.rewards.page_title') . ' • FitGuide')
>>>>>>> 5c55d34 (new features)

@section('head')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile-container">

<<<<<<< HEAD
<<<<<<< HEAD
    {{-- LEFT SIDEBAR --}}
    @include('profile.sidebar')

    {{-- MAIN --}}
    <section class="profile-main">
        <h2 class="section-title">My Rewards</h2>

        {{-- 🟦 TOTAL POINTS CARD --}}
       <div class="points-card">
        <div class="points-value">
        <i class="fa-solid fa-coins"></i>{{ $totalPoints }} pts
        </div>
        <div class="points-label">Total Points</div>
        </div>


        {{-- 🛒 REWARD STORE --}}
        <h3 class="sub-title">Reward Store</h3>
=======
=======
>>>>>>> 5c55d34 (new features)
    @include('profile.sidebar')

    <section class="profile-main">
        <h2 class="section-title">{{ __('profile.rewards.title') }}</h2>

        {{-- TOTAL POINTS CARD --}}
        <div class="points-card">
            <div class="points-value">
                <i class="fa-solid fa-coins"></i>{{ $totalPoints }} {{ __('profile.rewards.pts') }}
            </div>
            <div class="points-label">{{ __('profile.rewards.total_points') }}</div>
        </div>

        {{-- REWARD STORE --}}
        <h3 class="sub-title">{{ __('profile.rewards.store_title') }}</h3>
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)

        <div class="reward-store">
            @forelse ($shopItems as $item)
                <div class="reward-item {{ $totalPoints < $item->required_points ? 'locked' : '' }}">

<<<<<<< HEAD
<<<<<<< HEAD
                    {{-- Image --}}
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                    @else
                        <img src="{{ asset('images/reward-placeholder.png') }}" alt="Reward">
=======
=======
>>>>>>> 5c55d34 (new features)
                    @if($item->image)
                        <img src="{{ asset($item->image) }}" alt="{{ $item->name }}">
                    @else
                        <img src="{{ asset('images/reward-placeholder.png') }}" alt="{{ __('profile.rewards.reward_alt') }}">
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
                    @endif

                    <h4>{{ $item->name }}</h4>

<<<<<<< HEAD
<<<<<<< HEAD
                    {{-- Optional description --}}
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
                    @if(!empty($item->description))
                        <p class="reward-desc">{{ $item->description }}</p>
                    @endif

                    <div class="price">
                        <i class="fa-solid fa-coins"></i>
<<<<<<< HEAD
<<<<<<< HEAD
                        {{ $item->required_points }} pts
                    </div>

                    {{-- 🔘 Redeem Logic --}}
=======
                        {{ $item->required_points }} {{ __('profile.rewards.pts') }}
                    </div>

>>>>>>> fc7673c (frontend update and some new feature)
=======
                        {{ $item->required_points }} {{ __('profile.rewards.pts') }}
                    </div>

>>>>>>> 5c55d34 (new features)
                    @if($totalPoints >= $item->required_points)
                        <form method="POST" action="{{ route('profile.redeem', $item->id) }}">
                            @csrf
                            <button type="submit" class="btn-primary small">
<<<<<<< HEAD
<<<<<<< HEAD
                                Redeem
=======
                                {{ __('profile.rewards.redeem') }}
>>>>>>> fc7673c (frontend update and some new feature)
=======
                                {{ __('profile.rewards.redeem') }}
>>>>>>> 5c55d34 (new features)
                            </button>
                        </form>
                    @else
                        <button class="btn-disabled small" disabled>
<<<<<<< HEAD
<<<<<<< HEAD
                            Need {{ $item->required_points - $totalPoints }} more
=======
                            {{ __('profile.rewards.need_more', ['points' => $item->required_points - $totalPoints]) }}
>>>>>>> fc7673c (frontend update and some new feature)
=======
                            {{ __('profile.rewards.need_more', ['points' => $item->required_points - $totalPoints]) }}
>>>>>>> 5c55d34 (new features)
                        </button>
                    @endif

                </div>
            @empty
<<<<<<< HEAD
<<<<<<< HEAD
                <p style="color:#aaa">The reward shop is currently empty.</p>
            @endforelse
        </div>

        {{-- 📜 HISTORY --}}
        <h3 class="sub-title" style="margin-top:30px;">History</h3>
=======
=======
>>>>>>> 5c55d34 (new features)
                <p style="color:#aaa">{{ __('profile.rewards.shop_empty') }}</p>
            @endforelse
        </div>

        {{-- HISTORY --}}
        <h3 class="sub-title" style="margin-top:30px;">
            {{ __('profile.rewards.history_title') }}
        </h3>
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)

        <div class="reward-history">
            @forelse ($redeemed as $r)
                <div class="history-row">
                    <strong>{{ $r->item->name }}</strong>
<<<<<<< HEAD
<<<<<<< HEAD
                    <span>Spent: {{ $r->points_spent }} pts</span>
                    <small>{{ $r->created_at->format('Y-m-d') }}</small>
                </div>
            @empty
                <p style="color:#777">No redeemed rewards yet</p>
=======
=======
>>>>>>> 5c55d34 (new features)
                    <span>{{ __('profile.rewards.spent') }}: {{ $r->points_spent }} {{ __('profile.rewards.pts') }}</span>
                    <small>{{ $r->created_at->format('Y-m-d') }}</small>
                </div>
            @empty
                <p style="color:#777">{{ __('profile.rewards.no_history') }}</p>
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
            @endforelse
        </div>

    </section>
</div>

<<<<<<< HEAD
<<<<<<< HEAD
{{-- 🔔 Feedback Toast --}}
=======
{{-- FEEDBACK TOAST --}}
>>>>>>> fc7673c (frontend update and some new feature)
=======
{{-- FEEDBACK TOAST --}}
>>>>>>> 5c55d34 (new features)
@if(session('success'))
    <div class="toast success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="toast error">{{ session('error') }}</div>
@endif

<<<<<<< HEAD
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> fc7673c (frontend update and some new feature)
=======
@endsection
>>>>>>> 5c55d34 (new features)
