@extends('layouts.main')

@section('title', __('profile.page_title') . ' • FitGuide')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile-container">

  {{-- LEFT SIDEBAR --}}
  @include('profile.sidebar')

  {{-- RIGHT MAIN CONTENT --}}
  <section class="profile-main">
    <h2 class="section-title">{{ __('profile.summary_title') }}</h2>

    <div class="profile-stats">
      <div class="stat-card">
        <span class="stat-label">{{ __('profile.orders') }}</span>
        <span class="stat-value">{{ $ordersCount }}</span>
      </div>

      <div class="stat-card">
        <span class="stat-label">{{ __('profile.points') }}</span>
        <span class="stat-value">{{ $points }}</span>
      </div>
    </div>

    <div class="profile-overview">
      <div class="overview-item">
        <label>{{ __('profile.full_name') }}</label>
        <p>{{ $user->name }}</p>
      </div>

      <div class="overview-item">
        <label>{{ __('profile.email') }}</label>
        <p>{{ $user->email }}</p>
      </div>

      <div class="overview-item">
        <label>{{ __('profile.phone') }}</label>
        <p>{{ $user->phone ?? '—' }}</p>
      </div>

      <div class="overview-item">
        <label>{{ __('profile.dob') }}</label>
        <p>{{ $user->dob ?? '—' }}</p>
      </div>

      <div class="overview-item">
        <label>{{ __('profile.gender') }}</label>
        <p style="text-transform: capitalize">{{ $user->gender ?? '—' }}</p>
      </div>
    </div>

    <a href="{{ route('profile.edit') }}" class="btn-primary mt">
  {{ __('profile.edit_profile') }}
</a>

<div class="danger-zone mt">
  <div class="danger-zone__header">
    <div class="danger-zone__icon">⚠</div>
    <div>
      <h3 class="danger-zone__title">{{ __('profile.delete_account') }}</h3>
      <p class="danger-zone__subtitle">{{ __('profile.delete_warning') }}</p>
    </div>
  </div>

  <button type="button" id="deleteTrigger" class="btn-danger danger-zone__trigger">
    {{ __('profile.delete_account') }}
  </button>

  <form method="POST" action="{{ route('profile.destroy') }}" class="danger-zone__form" id="deleteConfirm" style="display:none;">
    @csrf
    @method('DELETE')

    <label class="danger-zone__label">
      {{ __('profile.type_delete_to_confirm') }}
    </label>

    <input
      type="text"
      name="confirmation_text"
      required
      placeholder="DELETEACCOUNT"
      class="danger-zone__input"
      autocomplete="off"
      autocapitalize="off"
      spellcheck="false"
    >

    @error('confirmation_text', 'userDeletion')
      <div class="danger-zone__error">
        {{ $message }}
      </div>
    @enderror

    <div class="danger-zone__hint">
      DELETEACCOUNT
    </div>

    <div class="danger-zone__actions">
      <button type="submit" class="btn-danger" id="delete-btn" disabled>
        {{ __('profile.confirm_delete') }}
      </button>

      <button type="button" class="btn-secondary danger-zone__cancel" id="deleteCancelBtn">
        {{ __('profile.cancel') }}
      </button>
    </div>
  </form>
</div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const trigger = document.getElementById('deleteTrigger');
  const box = document.getElementById('deleteConfirm');
  const cancel = document.getElementById('deleteCancelBtn');
  const input = document.querySelector('input[name="confirmation_text"]');
  const btn = document.getElementById('delete-btn');

  if (trigger && box) {
    trigger.addEventListener('click', function () {
      box.style.display = 'block';
      trigger.style.display = 'none';
      if (input) input.focus();
    });
  }

  if (cancel && box && trigger) {
    cancel.addEventListener('click', function () {
      box.style.display = 'none';
      trigger.style.display = 'inline-flex';
      if (input) input.value = '';
      if (btn) btn.disabled = true;
    });
  }

  if (input && btn) {
    input.addEventListener('input', function () {
      btn.disabled = input.value.trim() !== 'DELETEACCOUNT';
    });
  }
});
</script>
@endpush