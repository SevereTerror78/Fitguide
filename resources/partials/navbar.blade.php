<nav class="navbar">
  <div class="container navbar-inner">
    <div class="nav-left">
<<<<<<< HEAD
<<<<<<< HEAD
      <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
=======
      <button class="nav-toggle" id="navToggle" aria-label="{{ __('nav.toggle_menu') }}">
>>>>>>> fc7673c (frontend update and some new feature)
=======
      <button class="nav-toggle" id="navToggle" aria-label="{{ __('nav.toggle_menu') }}">
>>>>>>> 5c55d34 (new features)
        <i class="fa-solid fa-bars"></i>
      </button>

      <div class="nav-links" id="navMenu">
<<<<<<< HEAD
<<<<<<< HEAD
        <a href="/">HOME</a>
        <a href="/exercises">EXERCISES</a>
        <a href="/store">STORE</a>
        <a href="/advice" class="active">ADVICE</a>
=======
=======
>>>>>>> 5c55d34 (new features)
        <a href="/" class="{{ request()->routeIs('home') ? 'active' : '' }}">{{ __('nav.home') }}</a>
        <a href="/exercises" class="{{ request()->routeIs('exercises.*') ? 'active' : '' }}">{{ __('nav.exercises') }}</a>
        <a href="/store" class="{{ request()->routeIs('store.*') ? 'active' : '' }}">{{ __('nav.store') }}</a>
        <a href="/advice" class="{{ request()->routeIs('advice.*') ? 'active' : '' }}">{{ __('nav.advice') }}</a>
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
      </div>
    </div>

    <div class="auth-buttons" id="authMenu">
      @auth
        <span class="username">{{ Auth::user()->name }}</span>
<<<<<<< HEAD
<<<<<<< HEAD
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn-login">LOG OUT</button>
        </form>
        @php $cartCount = collect(session('cart', []))->sum('qty'); @endphp
        <a href="{{ route('cart.index') }}" class="nav-cart">
=======
=======
>>>>>>> 5c55d34 (new features)

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn-login">{{ __('nav.logout') }}</button>
        </form>

        @php $cartCount = collect(session('cart', []))->sum('qty'); @endphp
        <a href="{{ route('cart.index') }}" class="nav-cart" aria-label="{{ __('nav.cart') }}">
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
          <i class="fa-solid fa-cart-shopping"></i>
          @if($cartCount)
            <span class="cart-badge">{{ $cartCount }}</span>
          @endif
        </a>
      @else
<<<<<<< HEAD
<<<<<<< HEAD
        <a class="btn-login" href="{{ route('login') }}">LOG IN</a>
        <a class="btn-login" href="{{ route('register') }}">REGISTER</a>
      @endauth
    </div>
  </div>
</nav>
=======
=======
>>>>>>> 5c55d34 (new features)
        <a class="btn-login" href="{{ route('login') }}">{{ __('nav.login') }}</a>
        <a class="btn-login" href="{{ route('register') }}">{{ __('nav.register') }}</a>
      @endauth
    </div>
  </div>
<<<<<<< HEAD
</nav>
>>>>>>> fc7673c (frontend update and some new feature)
=======
</nav>
>>>>>>> 5c55d34 (new features)
