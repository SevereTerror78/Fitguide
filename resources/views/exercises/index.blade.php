<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php($t = auth()->user()?->theme ?? 'dark')

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ __('exercises.page_title') }} • FitGuide</title>

    <link id="theme-css" rel="stylesheet" href="{{ asset('css/themes/'.$t.'.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/exercises.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>

<body data-theme="{{ $t }}">

@include('partials.navbar')

<header class="container hero hero--tight" style="padding: 28px 0 22px;">
    <div style="max-width: 640px;">
        <h1 class="hero-title" style="margin-bottom:6px;">{{ __('exercises.hero_title') }}</h1>
        <p class="hero-sub">{{ __('exercises.hero_sub') }}</p>
    </div>
</header>

<section class="section-cards" style="padding-top: 26px;">
    <div class="container">

        {{-- CATEGORY FILTER --}}
        <div class="filter-row">
            <a class="filter-btn {{ $category === 'all' ? 'active' : '' }}"
               href="{{ route('exercises.index', ['category' => 'all']) }}">
                {{ __('exercises.all') }}
            </a>

            @foreach($categories as $key => $label)
                <a class="filter-btn {{ $category === $key ? 'active' : '' }}"
                   href="{{ route('exercises.index', ['category' => $key]) }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

      {{-- 🔥 IZOM LISTA (CSAK HA NINCS KONKRÉT IZOM KIVÁLASZTVA) --}}
        @if(!request('muscle'))

            <div class="muscle-list">
                @forelse($muscles as $muscleItem)
                    <div class="muscle-card">
                        <a href="{{ route('exercises.index', [
                            'category' => $category ?? 'all',
                            'muscle' => $muscleItem->slug
                        ]) }}">
                            {{ app()->getLocale() === 'hu' && !empty($muscleItem->name_hu)
                                ? $muscleItem->name_hu
                                : $muscleItem->name
                            }}
                        </a>
                    </div>
                @empty
                    <p>{{ __('exercises.no_muscles') }}</p>
                @endforelse
            </div>

        @else

           

        @endif

        {{-- 🔥 VIDEÓK --}}
        <div id="exercise-list">

            @if($exercises->count())

                <div class="card-grid">
                    @foreach($exercises as $exercise)
                        <div class="exercise-card">

                            <h3>
                                {{ app()->getLocale() === 'hu' && !empty($exercise->name_hu)
                                    ? $exercise->name_hu
                                    : $exercise->name
                                }}
                            </h3>

                            <div class="video-wrapper">
                                <video controls preload="metadata">
                                    <source src="{{ asset($exercise->video_url) }}" type="video/mp4">
                                </video>
                            </div>

                            <p>
                                {{ app()->getLocale() === 'hu' && !empty($exercise->description_hu)
                                    ? $exercise->description_hu
                                    : $exercise->description
                                }}
                            </p>

                        </div>
                    @endforeach
                </div>

            @else

                <div class="exercise-placeholder">
                    <h2>{{ __('exercises.select_muscle_placeholder') }}</h2>
                </div>

            @endif

        </div>

    </div>
</section>

@include('partials.footer')

</body>
</html>