@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp

<aside class="profile-sidebar">

<<<<<<< HEAD
    <div class="user-info">
<<<<<<< HEAD
        <div class="user-avatar">
            @if($user?->profile_picture)
                <img src="{{ asset('storage/'.$user->profile_picture) }}" alt="Profile Picture">
            @else
                <i class="fa-solid fa-user"></i>
            @endif
=======

        <div class="user-avatar {{ $user?->role === 'admin' ? 'avatar-admin' : 'avatar-user' }}">
            {{ $user?->role === 'admin' ? 'A' : 'U' }}
>>>>>>> fc7673c (frontend update and some new feature)
        </div>

        <h3>{{ $user?->name }}</h3>

        <p class="member-text {{ $user?->role === 'admin' ? 'member-admin' : 'member-user' }}">
<<<<<<< HEAD
            {{ $user?->role === 'admin' ? 'FitGuide Admin' : 'FitGuide Member' }}
=======
            {{ $user?->role === 'admin'
                ? __('profile.admin_label')
                : __('profile.member_label') }}
>>>>>>> fc7673c (frontend update and some new feature)
        </p>
    </div>

=======
    <div class="profile-user-head">
        <div class="user-avatar {{ $user?->role === 'admin' ? 'avatar-admin' : 'avatar-user' }}">
            {{ $user?->role === 'admin' ? 'A' : 'U' }}
        </div>

        <div class="user-info">
            <h3>{{ $user?->name }}</h3>

            <p class="member-text {{ $user?->role === 'admin' ? 'member-admin' : 'member-user' }}">
                {{ $user?->role === 'admin'
                    ? __('profile.admin_label')
                    : __('profile.member_label') }}
            </p>
        </div>
    </div>
>>>>>>> 5c55d34 (new features)
    <nav class="sidebar-menu">

        <a class="{{ request()->routeIs('profile.index') ? 'active' : '' }}"
           href="{{ route('profile.index') }}">
<<<<<<< HEAD
<<<<<<< HEAD
           <i class="fa-solid fa-user"></i> Profile
=======
           <i class="fa-solid fa-user"></i> {{ __('profile.sidebar_profile') }}
>>>>>>> fc7673c (frontend update and some new feature)
=======
           <i class="fa-solid fa-user"></i> {{ __('profile.sidebar_profile') }}
>>>>>>> 5c55d34 (new features)
        </a>

        <a class="{{ request()->routeIs('orders.*') ? 'active' : '' }}"
           href="{{ route('orders.index') }}">
<<<<<<< HEAD
<<<<<<< HEAD
           <i class="fa-solid fa-box"></i> Orders
=======
           <i class="fa-solid fa-box"></i> {{ __('profile.sidebar_orders') }}
>>>>>>> fc7673c (frontend update and some new feature)
=======
           <i class="fa-solid fa-box"></i> {{ __('profile.sidebar_orders') }}
>>>>>>> 5c55d34 (new features)
        </a>

        <a class="{{ request()->routeIs('profile.rewards') ? 'active' : '' }}"
           href="{{ route('profile.rewards') }}">
<<<<<<< HEAD
<<<<<<< HEAD
           <i class="fa-solid fa-star"></i> Rewards
=======
           <i class="fa-solid fa-star"></i> {{ __('profile.sidebar_rewards') }}
>>>>>>> fc7673c (frontend update and some new feature)
=======
           <i class="fa-solid fa-star"></i> {{ __('profile.sidebar_rewards') }}
>>>>>>> 5c55d34 (new features)
        </a>

        <a class="{{ request()->routeIs('profile.discounts') ? 'active' : '' }}"
           href="{{ route('profile.discounts') }}">
<<<<<<< HEAD
<<<<<<< HEAD
           <i class="fa-solid fa-ticket"></i> Discounts
        </a>

        <a class="{{ request()->routeIs('profile.security') ? 'active' : '' }}" 
            href="{{ route('profile.security') }}">
            <i class="fa-solid fa-lock"></i> Security
=======
=======
>>>>>>> 5c55d34 (new features)
           <i class="fa-solid fa-ticket"></i> {{ __('profile.sidebar_discounts') }}
        </a>

        <a class="{{ request()->routeIs('profile.security') ? 'active' : '' }}"
           href="{{ route('profile.security') }}">
           <i class="fa-solid fa-lock"></i> {{ __('profile.sidebar_security') }}
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
        </a>

        <a class="{{ request()->routeIs('settings.index') ? 'active' : '' }}"
           href="{{ route('settings.index') }}">
<<<<<<< HEAD
<<<<<<< HEAD
           <i class="fa-solid fa-gear"></i> Settings
=======
           <i class="fa-solid fa-gear"></i> {{ __('profile.sidebar_settings') }}
>>>>>>> fc7673c (frontend update and some new feature)
=======
           <i class="fa-solid fa-gear"></i> {{ __('profile.sidebar_settings') }}
>>>>>>> 5c55d34 (new features)
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
<<<<<<< HEAD
            <button class="menu-logout">
<<<<<<< HEAD
                <i class="fa-solid fa-right-from-bracket"></i> Logout
=======
                <i class="fa-solid fa-right-from-bracket"></i>
                {{ __('profile.logout') }}
>>>>>>> fc7673c (frontend update and some new feature)
=======
            <button class="menu-logout" type="submit">
                <i class="fa-solid fa-right-from-bracket"></i>
                {{ __('profile.logout') }}
>>>>>>> 5c55d34 (new features)
            </button>
        </form>

    </nav>
<<<<<<< HEAD
<<<<<<< HEAD
</aside>
=======
</aside>
>>>>>>> fc7673c (frontend update and some new feature)
=======
</aside>
>>>>>>> 5c55d34 (new features)
