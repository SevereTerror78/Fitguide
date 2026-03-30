@extends('layouts.main')

<<<<<<< HEAD
<<<<<<< HEAD
@section('title', 'My Profile • FitGuide')

@section('head')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
=======
=======
>>>>>>> 5c55d34 (new features)
@section('title', __('profile.page_title') . ' • FitGuide')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
@endsection

@section('content')
<div class="profile-container">

<<<<<<< HEAD
<<<<<<< HEAD
    {{-- LEFT SIDEBAR --}}
    @include('profile.sidebar')

    {{-- RIGHT MAIN CONTENT --}}
    <section class="profile-main">
        <h2 class="section-title">Profile Summary</h2>

        {{-- 🔹 STAT KÁRTYÁK --}}
        <div class="profile-stats">

            <div class="stat-card">
                <span class="stat-label">Orders</span>
                <span class="stat-value">{{ $ordersCount }}</span>
            </div>

            <div class="stat-card">
                <span class="stat-label">Points</span>
                <span class="stat-value">{{ $points }}</span>
            </div>

        </div>

        {{-- 🔹 USER INFO BLOCKS --}}
        <div class="profile-overview">

            <div class="overview-item">
                <label>Full Name</label>
                <p>{{ $user->name }}</p>
            </div>

            <div class="overview-item">
                <label>Email</label>
                <p>{{ $user->email }}</p>
            </div>

            <div class="overview-item">
                <label>Phone Number</label>
                <p>{{ $user->phone ?? '—' }}</p>
            </div>

            <div class="overview-item">
                <label>Date of Birth</label>
                <p>{{ $user->dob ?? '—' }}</p>
            </div>

            <div class="overview-item">
                <label>Gender</label>
                <p style="text-transform: capitalize">
                    {{ $user->gender ?? '—' }}
                </p>
            </div>
        </div>

        <a href="{{ route('profile.edit') }}" class="btn-primary mt">
            Edit Profile
        </a>

        <form method="POST" action="{{ route('profile.destroy') }}" class="mt">
        @csrf
        @method('DELETE')

        {{-- MEGERŐSÍTŐ PANEL --}}
        <div id="deleteConfirm" style="display:none; margin-top:16px; max-width:360px;">
            <label style="display:block; margin-bottom:6px; opacity:.85;">
            Confirm password
            </label>

            <input
            type="password"
            name="password"
            required
            placeholder="Your password"
            class="input"
            style="width:100%; padding:10px; border-radius:8px;"
            >

            @error('password', 'userDeletion')
            <div style="color:#ff6b6b; margin-top:6px; font-size:13px;">
                {{ $message }}
            </div>
            @enderror

            <div style="display:flex; gap:10px; margin-top:12px;">
            <button type="submit" class="btn-danger">
                Confirm delete
            </button>

            <button type="button" class="btn-secondary" onclick="hideDeleteConfirm()">
                Cancel
            </button>
            </div>
        </div>

        {{-- ELSŐDLEGES DELETE GOMB --}}
        <button
            type="button"
            id="deleteTrigger"
            class="btn-danger"
            onclick="showDeleteConfirm()"
        >
            Delete Account
        </button>
        </form>




    </section>

</div>
@endsection
<script>
  function showDeleteConfirm() {
    document.getElementById('deleteConfirm').style.display = 'block';
    document.getElementById('deleteTrigger').style.display = 'none';
  }

  function hideDeleteConfirm() {
    document.getElementById('deleteConfirm').style.display = 'none';
    document.getElementById('deleteTrigger').style.display = 'inline-block';
  }
</script>

=======
=======
>>>>>>> 5c55d34 (new features)
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
<<<<<<< HEAD
      {{ __('profile.edit_profile') }}
    </a>

    <form method="POST" action="{{ route('profile.destroy') }}" class="mt">
      @csrf
      @method('DELETE')

      <div id="deleteConfirm" style="display:none; margin-top:16px; max-width:360px;">
        <label style="display:block; margin-bottom:6px; opacity:.85;">
          {{ __('profile.confirm_password') }}
        </label>

        <input
          type="password"
          name="password"
          required
          placeholder="{{ __('profile.password_placeholder') }}"
          class="input"
          style="width:100%; padding:10px; border-radius:8px;"
        >

        @error('password', 'userDeletion')
          <div style="color:#ff6b6b; margin-top:6px; font-size:13px;">
            {{ $message }}
          </div>
        @enderror

        <div style="display:flex; gap:10px; margin-top:12px;">
          <button type="submit" class="btn-danger">
            {{ __('profile.confirm_delete') }}
          </button>
          <button type="button" class="btn-secondary" id="deleteCancelBtn">
            {{ __('profile.cancel') }}
          </button>
        </div>
      </div>

      <button type="button" id="deleteTrigger" class="btn-danger">
        {{ __('profile.delete_account') }}
      </button>
    </form>
  </section>

=======
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
>>>>>>> 5c55d34 (new features)
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const trigger = document.getElementById('deleteTrigger');
  const box = document.getElementById('deleteConfirm');
  const cancel = document.getElementById('deleteCancelBtn');
<<<<<<< HEAD

  if (!trigger || !box) return;

  trigger.addEventListener('click', function () {
    box.style.display = 'block';
    trigger.style.display = 'none';
    const pw = box.querySelector('input[name="password"]');
    if (pw) pw.focus();
  });

  if (cancel) {
    cancel.addEventListener('click', function () {
      box.style.display = 'none';
      trigger.style.display = 'inline-block';
      const pw = box.querySelector('input[name="password"]');
      if (pw) pw.value = '';
=======
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
>>>>>>> 5c55d34 (new features)
    });
  }
});
</script>
<<<<<<< HEAD
@endpush
>>>>>>> fc7673c (frontend update and some new feature)
=======
@endpush
>>>>>>> 5c55d34 (new features)
