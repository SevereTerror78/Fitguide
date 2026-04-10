<nav class="navbar">
  <div class="container navbar-inner">
    <div class="nav-left">
<<<<<<< HEAD
      <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
=======
      <button class="nav-toggle" id="navToggle" aria-label="{{ __('nav.toggle_menu') }}">
>>>>>>> fc7673c (frontend update and some new feature)
        <i class="fa-solid fa-bars"></i>
      </button>

      <div class="nav-links" id="navMenu">
<<<<<<< HEAD
        <a href="/">HOME</a>
        <a href="/exercises">EXERCISES</a>
        <a href="/store">STORE</a>
        <a href="/advice" class="active">ADVICE</a>
=======
        <a href="/" class="{{ request()->routeIs('home') ? 'active' : '' }}">{{ __('nav.home') }}</a>
        <a href="/exercises" class="{{ request()->routeIs('exercises.*') ? 'active' : '' }}">{{ __('nav.exercises') }}</a>
        <a href="/store" class="{{ request()->routeIs('store.*') ? 'active' : '' }}">{{ __('nav.store') }}</a>
        <a href="/advice" class="{{ request()->routeIs('advice.*') ? 'active' : '' }}">{{ __('nav.advice') }}</a>
>>>>>>> fc7673c (frontend update and some new feature)
      </div>
    </div>

    <div class="auth-buttons" id="authMenu">
      @auth
        <span class="username">{{ Auth::user()->name }}</span>
<<<<<<< HEAD
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn-login">LOG OUT</button>
        </form>
        @php $cartCount = collect(session('cart', []))->sum('qty'); @endphp
        <a href="{{ route('cart.index') }}" class="nav-cart">
=======

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn-login">{{ __('nav.logout') }}</button>
        </form>

        @php $cartCount = collect(session('cart', []))->sum('qty'); @endphp
        <a href="{{ route('cart.index') }}" class="nav-cart" aria-label="{{ __('nav.cart') }}">
>>>>>>> fc7673c (frontend update and some new feature)
          <i class="fa-solid fa-cart-shopping"></i>
          @if($cartCount)
            <span class="cart-badge">{{ $cartCount }}</span>
          @endif
        </a>
      @else
<<<<<<< HEAD
        <a class="btn-login" href="{{ route('login') }}">LOG IN</a>
        <a class="btn-login" href="{{ route('register') }}">REGISTER</a>
      @endauth
    </div>
  </div>
</nav>
=======
        <a class="btn-login" href="{{ route('login') }}">{{ __('nav.login') }}</a>
        <a class="btn-login" href="{{ route('register') }}">{{ __('nav.register') }}</a>
      @endauth
    </div>
  </div>
</nav>
>>>>>>> fc7673c (frontend update and some new feature)
