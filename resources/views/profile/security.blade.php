@extends('layouts.main')
<<<<<<< HEAD
@section('title', 'Security • FitGuide')
=======
@section('title', __('profile.security.page_title') . ' • FitGuide')

>>>>>>> fc7673c (frontend update and some new feature)
@section('head')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile-container">
<<<<<<< HEAD
    
    @include('profile.sidebar')

    <section class="profile-main">
        <h2 class="section-title">Security Settings</h2>
=======

    @include('profile.sidebar')

    <section class="profile-main">
        <h2 class="section-title">{{ __('profile.security.title') }}</h2>
>>>>>>> fc7673c (frontend update and some new feature)

        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('profile.security.update') }}" method="POST" class="security-form">
            @csrf

<<<<<<< HEAD
            <label>Current Password</label>
            <input type="password" name="current_password" required>

            <label>New Password</label>
            <input type="password" name="password" required>

            <label>Confirm New Password</label>
=======
            <label>{{ __('profile.security.current_password') }}</label>
            <input type="password" name="current_password" required>

            <label>{{ __('profile.security.new_password') }}</label>
            <input type="password" name="password" required>

            <label>{{ __('profile.security.confirm_new_password') }}</label>
>>>>>>> fc7673c (frontend update and some new feature)
            <input type="password" name="password_confirmation" required>

            @error('current_password')
                <p class="error">{{ $message }}</p>
            @enderror

            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror

<<<<<<< HEAD
            <button type="submit" class="btn-primary">Update Password</button>
=======
            <button type="submit" class="btn-primary">
                {{ __('profile.security.update_password') }}
            </button>
>>>>>>> fc7673c (frontend update and some new feature)
        </form>

    </section>

</div>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> fc7673c (frontend update and some new feature)
