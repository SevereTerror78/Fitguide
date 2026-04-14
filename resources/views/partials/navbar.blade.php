<nav class="navbar">
  <div class="container navbar-inner">

    <!-- BAL OLDAL: oldalak -->
    <div class="nav-left">
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
      <button class="nav-toggle" id="navToggle">
=======
      <button class="nav-toggle" id="navToggle" aria-label="{{ __('nav.toggle_menu') }}">
>>>>>>> fc7673c (frontend update and some new feature)
=======
      <button class="nav-toggle" id="navToggle" aria-label="{{ __('nav.toggle_menu') }}">
>>>>>>> 5c55d34 (new features)
=======
      <button class="nav-toggle" id="navToggle" aria-label="{{ __('nav.toggle_menu') }}">
>>>>>>> 9e16f42 (Újabb push)
        <i class="fa-solid fa-bars"></i>
      </button>

      <div class="nav-links" id="navMenu">
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        <a href="/">HOME</a>
        <a href="/exercises">EXERCISES</a>
        <a href="/store">STORE</a>
        <a href="/advice">ADVICE</a>
        @if(auth()->check() && auth()->user()->role === 'admin')
          <a href="{{ route('admin.dashboard') }}">ADMIN PANEL</a>
=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
        <a href="/" class="{{ request()->routeIs('home') ? 'active' : '' }}">{{ __('nav.home') }}</a>
        <a href="/exercises" class="{{ request()->routeIs('exercises.*') ? 'active' : '' }}">{{ __('nav.exercises') }}</a>
        <a href="/store" class="{{ request()->routeIs('store.*') ? 'active' : '' }}">{{ __('nav.store') }}</a>
        <a href="/advice" class="{{ request()->routeIs('advice.*') ? 'active' : '' }}">{{ __('nav.advice') }}</a>

        @if(auth()->check() && auth()->user()->role === 'admin')
          <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.*') ? 'active' : '' }}">
            {{ __('nav.admin_panel') }}
          </a>
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
        @endif
      </div>
    </div>

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
      <!-- JOBB OLDAL: Cart + Profile egy sorban -->
  <div class="user-area">

      @auth
      <div class="relative group user-dropdown">

          <!-- BUTTON – csak a név, nincs ikon/keret -->
          <button class="user-btn">
              {{ auth()->user()->name }}
              <i class="fa-solid fa-chevron-down"></i>
=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
    <!-- JOBB OLDAL: Cart + Profile egy sorban -->
    <div class="user-area">

      @auth
        <div class="relative group user-dropdown">

          <!-- BUTTON – csak a név, nincs ikon/keret -->
          <button class="user-btn" type="button" aria-label="{{ __('nav.user_menu') }}">
            {{ auth()->user()->name }}
            <i class="fa-solid fa-chevron-down"></i>
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
          </button>

          <!-- DROPDOWN -->
          <div class="dropdown-menu">
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
              <a href="{{ route('profile.index') }}" class="dropdown-item">
                  Profile
              </a>
              <a href="{{ route('orders.index') }}" class="dropdown-item">
                  Orders
              </a>
              <a href="{{ route('settings.index') }}" class="dropdown-item">
                  Settings
              </a>
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="dropdown-item logout-item">
                      Logout
                  </button>
              </form>
          </div>
      </div>

      <!-- CART ICON -->
      @php $cartCount = collect(session('cart', []))->sum('qty'); @endphp
      <a href="{{ route('cart.index') }}" class="nav-cart">
          <i class="fa-solid fa-cart-shopping"></i>
          @if($cartCount)
              <span class="cart-badge">{{ $cartCount }}</span>
          @endif
      </a>

      @else
          <a class="btn-login" href="{{ route('login') }}">LOG IN</a>
          <a class="btn-login" href="{{ route('register') }}">REGISTER</a>
      @endauth

  </div>

  </div>
</nav>
=======
=======
>>>>>>> 5c55d34 (new features)
=======
>>>>>>> 9e16f42 (Újabb push)
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
<<<<<<< HEAD
<<<<<<< HEAD
</nav>
>>>>>>> fc7673c (frontend update and some new feature)
=======
</nav>
>>>>>>> 5c55d34 (new features)
=======
</nav>
>>>>>>> 9e16f42 (Újabb push)
