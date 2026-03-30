@extends('layouts.main')
<<<<<<< HEAD
<<<<<<< HEAD
@section('title', 'Store • FitGuide')
=======
@section('title', __('store.page_title') . ' • FitGuide')
>>>>>>> fc7673c (frontend update and some new feature)
=======
@section('title', __('store.page_title') . ' • FitGuide')
>>>>>>> 5c55d34 (new features)

@push('head')
  <link rel="stylesheet" href="{{ asset('css/shop.css') }}" />
@endpush
<<<<<<< HEAD
<<<<<<< HEAD

@push('scripts')
  <script src="{{ asset('js/shop.js') }}" defer></script>
@endpush
=======
  <script src="{{ asset('js/shop.js') }}" defer></script>
  <script src="{{ asset('js/navbar.js') }}" defer></script>
>>>>>>> fc7673c (frontend update and some new feature)
=======
  <script src="{{ asset('js/shop.js') }}" defer></script>
  <script src="{{ asset('js/navbar.js') }}" defer></script>
>>>>>>> 5c55d34 (new features)

@section('content')

  {{-- HERO --}}
  <header class="container hero hero--tight" style="padding: 28px 0 22px;">
    <div style="max-width: 640px;">
<<<<<<< HEAD
<<<<<<< HEAD
      <h1 class="hero-title" style="margin-bottom:6px;">Store</h1>
      <p class="hero-sub">Shop supplements & fitness equipment.</p>
=======
      <h1 class="hero-title" style="margin-bottom:6px;">{{ __('store.hero_title') }}</h1>
      <p class="hero-sub">{{ __('store.hero_sub') }}</p>
>>>>>>> fc7673c (frontend update and some new feature)
=======
      <h1 class="hero-title" style="margin-bottom:6px;">{{ __('store.hero_title') }}</h1>
      <p class="hero-sub">{{ __('store.hero_sub') }}</p>
>>>>>>> 5c55d34 (new features)
    </div>
  </header>

  {{-- SEARCH BAR --}}
  <div class="store-toolbar">
    <div class="store-search">
      <i class="fa-solid fa-magnifying-glass search-icon"></i>

      <input
        type="text"
        id="storeSearch"
<<<<<<< HEAD
<<<<<<< HEAD
        placeholder="Search products (e.g. whey, belt, hoodie)…"
=======
        placeholder="{{ __('store.search_placeholder') }}"
>>>>>>> fc7673c (frontend update and some new feature)
=======
        placeholder="{{ __('store.search_placeholder') }}"
>>>>>>> 5c55d34 (new features)
        value="{{ request('search', '') }}"
        autocomplete="off"
      />

<<<<<<< HEAD
<<<<<<< HEAD
      <button type="button" class="search-clear" id="searchClear" aria-label="Clear search">
=======
      <button type="button" class="search-clear" id="searchClear" aria-label="{{ __('store.clear_search') }}">
>>>>>>> fc7673c (frontend update and some new feature)
=======
      <button type="button" class="search-clear" id="searchClear" aria-label="{{ __('store.clear_search') }}">
>>>>>>> 5c55d34 (new features)
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>
  </div>

<<<<<<< HEAD
<<<<<<< HEAD
  {{-- FILTER + TERMÉKLISTA --}}
  <section class="section-cards" style="padding-top: 26px;">
    <div class="container">

      @php $active = request('type', 'all'); @endphp

      <div class="filter-row">
        <a class="filter-btn {{ $active==='all' ? 'active' : '' }}" href="{{ route('store.index', ['type'=>'all']) }}">All</a>
        <a class="filter-btn {{ $active==='supplements' ? 'active' : '' }}" href="{{ route('store.index', ['type'=>'supplements']) }}">Supplements</a>
        <a class="filter-btn {{ $active==='snacks' ? 'active' : '' }}" href="{{ route('store.index', ['type'=>'snacks']) }}">Snacks</a>
        <a class="filter-btn {{ $active==='equipment' ? 'active' : '' }}" href="{{ route('store.index', ['type'=>'equipment']) }}">Equipment</a>
        <a class="filter-btn {{ $active==='clothing' ? 'active' : '' }}" href="{{ route('store.index', ['type'=>'clothing']) }}">Clothing</a>
        <a class="filter-btn {{ $active==='accessories' ? 'active' : '' }}" href="{{ route('store.index', ['type'=>'accessories']) }}">Accessories</a>
        <a class="filter-btn {{ $active==='packages-gift' ? 'active' : '' }}" href="{{ route('store.index', ['type'=>'packages-gift']) }}">Packages & gift</a>
      </div>

      <div class="filter-dropdown">
        <label for="product-filter">Filter by:</label>
        <select id="product-filter" name="product-filter">
          @foreach ([
            'all' => 'All',
            'supplements' => 'Supplements',
            'snacks' => 'Snacks',
            'equipment' => 'Equipment',
            'clothing' => 'Clothing',
            'accessories' => 'Accessories',
            'packages-gift' => 'Packages & gift'
=======
=======
>>>>>>> 5c55d34 (new features)
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
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
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
<<<<<<< HEAD
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> fc7673c (frontend update and some new feature)
=======
@endsection
>>>>>>> 5c55d34 (new features)
