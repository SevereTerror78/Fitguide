@extends('layouts.main')
@section('title', __('profile.security.page_title') . ' • FitGuide')

@section('head')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile-container">

    @include('profile.sidebar')

    <section class="profile-main">
        <h2 class="section-title">{{ __('profile.security.title') }}</h2>

        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('profile.security.update') }}" method="POST" class="security-form">
            @csrf

            <label>{{ __('profile.security.current_password') }}</label>
            <input type="password" name="current_password" required>

            <label>{{ __('profile.security.new_password') }}</label>
            <input type="password" name="password" required>

            <label>{{ __('profile.security.confirm_new_password') }}</label>
            <input type="password" name="password_confirmation" required>

            @error('current_password')
                <p class="error">{{ $message }}</p>
            @enderror

            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror

            <button type="submit" class="btn-primary">
                {{ __('profile.security.update_password') }}
            </button>
        </form>

    </section>

</div>
@endsection