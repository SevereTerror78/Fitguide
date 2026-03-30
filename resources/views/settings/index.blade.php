@extends('layouts.settings')
@section('title', 'Settings • FitGuide')

@section('content')
@php($t = auth()->user()->theme ?? 'dark')

<div class="settings-wrap">

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
    <button type="button" class="theme-btn {{ $t==='colorblind'?'active':'' }}" data-theme="colorblind">Colorblind</button>
  </div>

  <p class="theme-hint">High contrast colors, color-safe palette.</p>
  <input type="hidden" id="theme-input" name="theme" value="{{ $t }}">
</div>

<div class="form-group">
  <label>💱 Currency</label>
  <select name="currency" class="form-select">
    <option value="HUF" @selected(auth()->user()->currency === 'HUF')>HUF – Forint</option>
    <option value="EUR" @selected(auth()->user()->currency === 'EUR')>EUR – Euro</option>
    <option value="USD" @selected(auth()->user()->currency === 'USD')>USD – Dollar</option>
  </select>
</div>

<div class="settings-actions">
  <button type="submit" class="btn-save">Save changes</button>
  <a href="/profile" class="back-btn secondary">← Back</a>
</div>

</form>
</div>
@endsection
