<div class="store-grid">
  @forelse ($products as $product)
    <article class="product-card" data-category="{{ $product->productType->slug ?? 'unknown' }}">
      <div class="product-thumb">
        @php
          $img = $product->image
            ? (\Illuminate\Support\Str::startsWith($product->image, ['http://','https://'])
                ? $product->image
                : asset('images/' . ltrim($product->image, '/')))
            : asset('images/placeholder-product.png');
        @endphp
<<<<<<< HEAD
<<<<<<< HEAD
        <img src="{{ $img }}" alt="{{ $product->name }}" />
      </div>

      <div class="product-body">
        <h3 class="product-name">{{ $product->name }}</h3>
        @if($product->description)
          <p class="product-desc">{{ \Illuminate\Support\Str::limit($product->description, 90) }}</p>
=======
=======
>>>>>>> 5c55d34 (new features)
        <img src="{{ $img }}" alt="{{ $product->translated_name }}" />
      </div>

      <div class="product-body">
        <h3 class="product-name">
          {{ $product->translated_name }}
        </h3>

        @if($product->translated_description)
          <p class="product-desc">
            {{ \Illuminate\Support\Str::limit($product->translated_description, 90) }}
          </p>
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
        @endif
      </div>

      <div class="product-foot">
<<<<<<< HEAD
<<<<<<< HEAD
        <div class="product-price">{{ number_format($product->price, 2, ',', ' ') }} €</div>
=======
        <div class="product-price">
          {{ $product->price_formatted }}
        </div>
>>>>>>> fc7673c (frontend update and some new feature)

        @auth
          @php
            $canBuy = ($product->is_active ?? false) && ((int)($product->stock ?? 0) > 0);
          @endphp

          @if($canBuy)
            <form method="POST" action="{{ route('cart.add', $product) }}" class="add-to-cart-form">
              @csrf
              <button type="submit" class="btn pill add-btn">
<<<<<<< HEAD
                <span class="label">Add to cart</span>
=======
                <span class="label">{{ __('store.add_to_cart') }}</span>
>>>>>>> fc7673c (frontend update and some new feature)
=======
        <div class="product-price">
          {{ $product->price_formatted }}
        </div>

        @auth
          @php
            $stock = (int) ($product->stock ?? 0);
            $canBuy = ($product->is_active ?? false) && $stock > 0;
          @endphp

          @if($canBuy)
            <form method="POST" action="{{ route('cart.add', $product) }}" class="add-to-cart-form product-buy-form">
              @csrf

              <div class="qty-picker" data-qty-picker>
                <button type="button" class="qty-btn qty-minus" aria-label="{{ __('store.qty_decrease') }}">
                  <i class="fa-solid fa-minus"></i>
                </button>

                <input
                  type="number"
                  name="qty"
                  class="qty-input"
                  value="1"
                  min="1"
                  max="{{ $stock }}"
                  inputmode="numeric"
                  aria-label="{{ __('store.quantity') }}"
                >

                <button type="button" class="qty-btn qty-plus" aria-label="{{ __('store.qty_increase') }}">
                  <i class="fa-solid fa-plus"></i>
                </button>
              </div>

              <button type="submit" class="btn pill add-btn">
                <span class="label">{{ __('store.add_to_cart') }}</span>
>>>>>>> 5c55d34 (new features)
                <span class="check-icon" aria-hidden="true"><i class="fa-solid fa-check"></i></span>
              </button>
            </form>
          @else
            <button type="button" class="btn pill add-btn is-disabled" disabled>
<<<<<<< HEAD
<<<<<<< HEAD
              <span class="label">Out of stock</span>
=======
              <span class="label">{{ __('store.out_of_stock') }}</span>
>>>>>>> fc7673c (frontend update and some new feature)
=======
              <span class="label">{{ __('store.out_of_stock') }}</span>
>>>>>>> 5c55d34 (new features)
            </button>
          @endif
        @else
          <a class="btn pill" href="{{ route('login') }}?redirect={{ urlencode(request()->fullUrl()) }}">
<<<<<<< HEAD
<<<<<<< HEAD
            Log in to buy
=======
            {{ __('store.login_to_buy') }}
>>>>>>> fc7673c (frontend update and some new feature)
=======
            {{ __('store.login_to_buy') }}
>>>>>>> 5c55d34 (new features)
          </a>
        @endauth
      </div>
    </article>
  @empty
<<<<<<< HEAD
<<<<<<< HEAD
    <p style="color:#cfe3ff">No products yet.</p>
=======
    <p style="color:#cfe3ff">{{ __('store.no_products') }}</p>
>>>>>>> fc7673c (frontend update and some new feature)
=======
    <p style="color:#cfe3ff">{{ __('store.no_products') }}</p>
>>>>>>> 5c55d34 (new features)
  @endforelse
</div>

@if ($products->total() > 0)
  <div class="pagi-stack">
    <div class="page-links">
      {{ $products->onEachSide(1)->links('vendor.pagination.fitguide') }}
    </div>

    <div class="pagination-info">
<<<<<<< HEAD
<<<<<<< HEAD
      Showing {{ $products->firstItem() }}
      to {{ $products->lastItem() }}
      of {{ $products->total() }} results
    </div>
  </div>
@endif
=======
=======
>>>>>>> 5c55d34 (new features)
      {{ __('store.showing') }}
      {{ $products->firstItem() }}
      {{ __('store.to') }}
      {{ $products->lastItem() }}
      {{ __('store.of') }}
      {{ $products->total() }}
      {{ __('store.results') }}
    </div>
  </div>
<<<<<<< HEAD
@endif
>>>>>>> fc7673c (frontend update and some new feature)
=======
@endif
>>>>>>> 5c55d34 (new features)
