<!DOCTYPE html>
<html lang="en">
<head>
<<<<<<< HEAD
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'FitGuide')</title>

  {{-- ugyanazok, mint a Store/Cart oldalakon --}}
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/shop.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/checkout.css') }}" />

  <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script>window.FG = { cartCountUrl: "{{ route('cart.count') }}" };</script>
  <script src="{{ asset('js/shop.js') }}" defer></script>
</head>
<body>
  <!-- NAV -->
<nav class="navbar">
  <div class="container navbar-inner">

    <!-- BAL OLDAL: oldalak -->
    <div class="nav-left">
      <button class="nav-toggle" id="navToggle">
        <i class="fa-solid fa-bars"></i>
      </button>

      <div class="nav-links" id="navMenu">
        <a href="/">HOME</a>
        <a href="/exercises">EXERCISES</a>
        <a href="/store">STORE</a>
        <a href="/advice">ADVICE</a>
        @if(auth()->check() && auth()->user()->role === 'admin')
          <a href="{{ route('admin.dashboard') }}">ADMIN PANEL</a>
        @endif
      </div>
    </div>

      <!-- JOBB OLDAL: Cart + Profile egy sorban -->
  <div class="user-area">

      @auth
      <div class="relative group user-dropdown">

          <!-- BUTTON – csak a név, nincs ikon/keret -->
          <button class="user-btn">
              {{ auth()->user()->name }}
              <i class="fa-solid fa-chevron-down"></i>
          </button>

          <!-- DROPDOWN -->
          <div class="dropdown-menu">
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

  {{-- OLDALTARTALOM --}}
=======
  @php($t = auth()->check() ? (auth()->user()->theme ?? 'dark') : 'dark')

  <link id="theme-css" rel="stylesheet" href="{{ asset('css/themes/'.$t.'.css') }}?v={{ time() }}">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'FitGuide')</title>

  {{-- Global --}}
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  {{-- Page css (ha kell) --}}
  <link rel="stylesheet" href="{{ asset('css/shop.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/checkout.css') }}" />
  <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}" />

  <script>
    window.FG = { cartCountUrl: "{{ route('cart.count') }}" };
  </script>

  <script src="{{ asset('js/shop.js') }}" defer></script>
  <script src="{{ asset('js/navbar.js') }}" defer></script>
  
  @stack('head')
</head>

<body data-theme="{{ $t }}">

  {{-- NAV --}}
  <nav class="navbar">
    <div class="container navbar-inner">

      {{-- LEFT --}}
      <div class="nav-left">
        <button class="nav-toggle" id="navToggle" type="button" aria-label="Menu">
          <i class="fa-solid fa-bars"></i>
        </button>

        <div class="nav-links" id="navMenu">
          <a href="/">HOME</a>
          <a href="/exercises">EXERCISES</a>
          <a href="/store">STORE</a>
          <a href="/advice">ADVICE</a>

          @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}">ADMIN PANEL</a>
          @endif
        </div>
      </div>

      {{-- RIGHT --}}
      <div class="user-area">

        @auth
          <div class="relative group user-dropdown">
            <button class="user-btn" type="button">
              {{ auth()->user()->name }}
              <i class="fa-solid fa-chevron-down"></i>
            </button>

            <div class="dropdown-menu">
              <a href="{{ route('profile.index') }}" class="dropdown-item">Profile</a>
              <a href="{{ route('orders.index') }}" class="dropdown-item">Orders</a>
              <a href="{{ route('settings.index') }}" class="dropdown-item">Settings</a>

              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item logout-item">Logout</button>
              </form>
            </div>
          </div>

          @php($cartCount = collect(session('cart', []))->sum('qty'))
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

  {{-- CONTENT --}}
>>>>>>> fc7673c (frontend update and some new feature)
  @yield('content')

  {{-- FOOTER --}}
  <footer class="footer">
    <div class="container footer-grid">
      <div class="footer-brand">
        <div class="logo">FitGuide</div>
        <p class="tagline">Your personal guide to a healthier lifestyle.</p>
      </div>
<<<<<<< HEAD
=======

>>>>>>> fc7673c (frontend update and some new feature)
      <nav class="footer-links">
        <h4>Explore</h4>
        <a href="/exercises">Exercises</a>
        <a href="/store">Store</a>
        <a href="/advice">Advice</a>
      </nav>
<<<<<<< HEAD
=======

>>>>>>> fc7673c (frontend update and some new feature)
      <nav class="footer-links">
        <h4>Company</h4>
        <a href="#">About Us</a>
        <a href="#">Contact</a>
        <a href="#">Careers</a>
      </nav>
    </div>
<<<<<<< HEAD
=======

>>>>>>> fc7673c (frontend update and some new feature)
    <div class="container footer-bottom">
      <span>© {{ date('Y') }} FitGuide</span>
      <div class="legal">
        <a href="#">Privacy</a><span>•</span>
        <a href="#">Terms</a><span>•</span>
        <a href="#">Cookies</a>
      </div>
    </div>
  </footer>
<<<<<<< HEAD
=======

  @stack('scripts')
>>>>>>> fc7673c (frontend update and some new feature)
</body>
</html>
