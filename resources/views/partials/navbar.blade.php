<nav class="navbar">
  <div class="container navbar-inner">

    <!-- BAL OLDAL: oldalak -->
    <div class="nav-left">
      <button class="nav-toggle" id="navToggle" aria-label="{{ __('nav.toggle_menu') }}">
        <i class="fa-solid fa-bars"></i>
      </button>

      <div class="nav-links" id="navMenu">
        <a href="/" class="{{ request()->routeIs('home') ? 'active' : '' }}">{{ __('nav.home') }}</a>
        <a href="/exercises" class="{{ request()->routeIs('exercises.*') ? 'active' : '' }}">{{ __('nav.exercises') }}</a>
        <a href="/store" class="{{ request()->routeIs('store.*') ? 'active' : '' }}">{{ __('nav.store') }}</a>
        <a href="/advice" class="{{ request()->routeIs('advice.*') ? 'active' : '' }}">{{ __('nav.advice') }}</a>

        @if(auth()->check() && auth()->user()->role === 'admin')
          <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.*') ? 'active' : '' }}">
            {{ __('nav.admin_panel') }}
          </a>
        @endif
      </div>
    </div>

    <!-- JOBB OLDAL: Cart + Profile egy sorban -->
    <div class="user-area">

      @auth
        <div class="relative group user-dropdown">

          <!-- BUTTON – csak a név, nincs ikon/keret -->
          <button class="user-btn" type="button" aria-label="{{ __('nav.user_menu') }}">
            {{ auth()->user()->name }}
            <i class="fa-solid fa-chevron-down"></i>
          </button>

          <!-- DROPDOWN -->
          <div class="dropdown-menu">
            <a href="{{ route('profile.index') }}" class="dropdown-item">
              {{ __('nav.profile') }}
            </a>
            <a href="{{ route('orders.index') }}" class="dropdown-item">
              {{ __('nav.orders') }}
            </a>
            <a href="{{ route('settings.index') }}" class="dropdown-item">
              {{ __('nav.settings') }}
            </a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="dropdown-item logout-item" type="submit">
                {{ __('nav.logout') }}
              </button>
            </form>
          </div>
        </div>

        <!-- CART ICON -->
        @php $cartCount = collect(session('cart', []))->sum('qty'); @endphp
        <a href="{{ route('cart.index') }}" class="nav-cart" aria-label="{{ __('nav.cart') }}">
          <i class="fa-solid fa-cart-shopping"></i>
          @if($cartCount)
            <span class="cart-badge">{{ $cartCount }}</span>
          @endif
        </a>

      @else
        <a class="btn-login" href="{{ route('login') }}">{{ __('nav.login') }}</a>
        <a class="btn-login" href="{{ route('register') }}">{{ __('nav.register') }}</a>
      @endauth

    </div>

  </div>
</nav>