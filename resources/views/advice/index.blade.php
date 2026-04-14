<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @php($t = auth()->user()?->theme ?? 'dark')

  <link id="theme-css" rel="stylesheet" href="{{ asset('css/themes/'.$t.'.css') }}?v={{ time() }}">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ __('advice.page_title') }} • FitGuide</title>

  <link rel="stylesheet" href="{{ asset('css/advice.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}" />
  <script src="{{ asset('js/shop.js') }}" defer></script>
  <script src="{{ asset('js/navbar.js') }}" defer></script>
</head>

<body data-theme="{{ $t }}">
  {{-- NAV --}}
  @include('partials.navbar')

  <header class="container hero hero--tight" style="padding: 28px 0 22px;">
    <div style="max-width: 640px;">
      <h1 class="hero-title" style="margin-bottom:6px;">{{ __('advice.hero_title') }}</h1>
      <p class="hero-sub">{{ __('advice.hero_sub') }}</p>
    </div>
  </header>

  <section class="container" style="padding: 40px 0;">
    <div class="bmi-card">
      <h2 class="section-title">{{ __('advice.bmi_title') }}</h2>

      <form method="POST" action="{{ route('advice.bmi') }}">
        @csrf

        <div class="form-group" style="margin-bottom: 16px;">
          <label for="weight">{{ __('advice.weight_label') }}</label>
          <input
            type="number"
            id="weight"
            name="weight"
            class="form-control"
            value="{{ session('old_weight') }}"
            step="0.1"
            required
          >
          @error('weight')<small class="error">{{ $message }}</small>@enderror
        </div>

        <div class="form-group" style="margin-bottom: 16px;">
          <label for="height">{{ __('advice.height_label') }}</label>
          <input
            type="number"
            id="height"
            name="height"
            class="form-control"
            value="{{ session('old_height') }}"
            step="0.1"
            required
          >
          @error('height')<small class="error">{{ $message }}</small>@enderror
        </div>

        <button type="submit" class="btn-login" style="width:100%;">
          {{ __('advice.calculate_btn') }}
        </button>
      </form>

      {{-- BMI RESULT --}}
      @if (session()->has('bmi'))
        @php($categoryKey = session('category_key')) {{-- underweight|normal|overweight|obese --}}
        @php($categorySlug = $categoryKey ?: \Illuminate\Support\Str::slug((string) session('category')))
        @php($img = $categorySlug ? asset('images/'.$categorySlug.'.png') : asset('images/bmi.png'))

        <div class="bmi-display">
          <div class="bmi-top">
            <div class="bmi-illustration">
              <img src="{{ $img }}" alt="{{ __('advice.bmi_illustration_alt') }}">
            </div>

            <div class="bmi-info">
              <div class="bmi-value">{{ session('bmi') }}</div>

              <div class="bmi-category {{ $categorySlug }}">
                {{ $categoryKey ? __('advice.categories.'.$categoryKey) : session('category') }}
              </div>

              <p class="bmi-advice">
                @if (session('advice_key'))
                  {{ __('advice.advices.'.session('advice_key')) }}
                @elseif (session('advice'))
                  {{ session('advice') }}
                @endif
              </p>
            </div>
          </div>

          <div class="bmi-scale">
            <div class="scale-bar">
              <div class="indicator" style="left: {{ session('bmi_position') }}%;"></div>
            </div>
            <div class="scale-labels">
              <span>{{ __('advice.scale.underweight') }}</span>
              <span>{{ __('advice.scale.normal') }}</span>
              <span>{{ __('advice.scale.overweight') }}</span>
              <span>{{ __('advice.scale.obese') }}</span>
            </div>
          </div>
        </div>
      @endif

    </div>
  </section>

  {{-- FOOTER --}}
  @include('partials.footer')
</body>
</html>