@extends('layouts.main')

<<<<<<< HEAD
@section('title', 'Edit Profile • FitGuide')
=======
@section('title', __('profile.edit_page_title') . ' • FitGuide')
>>>>>>> fc7673c (frontend update and some new feature)

@section('head')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile-container">

<<<<<<< HEAD
    {{-- LEFT SIDEBAR --}}
    @include('profile.sidebar')

    {{-- RIGHT MAIN CONTENT --}}
    <section class="profile-main">
        <h2 class="section-title">Edit Profile</h2>
=======
    @include('profile.sidebar')

    <section class="profile-main">
        <h2 class="section-title">{{ __('profile.edit_title') }}</h2>
>>>>>>> fc7673c (frontend update and some new feature)

        <form method="POST" action="{{ route('profile.update') }}"
              enctype="multipart/form-data"
              class="profile-overview">
            @csrf
            @method('PATCH')

<<<<<<< HEAD
            {{-- PROFILE PICTURE --}}
            <div class="overview-item full">
                <label>Profile Picture</label>
                <input type="file" name="profile_picture" class="profile-input" accept="image/*">
            </div>

            {{-- NAME --}}
            <div class="overview-item">
                <label>Full Name</label>
=======
            <div class="overview-item">
                <label>{{ __('profile.full_name') }}</label>
>>>>>>> fc7673c (frontend update and some new feature)
                <input class="profile-input" type="text" name="name"
                       value="{{ old('name', $user->name) }}" required>
            </div>

<<<<<<< HEAD
            {{-- EMAIL --}}
            <div class="overview-item">
                <label>Email</label>
=======
            <div class="overview-item">
                <label>{{ __('profile.email') }}</label>
>>>>>>> fc7673c (frontend update and some new feature)
                <input class="profile-input" type="email" name="email"
                       value="{{ old('email', $user->email) }}" required>
            </div>

<<<<<<< HEAD
            {{-- PHONE --}}
            <div class="overview-item">
                <label>Phone Number</label>
=======
            <div class="overview-item">
                <label>{{ __('profile.phone') }}</label>
>>>>>>> fc7673c (frontend update and some new feature)
                <input class="profile-input" type="text" name="phone"
                       value="{{ old('phone', $user->phone) }}">
            </div>

<<<<<<< HEAD
            {{-- DOB --}}
            <div class="overview-item">
                <label>Date of Birth</label>
=======
            <div class="overview-item">
                <label>{{ __('profile.dob') }}</label>
>>>>>>> fc7673c (frontend update and some new feature)
                <input
                    class="profile-input"
                    type="date"
                    name="dob"
                    value="{{ old('dob', $user->dob ? \Carbon\Carbon::parse($user->dob)->format('Y-m-d') : '') }}"
                >
<<<<<<< HEAD

            </div>

            {{-- GENDER --}}
            <div class="overview-item full">
                <label>Gender</label>
                <select name="gender" class="profile-input">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>Other</option>
=======
            </div>

            <div class="overview-item full">
                <label>{{ __('profile.gender') }}</label>
                <select name="gender" class="profile-input">
                    <option value="">{{ __('profile.select_gender') }}</option>
                    <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>
                        {{ __('profile.male') }}
                    </option>
                    <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>
                        {{ __('profile.female') }}
                    </option>
                    <option value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>
                        {{ __('profile.other') }}
                    </option>
>>>>>>> fc7673c (frontend update and some new feature)
                </select>
            </div>

            <button type="submit" class="btn-primary full mt">
<<<<<<< HEAD
                Save Changes
=======
                {{ __('profile.save_changes') }}
>>>>>>> fc7673c (frontend update and some new feature)
            </button>
        </form>
    </section>
</div>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> fc7673c (frontend update and some new feature)
