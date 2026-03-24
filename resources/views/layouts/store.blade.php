<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'FitGuide')</title>

  {{-- FitGuide CSS --}}
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/shop.css') }}" />
  <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}" />

  <script>
    window.FG = { cartCountUrl: "{{ route('cart.count') }}" };
  </script>

  <script src="{{ asset('js/script.js') }}" defer></script>
  <script src="{{ asset('js/shop.js') }}" defer></script>

  @stack('head')
</head>

<body>
  @include('partials.navbar')

  <main>
    @yield('content')
  </main>

  @include('partials.footer')
</body>
</html>
