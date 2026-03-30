<!DOCTYPE html>
<<<<<<< HEAD
<<<<<<< HEAD
<html lang="en">
=======
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
>>>>>>> fc7673c (frontend update and some new feature)
=======
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
>>>>>>> 5c55d34 (new features)
<head>
  @php($t = auth()->user()->theme ?? 'dark')
  <link id="theme-css" rel="stylesheet" href="{{ asset('css/themes/'.$t.'.css') }}?v={{ time() }}">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FitGuide</title>

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
<<<<<<< HEAD
<<<<<<< HEAD
  <script src="{{ asset('js/script.js') }}" defer></script>
  <script src="{{ asset('js/shop.js') }}" defer></script>
=======
    <script src="{{ asset('js/navbar.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <script src="{{ asset('js/shop.js') }}" defer></script>

>>>>>>> fc7673c (frontend update and some new feature)
=======
    <script src="{{ asset('js/navbar.js') }}" defer></script>
    <script src="{{ asset('js/shop.js') }}" defer></script>

>>>>>>> 5c55d34 (new features)
</head>

<body data-theme="{{ $t }}">
  {{-- NAVBAR --}}
  @include('partials.navbar')

  {{-- HERO --}}
  <header class="container hero hero--tight">
    <div>
<<<<<<< HEAD
<<<<<<< HEAD
      <h1 class="hero-title">Your guide<br>to fitness</h1>
      <p class="hero-sub">Explore exercises, shop for products, and get personalized advice.</p>
      <button id="cta-exercises" class="hero-cta">Browse Exercises</button>
=======
      <h1 class="hero-title">{!! __('welcome.hero_title') !!}</h1>
      <p class="hero-sub">{{ __('welcome.hero_sub') }}</p>
      <button id="cta-exercises" class="hero-cta">{{ __('welcome.browse_exercises') }}</button>
>>>>>>> fc7673c (frontend update and some new feature)
    </div>
  </header>

  {{-- FOOTER --}}
  <footer class="footer">
    <div class="container footer-grid">

      <div class="footer-brand">
        <div class="logo">FitGuide</div>
<<<<<<< HEAD
        <p class="tagline">Your personal guide to a healthier lifestyle.</p>
      </div>

      <nav class="footer-links">
        <h4>Explore</h4>
        <a href="/exercises">Exercises</a>
        <a href="/store">Store</a>
        <a href="/advice">Advice</a>
      </nav>

      <nav class="footer-links">
        <h4>Company</h4>
        <a href="#">About Us</a>
        <a href="#">Contact</a>
        <a href="#">Careers</a>
      </nav>

      <div class="footer-newsletter">
        <h4>Get updates</h4>
        <p>Stay updated with fitness tips & exclusive deals.</p>

        <form class="nl-form" method="post" action="#">
          <input type="email" name="email" placeholder="Enter your email" required>
          <button type="submit" class="nl-btn">Subscribe</button>
=======
        <p class="tagline">{{ __('welcome.footer_tagline') }}</p>
      </div>

      <nav class="footer-links">
        <h4>{{ __('welcome.explore') }}</h4>
        <a href="/exercises">{{ __('welcome.exercises') }}</a>
        <a href="/store">{{ __('welcome.store') }}</a>
        <a href="/advice">{{ __('welcome.advice') }}</a>
      </nav>

      <nav class="footer-links">
        <h4>{{ __('welcome.company') }}</h4>
        <a href="#">{{ __('welcome.about_us') }}</a>
        <a href="#">{{ __('welcome.contact') }}</a>
        <a href="#">{{ __('welcome.careers') }}</a>
      </nav>

      <div class="footer-newsletter">
        <h4>{{ __('welcome.get_updates') }}</h4>
        <p>{{ __('welcome.newsletter_text') }}</p>

        <form class="nl-form" method="post" action="#">
          <input type="email" name="email" placeholder="{{ __('welcome.email_placeholder') }}" required>
          <button type="submit" class="nl-btn">{{ __('welcome.subscribe') }}</button>
>>>>>>> fc7673c (frontend update and some new feature)
        </form>

        <div class="footer-socials">
          <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
          <a href="#" aria-label="Twitter"><i class="fab fa-x-twitter"></i></a>
          <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
        </div>

      </div>
    </div>

    <div class="container footer-bottom">
      <span>© {{ date('Y') }} FitGuide</span>
      <div class="legal">
<<<<<<< HEAD
        <a href="#">Privacy</a><span>•</span>
        <a href="#">Terms</a><span>•</span>
        <a href="#">Cookies</a>
=======
        <a href="#">{{ __('welcome.privacy') }}</a><span>•</span>
        <a href="#">{{ __('welcome.terms') }}</a><span>•</span>
        <a href="#">{{ __('welcome.cookies') }}</a>
>>>>>>> fc7673c (frontend update and some new feature)
      </div>
    </div>
  </footer>

</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> fc7673c (frontend update and some new feature)
=======
      <h1 class="hero-title">{!! __('welcome.hero_title') !!}</h1>
      <p class="hero-sub">{{ __('welcome.hero_sub') }}</p>
      <a href="/exercises"><button id="cta-exercises" class="hero-cta">{{ __('welcome.browse_exercises') }}</button></a>
    </div>
  </header>
  <br>
  <header class="container hero2 hero--tight">
    <div>
      <h1 class="hero2-title">{!! __('welcome.cgame_title') !!}</h1>
      <p class="hero2-sub">{{ __('welcome.cgame_sub') }}</p>
      <a href="{{ asset('games/game.exe') }}" download class="hero2-cta">{{__('welcome.cgame_downLoad')}}</a>
    </div>
  </header>
  @include('partials.footer')
</body>
</html>
>>>>>>> 5c55d34 (new features)
