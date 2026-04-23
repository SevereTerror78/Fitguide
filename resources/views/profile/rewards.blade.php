@extends('layouts.main')

@section('title', __('profile.rewards.page_title') . ' • FitGuide')

@section('head')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile-container">

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

        <div class="reward-store">
            @forelse ($shopItems as $item)
                <div class="reward-item {{ $totalPoints < $item->required_points ? 'locked' : '' }}">

                    @if($item->image)
                        <img src="{{ asset($item->image) }}" alt="{{ $item->name }}">
                    @else
                        <img src="{{ asset('images/reward-placeholder.png') }}" alt="{{ __('profile.rewards.reward_alt') }}">
                    @endif

                    <h4>{{ $item->name }}</h4>

                    @if(!empty($item->description))
                        <p class="reward-desc">{{ $item->description }}</p>
                    @endif

                    <div class="price">
                        <i class="fa-solid fa-coins"></i>
                        {{ $item->required_points }} {{ __('profile.rewards.pts') }}
                    </div>

                    @if($totalPoints >= $item->required_points)
                        <form method="POST" action="{{ route('profile.redeem', $item->id) }}">
                            @csrf
                            <button type="submit" class="btn-primary small">
                                {{ __('profile.rewards.redeem') }}
                            </button>
                        </form>
                    @else
                        <button class="btn-disabled small" disabled>
                            {{ __('profile.rewards.need_more', ['points' => $item->required_points - $totalPoints]) }}
                        </button>
                    @endif

                </div>
            @empty
                <p style="color:#aaa">{{ __('profile.rewards.shop_empty') }}</p>
            @endforelse
        </div>

        {{-- HISTORY --}}
        <h3 class="sub-title" style="margin-top:30px;">
            {{ __('profile.rewards.history_title') }}
        </h3>

        <div class="reward-history">
            @forelse ($redeemed as $r)
                <div class="history-row">
                    <strong>{{ $r->item->name }}</strong>
                    <span>{{ __('profile.rewards.spent') }}: {{ $r->points_spent }} {{ __('profile.rewards.pts') }}</span>
                    <small>{{ $r->created_at->format('Y-m-d') }}</small>
                </div>
            @empty
                <p style="color:#777">{{ __('profile.rewards.no_history') }}</p>
            @endforelse
        </div>

    </section>
</div>

{{-- FEEDBACK TOAST --}}
@if(session('success'))
    <div class="toast success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="toast error">{{ session('error') }}</div>
@endif

@endsection