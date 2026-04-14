@extends('layouts.main')

@section('title', __('profile.edit_page_title') . ' • FitGuide')

@section('head')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile-container">

    @include('profile.sidebar')

    <section class="profile-main">
        <h2 class="section-title">{{ __('profile.edit_title') }}</h2>

        <form method="POST" action="{{ route('profile.update') }}"
              enctype="multipart/form-data"
              class="profile-overview">
            @csrf
            @method('PATCH')

            <div class="overview-item">
                <label>{{ __('profile.full_name') }}</label>
                <input class="profile-input" type="text" name="name"
                       value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="overview-item">
                <label>{{ __('profile.email') }}</label>
                <input class="profile-input" type="email" name="email"
                       value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="overview-item">
                <label>{{ __('profile.phone') }}</label>
                <input class="profile-input" type="text" name="phone"
                       value="{{ old('phone', $user->phone) }}">
            </div>

            <div class="overview-item">
                <label>{{ __('profile.dob') }}</label>
                <input
                    class="profile-input"
                    type="date"
                    name="dob"
                    value="{{ old('dob', $user->dob ? \Carbon\Carbon::parse($user->dob)->format('Y-m-d') : '') }}"
                >
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
                </select>
            </div>

            <button type="submit" class="btn-primary full mt">
                {{ __('profile.save_changes') }}
            </button>
        </form>
    </section>
</div>
@endsection