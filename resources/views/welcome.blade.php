<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @php($t = auth()->user()->theme ?? 'dark')
  <link id="theme-css" rel="stylesheet" href="{{ asset('css/themes/'.$t.'.css') }}?v={{ time() }}">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FitGuide</title>

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <script src="{{ asset('js/navbar.js') }}" defer></script>
    <script src="{{ asset('js/shop.js') }}" defer></script>

</head>

<body data-theme="{{ $t }}">
  {{-- NAVBAR --}}
  @include('partials.navbar')

  {{-- HERO --}}
  <header class="container hero hero--tight">
    <div>
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