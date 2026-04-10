@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp

<aside class="profile-sidebar">

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

    <nav class="sidebar-menu">

        <a class="{{ request()->routeIs('profile.index') ? 'active' : '' }}"
           href="{{ route('profile.index') }}">
<<<<<<< HEAD
           <i class="fa-solid fa-user"></i> Profile
=======
           <i class="fa-solid fa-user"></i> {{ __('profile.sidebar_profile') }}
>>>>>>> fc7673c (frontend update and some new feature)
        </a>

        <a class="{{ request()->routeIs('orders.*') ? 'active' : '' }}"
           href="{{ route('orders.index') }}">
<<<<<<< HEAD
           <i class="fa-solid fa-box"></i> Orders
=======
           <i class="fa-solid fa-box"></i> {{ __('profile.sidebar_orders') }}
>>>>>>> fc7673c (frontend update and some new feature)
        </a>

        <a class="{{ request()->routeIs('profile.rewards') ? 'active' : '' }}"
           href="{{ route('profile.rewards') }}">
<<<<<<< HEAD
           <i class="fa-solid fa-star"></i> Rewards
=======
           <i class="fa-solid fa-star"></i> {{ __('profile.sidebar_rewards') }}
>>>>>>> fc7673c (frontend update and some new feature)
        </a>

        <a class="{{ request()->routeIs('profile.discounts') ? 'active' : '' }}"
           href="{{ route('profile.discounts') }}">
<<<<<<< HEAD
           <i class="fa-solid fa-ticket"></i> Discounts
        </a>

        <a class="{{ request()->routeIs('profile.security') ? 'active' : '' }}" 
            href="{{ route('profile.security') }}">
            <i class="fa-solid fa-lock"></i> Security
=======
           <i class="fa-solid fa-ticket"></i> {{ __('profile.sidebar_discounts') }}
        </a>

        <a class="{{ request()->routeIs('profile.security') ? 'active' : '' }}"
           href="{{ route('profile.security') }}">
           <i class="fa-solid fa-lock"></i> {{ __('profile.sidebar_security') }}
>>>>>>> fc7673c (frontend update and some new feature)
        </a>

        <a class="{{ request()->routeIs('settings.index') ? 'active' : '' }}"
           href="{{ route('settings.index') }}">
<<<<<<< HEAD
           <i class="fa-solid fa-gear"></i> Settings
=======
           <i class="fa-solid fa-gear"></i> {{ __('profile.sidebar_settings') }}
>>>>>>> fc7673c (frontend update and some new feature)
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="menu-logout">
<<<<<<< HEAD
                <i class="fa-solid fa-right-from-bracket"></i> Logout
=======
                <i class="fa-solid fa-right-from-bracket"></i>
                {{ __('profile.logout') }}
>>>>>>> fc7673c (frontend update and some new feature)
            </button>
        </form>

    </nav>
<<<<<<< HEAD
</aside>
=======
</aside>
>>>>>>> fc7673c (frontend update and some new feature)
