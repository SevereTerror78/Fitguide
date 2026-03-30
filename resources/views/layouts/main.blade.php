<!DOCTYPE html>
<html lang="en">
<head>
<<<<<<< HEAD
<<<<<<< HEAD
=======
  @php($t = auth()->check() ? (auth()->user()->theme ?? 'dark') : 'dark')

>>>>>>> fc7673c (frontend update and some new feature)
=======
  @php($t = auth()->check() ? (auth()->user()->theme ?? 'dark') : 'dark')

>>>>>>> 5c55d34 (new features)
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'FitGuide')</title>

<<<<<<< HEAD
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
=======
>>>>>>> 5c55d34 (new features)
  {{-- THEME CSS (minden oldalon) --}}
  <link id="theme-css" rel="stylesheet" href="{{ asset('css/themes/'.$t.'.css') }}?v={{ time() }}">

  {{-- BASE CSS --}}
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

  {{-- Régi módszer: @section('head') --}}
  @yield('head')

  {{-- Új módszer: @push('head') --}}
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
  @stack('head')

  <script>
    window.FG = { cartCountUrl: "{{ route('cart.count') }}" };
    window.STORE_URL = "{{ url('/store') }}";
  </script>

<<<<<<< HEAD
  <script src="{{ asset('js/script.js') }}" defer></script>
<<<<<<< HEAD
  @stack('scripts')
</head>

<body data-theme="{{ $t }}">
  @include('partials.navbar')

  <main style="min-height: 70vh; padding-top: 20px;">
=======
=======
>>>>>>> 5c55d34 (new features)
  <script src="{{ asset('js/shop.js') }}" defer></script>
  <script src="{{ asset('js/navbar.js') }}" defer></script>
  

  @stack('scripts')
</head>

<body data-theme="{{ $t }}" data-currency="{{ auth()->user()?->currency ?? session('currency', 'HUF') }}">
  @include('partials.navbar')

  <main style="min-height:70vh; padding-top:20px;">
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
    @yield('content')
  </main>

  @include('partials.footer')
</body>
</html>
