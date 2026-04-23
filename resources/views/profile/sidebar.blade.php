@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp

<aside class="profile-sidebar">

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
    <nav class="sidebar-menu">

        <a class="{{ request()->routeIs('profile.index') ? 'active' : '' }}"
           href="{{ route('profile.index') }}">
           <i class="fa-solid fa-user"></i> {{ __('profile.sidebar_profile') }}
        </a>

        <a class="{{ request()->routeIs('orders.*') ? 'active' : '' }}"
           href="{{ route('orders.index') }}">
           <i class="fa-solid fa-box"></i> {{ __('profile.sidebar_orders') }}
        </a>

        <a class="{{ request()->routeIs('profile.rewards') ? 'active' : '' }}"
           href="{{ route('profile.rewards') }}">
           <i class="fa-solid fa-star"></i> {{ __('profile.sidebar_rewards') }}
        </a>

        <a class="{{ request()->routeIs('profile.discounts') ? 'active' : '' }}"
           href="{{ route('profile.discounts') }}">
           <i class="fa-solid fa-ticket"></i> {{ __('profile.sidebar_discounts') }}
        </a>

        <a class="{{ request()->routeIs('profile.security') ? 'active' : '' }}"
           href="{{ route('profile.security') }}">
           <i class="fa-solid fa-lock"></i> {{ __('profile.sidebar_security') }}
        </a>

        <a class="{{ request()->routeIs('settings.index') ? 'active' : '' }}"
           href="{{ route('settings.index') }}">
           <i class="fa-solid fa-gear"></i> {{ __('profile.sidebar_settings') }}
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="menu-logout" type="submit">
                <i class="fa-solid fa-right-from-bracket"></i>
                {{ __('profile.logout') }}
            </button>
        </form>

    </nav>
</aside>