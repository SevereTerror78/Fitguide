@extends('layouts.main')
@section('title', __('store.page_title') . ' • FitGuide')

@push('head')
  <link rel="stylesheet" href="{{ asset('css/shop.css') }}" />
@endpush
  <script src="{{ asset('js/shop.js') }}" defer></script>
  <script src="{{ asset('js/navbar.js') }}" defer></script>

@section('content')

  {{-- HERO --}}
  <header class="container hero hero--tight" style="padding: 28px 0 22px;">
    <div style="max-width: 640px;">
      <h1 class="hero-title" style="margin-bottom:6px;">{{ __('store.hero_title') }}</h1>
      <p class="hero-sub">{{ __('store.hero_sub') }}</p>
    </div>
  </header>

  {{-- SEARCH BAR --}}
  <div class="store-toolbar">
    <div class="store-search">
      <i class="fa-solid fa-magnifying-glass search-icon"></i>

      <input
        type="text"
        id="storeSearch"
        placeholder="{{ __('store.search_placeholder') }}"
        value="{{ request('search', '') }}"
        autocomplete="off"
      />

      <button type="button" class="search-clear" id="searchClear" aria-label="{{ __('store.clear_search') }}">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>
  </div>

  {{-- FILTER + PRODUCT LIST --}}
  <section class="section-cards" style="padding-top: 26px;">
    <div class="container">

      @php($active = request('type', 'all'))

      <div class="filter-row">
        <a class="filter-btn {{ $active==='all' ? 'active' : '' }}" href="{{ route('store.index', ['type'=>'all']) }}">{{ __('store.filters.all') }}</a>
        <a class="filter-btn {{ $active==='supplements' ? 'active' : '' }}" href="{{ route('store.index', ['type'=>'supplements']) }}">{{ __('store.filters.supplements') }}</a>
        <a class="filter-btn {{ $active==='snacks' ? 'active' : '' }}" href="{{ route('store.index', ['type'=>'snacks']) }}">{{ __('store.filters.snacks') }}</a>
        <a class="filter-btn {{ $active==='equipment' ? 'active' : '' }}" href="{{ route('store.index', ['type'=>'equipment']) }}">{{ __('store.filters.equipment') }}</a>
        <a class="filter-btn {{ $active==='clothing' ? 'active' : '' }}" href="{{ route('store.index', ['type'=>'clothing']) }}">{{ __('store.filters.clothing') }}</a>
        <a class="filter-btn {{ $active==='accessories' ? 'active' : '' }}" href="{{ route('store.index', ['type'=>'accessories']) }}">{{ __('store.filters.accessories') }}</a>
        <a class="filter-btn {{ $active==='packages-gift' ? 'active' : '' }}" href="{{ route('store.index', ['type'=>'packages-gift']) }}">{{ __('store.filters.packages_gift') }}</a>
      </div>

      <div class="filter-dropdown">
        <label for="product-filter">{{ __('store.filter_by') }}</label>
        <select id="product-filter" name="product-filter">
          @foreach ([
            'all' => __('store.filters.all'),
            'supplements' => __('store.filters.supplements'),
            'snacks' => __('store.filters.snacks'),
            'equipment' => __('store.filters.equipment'),
            'clothing' => __('store.filters.clothing'),
            'accessories' => __('store.filters.accessories'),
            'packages-gift' => __('store.filters.packages_gift'),
          ] as $slug => $label)
            <option value="{{ $slug }}" @selected($active===$slug)>{{ $label }}</option>
          @endforeach
        </select>
      </div>

      <div id="product-list">
        @include('store.partials.products', ['products' => $products])
      </div>

    </div>
  </section>
@endsection