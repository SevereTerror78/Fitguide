<nav class="navbar">
  <div class="container navbar-inner">

    <!-- BAL OLDAL: oldalak -->
    <div class="nav-left">
<<<<<<< HEAD
      <button class="nav-toggle" id="navToggle">
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
        <a href="/advice">ADVICE</a>
        @if(auth()->check() && auth()->user()->role === 'admin')
          <a href="{{ route('admin.dashboard') }}">ADMIN PANEL</a>
=======
        <a href="/" class="{{ request()->routeIs('home') ? 'active' : '' }}">{{ __('nav.home') }}</a>
        <a href="/exercises" class="{{ request()->routeIs('exercises.*') ? 'active' : '' }}">{{ __('nav.exercises') }}</a>
        <a href="/store" class="{{ request()->routeIs('store.*') ? 'active' : '' }}">{{ __('nav.store') }}</a>
        <a href="/advice" class="{{ request()->routeIs('advice.*') ? 'active' : '' }}">{{ __('nav.advice') }}</a>

        @if(auth()->check() && auth()->user()->role === 'admin')
          <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.*') ? 'active' : '' }}">
            {{ __('nav.admin_panel') }}
          </a>
>>>>>>> fc7673c (frontend update and some new feature)
        @endif
      </div>
    </div>

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
    <!-- JOBB OLDAL: Cart + Profile egy sorban -->
    <div class="user-area">

      @auth
        <div class="relative group user-dropdown">

          <!-- BUTTON – csak a név, nincs ikon/keret -->
          <button class="user-btn" type="button" aria-label="{{ __('nav.user_menu') }}">
            {{ auth()->user()->name }}
            <i class="fa-solid fa-chevron-down"></i>
>>>>>>> fc7673c (frontend update and some new feature)
          </button>

          <!-- DROPDOWN -->
          <div class="dropdown-menu">
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
>>>>>>> fc7673c (frontend update and some new feature)
