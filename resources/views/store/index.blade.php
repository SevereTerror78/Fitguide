@extends('layouts.main')
@section('title', 'Store • FitGuide')

@push('head')
  <link rel="stylesheet" href="{{ asset('css/shop.css') }}" />
@endpush

@push('scripts')
  <script src="{{ asset('js/shop.js') }}" defer></script>
@endpush

@section('content')

  {{-- HERO --}}
  <header class="container hero hero--tight" style="padding: 28px 0 22px;">
    <div style="max-width: 640px;">
      <h1 class="hero-title" style="margin-bottom:6px;">Store</h1>
      <p class="hero-sub">Shop supplements & fitness equipment.</p>
    </div>
  </header>

  {{-- SEARCH BAR --}}
  <div class="store-toolbar">
    <div class="store-search">
      <i class="fa-solid fa-magnifying-glass search-icon"></i>

      <input
        type="text"
        id="storeSearch"
        placeholder="Search products (e.g. whey, belt, hoodie)…"
        value="{{ request('search', '') }}"
        autocomplete="off"
      />

      <button type="button" class="search-clear" id="searchClear" aria-label="Clear search">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>
  </div>

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
