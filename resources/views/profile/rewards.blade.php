@extends('layouts.main')

@section('title', 'My Rewards • FitGuide')

@section('head')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile-container">

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

        <div class="reward-store">
            @forelse ($shopItems as $item)
                <div class="reward-item {{ $totalPoints < $item->required_points ? 'locked' : '' }}">

                    {{-- Image --}}
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                    @else
                        <img src="{{ asset('images/reward-placeholder.png') }}" alt="Reward">
                    @endif

                    <h4>{{ $item->name }}</h4>

                    {{-- Optional description --}}
                    @if(!empty($item->description))
                        <p class="reward-desc">{{ $item->description }}</p>
                    @endif

                    <div class="price">
                        <i class="fa-solid fa-coins"></i>
                        {{ $item->required_points }} pts
                    </div>

                    {{-- 🔘 Redeem Logic --}}
                    @if($totalPoints >= $item->required_points)
                        <form method="POST" action="{{ route('profile.redeem', $item->id) }}">
                            @csrf
                            <button type="submit" class="btn-primary small">
                                Redeem
                            </button>
                        </form>
                    @else
                        <button class="btn-disabled small" disabled>
                            Need {{ $item->required_points - $totalPoints }} more
                        </button>
                    @endif

                </div>
            @empty
                <p style="color:#aaa">The reward shop is currently empty.</p>
            @endforelse
        </div>

        {{-- 📜 HISTORY --}}
        <h3 class="sub-title" style="margin-top:30px;">History</h3>

        <div class="reward-history">
            @forelse ($redeemed as $r)
                <div class="history-row">
                    <strong>{{ $r->item->name }}</strong>
                    <span>Spent: {{ $r->points_spent }} pts</span>
                    <small>{{ $r->created_at->format('Y-m-d') }}</small>
                </div>
            @empty
                <p style="color:#777">No redeemed rewards yet</p>
            @endforelse
        </div>

    </section>
</div>

{{-- 🔔 Feedback Toast --}}
@if(session('success'))
    <div class="toast success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="toast error">{{ session('error') }}</div>
@endif

@endsection
