<!DOCTYPE html>
<html lang="en">
<head>
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
@include('partials.navbar')
  {{-- CONTENT --}}
  @yield('content')

@include('partials.footer')

  @stack('scripts')
</body>
</html>
