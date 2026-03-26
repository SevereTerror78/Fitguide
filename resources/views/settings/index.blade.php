@extends('layouts.settings')
@section('title', 'Settings • FitGuide')

@section('content')
@php($t = auth()->user()->theme ?? 'dark')

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
@endsection
