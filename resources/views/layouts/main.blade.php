<!DOCTYPE html>
<html lang="en">
<head>
<<<<<<< HEAD
=======
  @php($t = auth()->check() ? (auth()->user()->theme ?? 'dark') : 'dark')

>>>>>>> fc7673c (frontend update and some new feature)
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'FitGuide')</title>

<<<<<<< HEAD
  @php($t = auth()->check() ? (auth()->user()->theme ?? 'dark') : 'dark')

  {{-- THEME CSS (light / colorblind). Dark = default style.css --}}
  @if($t === 'light')
    <link rel="stylesheet" href="{{ asset('css/themes/light.css') }}">
  @elseif($t === 'colorblind')
    <link rel="stylesheet" href="{{ asset('css/themes/colorblind.css') }}">
  @endif

  {{-- BASE CSS (dark alap) --}}
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}" />

=======
  {{-- THEME CSS (minden oldalon) --}}
  <link id="theme-css" rel="stylesheet" href="{{ asset('css/themes/'.$t.'.css') }}?v={{ time() }}">

  {{-- BASE CSS --}}
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

  {{-- Régi módszer: @section('head') --}}
  @yield('head')

  {{-- Új módszer: @push('head') --}}
>>>>>>> fc7673c (frontend update and some new feature)
  @stack('head')

  <script>
    window.FG = { cartCountUrl: "{{ route('cart.count') }}" };
    window.STORE_URL = "{{ url('/store') }}";
  </script>

  <script src="{{ asset('js/script.js') }}" defer></script>
<<<<<<< HEAD
  @stack('scripts')
</head>

<body data-theme="{{ $t }}">
  @include('partials.navbar')

  <main style="min-height: 70vh; padding-top: 20px;">
=======
  <script src="{{ asset('js/shop.js') }}" defer></script>
  <script src="{{ asset('js/navbar.js') }}" defer></script>
  

  @stack('scripts')
</head>

<body data-theme="{{ $t }}" data-currency="{{ auth()->user()?->currency ?? session('currency', 'HUF') }}">
  @include('partials.navbar')

  <main style="min-height:70vh; padding-top:20px;">
>>>>>>> fc7673c (frontend update and some new feature)
    @yield('content')
  </main>

  @include('partials.footer')
</body>
</html>
