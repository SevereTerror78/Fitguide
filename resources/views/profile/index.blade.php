@extends('layouts.main')

@section('title', 'My Profile • FitGuide')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile-container">

  {{-- LEFT SIDEBAR --}}
  @include('profile.sidebar')

  {{-- RIGHT MAIN CONTENT --}}
  <section class="profile-main">
    <h2 class="section-title">Profile Summary</h2>

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
        <p style="text-transform: capitalize">{{ $user->gender ?? '—' }}</p>
      </div>
    </div>

    <a href="{{ route('profile.edit') }}" class="btn-primary mt">Edit Profile</a>

    <form method="POST" action="{{ route('profile.destroy') }}" class="mt">
      @csrf
      @method('DELETE')

      <div id="deleteConfirm" style="display:none; margin-top:16px; max-width:360px;">
        <label style="display:block; margin-bottom:6px; opacity:.85;">Confirm password</label>

        <input
          type="password"
          name="password"
          required
          placeholder="Your password"
          class="input"
          style="width:100%; padding:10px; border-radius:8px;"
        >

        @error('password', 'userDeletion')
          <div style="color:#ff6b6b; margin-top:6px; font-size:13px;">{{ $message }}</div>
        @enderror

        <div style="display:flex; gap:10px; margin-top:12px;">
          <button type="submit" class="btn-danger">Confirm delete</button>
          <button type="button" class="btn-secondary" onclick="hideDeleteConfirm()">Cancel</button>
        </div>
      </div>

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

@push('scripts')
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
@endpush
