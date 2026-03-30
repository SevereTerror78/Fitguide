<<<<<<< HEAD
@extends('layouts.settings')
@section('title', 'Settings • FitGuide')
=======
@extends('layouts.main')
@section('title', __('settings.page_title') . ' • FitGuide')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
  <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
  <script src="{{ asset('js/settings.js') }}" defer></script>
@endsection
>>>>>>> 5c55d34 (new features)

@section('content')
@php($t = auth()->user()->theme ?? 'dark')

<<<<<<< HEAD
<<<<<<< HEAD
=======
<div class="settings-wrap">

>>>>>>> fc7673c (frontend update and some new feature)
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

<form method="POST" action="{{ route('settings.update') }}" class="settings-form">
<<<<<<< HEAD
  @csrf
  @method('PUT')

  {{-- Language --}}
  <div class="form-group">
    <label for="language">🌍 Language</label>
    <select id="language" name="language" class="form-select">
      <option value="hu" @selected(auth()->user()->language === 'hu')>Magyar</option>
      <option value="en" @selected(auth()->user()->language === 'en')>English</option>
    </select>
  </div>

  {{-- Theme --}}
  <div class="form-group">
    <label>🎨 Theme</label>

    <div class="theme-toggle">
      <button type="button"
        class="theme-btn {{ $t === 'light' ? 'active' : '' }}"
        data-theme="light"
        aria-pressed="{{ $t === 'light' ? 'true' : 'false' }}">
        Light
      </button>

      <button type="button"
        class="theme-btn {{ $t === 'dark' ? 'active' : '' }}"
        data-theme="dark"
        aria-pressed="{{ $t === 'dark' ? 'true' : 'false' }}">
        Dark
      </button>

      <button type="button"
        class="theme-btn {{ $t === 'colorblind' ? 'active' : '' }}"
        data-theme="colorblind"
        aria-pressed="{{ $t === 'colorblind' ? 'true' : 'false' }}">
        Colorblind
      </button>
    </div>

    <p class="theme-hint">High contrast colors, color-safe palette.</p>

    <input type="hidden" name="theme" id="theme-input" value="{{ $t }}">
  </div>

  {{-- Currency --}}
  <div class="form-group">
    <label for="currency">💱 Currency</label>
    <select id="currency" name="currency" class="form-select">
      <option value="HUF" @selected(auth()->user()->currency === 'HUF')>HUF – Forint</option>
      <option value="EUR" @selected(auth()->user()->currency === 'EUR')>EUR – Euro</option>
      <option value="USD" @selected(auth()->user()->currency === 'USD')>USD – Dollar</option>
    </select>
  </div>

  <div class="form-group submit-group">
    <button type="submit" class="btn-save">Save changes</button>
  </div>
</form>

<script src="{{ asset('js/settings-theme.js') }}?v={{ time() }}" defer></script>
=======
@csrf
@method('PUT')

<div class="form-group">
  <label>🌍 Language</label>
  <select name="language" class="form-select">
    <option value="en" @selected(auth()->user()->language === 'en')>English</option>
    <option value="hu" @selected(auth()->user()->language === 'hu')>Magyar</option>
  </select>
</div>

<div class="form-group">
  <label>🎨 Theme</label>

  <div class="theme-toggle">
    <button type="button" class="theme-btn {{ $t==='light'?'active':'' }}" data-theme="light">Light</button>
    <button type="button" class="theme-btn {{ $t==='dark'?'active':'' }}" data-theme="dark">Dark</button>
    <button type="button" class="theme-btn {{ $t==='hc'?'active':'' }}" data-theme="hc">High Contrast</button>
  </div>

  <p class="theme-hint">High contrast colors, color-safe palette.</p>
  <input type="hidden" id="theme-input" name="theme" value="{{ $t }}">
</div>

<div class="form-group">
  <label>💱 Currency</label>
  <select name="currency" class="form-select">
    <option value="HUF" @selected(auth()->user()->currency === 'HUF')>HUF – Forint</option>
    <option value="EUR" @selected(auth()->user()->currency === 'EUR')>EUR – Euro</option>
  </select>
</div>

<div class="settings-actions">
  <button type="submit" class="btn-save">Save changes</button>
  <a href="/profile" class="back-btn secondary">← Back</a>
</div>

</form>
</div>
>>>>>>> fc7673c (frontend update and some new feature)
@endsection
=======
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
>>>>>>> 5c55d34 (new features)
