@extends('layouts.main')
<<<<<<< HEAD
<<<<<<< HEAD
@section('title', 'Security • FitGuide')
=======
@section('title', __('profile.security.page_title') . ' • FitGuide')

>>>>>>> fc7673c (frontend update and some new feature)
=======
@section('title', __('profile.security.page_title') . ' • FitGuide')

>>>>>>> 5c55d34 (new features)
@section('head')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile-container">
<<<<<<< HEAD
<<<<<<< HEAD
    
    @include('profile.sidebar')

    <section class="profile-main">
        <h2 class="section-title">Security Settings</h2>
=======
=======
>>>>>>> 5c55d34 (new features)

    @include('profile.sidebar')

    <section class="profile-main">
        <h2 class="section-title">{{ __('profile.security.title') }}</h2>
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)

        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('profile.security.update') }}" method="POST" class="security-form">
            @csrf

<<<<<<< HEAD
<<<<<<< HEAD
            <label>Current Password</label>
            <input type="password" name="current_password" required>

            <label>New Password</label>
            <input type="password" name="password" required>

            <label>Confirm New Password</label>
=======
=======
>>>>>>> 5c55d34 (new features)
            <label>{{ __('profile.security.current_password') }}</label>
            <input type="password" name="current_password" required>

            <label>{{ __('profile.security.new_password') }}</label>
            <input type="password" name="password" required>

            <label>{{ __('profile.security.confirm_new_password') }}</label>
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
            <input type="password" name="password_confirmation" required>

            @error('current_password')
                <p class="error">{{ $message }}</p>
            @enderror

            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror

<<<<<<< HEAD
<<<<<<< HEAD
            <button type="submit" class="btn-primary">Update Password</button>
=======
            <button type="submit" class="btn-primary">
                {{ __('profile.security.update_password') }}
            </button>
>>>>>>> fc7673c (frontend update and some new feature)
=======
            <button type="submit" class="btn-primary">
                {{ __('profile.security.update_password') }}
            </button>
>>>>>>> 5c55d34 (new features)
        </form>

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
