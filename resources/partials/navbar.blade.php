<nav class="navbar">
  <div class="container navbar-inner">
    <div class="nav-left">
      <button class="nav-toggle" id="navToggle" aria-label="{{ __('nav.toggle_menu') }}">
        <i class="fa-solid fa-bars"></i>
      </button>

      <div class="nav-links" id="navMenu">
        <a href="/" class="{{ request()->routeIs('home') ? 'active' : '' }}">{{ __('nav.home') }}</a>
        <a href="/exercises" class="{{ request()->routeIs('exercises.*') ? 'active' : '' }}">{{ __('nav.exercises') }}</a>
        <a href="/store" class="{{ request()->routeIs('store.*') ? 'active' : '' }}">{{ __('nav.store') }}</a>
        <a href="/advice" class="{{ request()->routeIs('advice.*') ? 'active' : '' }}">{{ __('nav.advice') }}</a>
      </div>
    </div>

    <div class="auth-buttons" id="authMenu">
      @auth
        <span class="username">{{ Auth::user()->name }}</span>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn-login">{{ __('nav.logout') }}</button>
        </form>

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