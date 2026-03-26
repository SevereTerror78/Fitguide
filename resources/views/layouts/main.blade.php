<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'FitGuide')</title>

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

  @stack('head')

  <script>
    window.FG = { cartCountUrl: "{{ route('cart.count') }}" };
    window.STORE_URL = "{{ url('/store') }}";
  </script>

  <script src="{{ asset('js/script.js') }}" defer></script>
  @stack('scripts')
</head>

<body data-theme="{{ $t }}">
  @include('partials.navbar')

  <main style="min-height: 70vh; padding-top: 20px;">
    @yield('content')
  </main>

  @include('partials.footer')
</body>
</html>
