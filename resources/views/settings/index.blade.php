@extends('layouts.main')
@section('title', __('settings.page_title') . ' • FitGuide')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
  <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
  <script src="{{ asset('js/settings.js') }}" defer></script>
@endsection

@section('content')
@php($t = auth()->user()->theme ?? 'dark')

<div class="profile-container">

  @include('profile.sidebar')

  <section class="profile-main settings-page-main">
    <h2 class="section-title">{{ __('settings.page_title') }}</h2>

    <div class="settings-wrap">

    {{--
      @if (session('success'))
        <div class="success-message">{{ session('success') }}</div>
      @endif

      @if ($errors->any())
        <div class="error-message">
          <ul>
            @foreach ($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      --}}

      <form method="POST" action="{{ route('settings.update') }}" class="settings-form">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label for="language">🌍 {{ __('settings.language') }}</label>
          <select id="language" name="language" class="form-select">
            <option value="en" @selected(auth()->user()->language === 'en')>{{ __('settings.english') }}</option>
            <option value="hu" @selected(auth()->user()->language === 'hu')>{{ __('settings.hungarian') }}</option>
          </select>
        </div>

        <div class="form-group">
          <label>🎨 {{ __('settings.theme') }}</label>

          <div class="theme-toggle">
            <button type="button"
                    class="theme-btn {{ $t === 'light' ? 'active' : '' }}"
                    data-theme="light"
                    aria-pressed="{{ $t === 'light' ? 'true' : 'false' }}">
              {{ __('settings.theme_light') }}
            </button>

            <button type="button"
                    class="theme-btn {{ $t === 'dark' ? 'active' : '' }}"
                    data-theme="dark"
                    aria-pressed="{{ $t === 'dark' ? 'true' : 'false' }}">
              {{ __('settings.theme_dark') }}
            </button>

            <button type="button"
                    class="theme-btn {{ $t === 'hc' ? 'active' : '' }}"
                    data-theme="hc"
                    aria-pressed="{{ $t === 'hc' ? 'true' : 'false' }}">
              {{ __('settings.theme_hc') }}
            </button>
          </div>

          <p class="theme-hint">{{ __('settings.theme_hint') }}</p>
          <input type="hidden" id="theme-input" name="theme" value="{{ $t }}">
        </div>

        <div class="form-group">
          <label for="currency">💵{{ __('settings.currency') }}</label>
          <select id="currency" name="currency" class="form-select">
            <option value="HUF" @selected(auth()->user()->currency === 'HUF')>{{ __('settings.currency_huf') }}</option>
            <option value="EUR" @selected(auth()->user()->currency === 'EUR')>{{ __('settings.currency_eur') }}</option>
          </select>
        </div>

        <div class="settings-actions">
          <button type="submit" class="btn-save">{{ __('settings.save_changes') }}</button>
          <a href="{{ route('profile.index') }}" class="back-btn secondary">← {{ __('settings.back') }}</a>
        </div>
      </form>

    </div>
  </section>
</div>
@endsection