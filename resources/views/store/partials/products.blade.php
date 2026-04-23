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
        @endif
      </div>

      <div class="product-foot">
        <div class="product-price">
          {{ $product->price_formatted }}
        </div>

        @auth
          @php
            $stock = (int) ($product->stock ?? 0);
            $canBuy = ($product->is_active ?? false) && $stock > 0;
          @endphp

          <form method="POST" action="{{ route('cart.add', $product) }}" class="add-to-cart-form product-buy-form">
            @csrf

            <div class="qty-picker {{ $canBuy ? '' : 'is-disabled' }}" data-qty-picker>
              <button
                type="button"
                class="qty-btn qty-minus"
                aria-label="{{ __('store.qty_decrease') }}"
                {{ $canBuy ? '' : 'disabled' }}
              >
                <i class="fa-solid fa-minus"></i>
              </button>

              <input
                type="number"
                name="qty"
                class="qty-input"
                value="1"
                min="1"
                max="{{ max($stock, 1) }}"
                inputmode="numeric"
                aria-label="{{ __('store.quantity') }}"
                {{ $canBuy ? '' : 'disabled' }}
              >

              <button
                type="button"
                class="qty-btn qty-plus"
                aria-label="{{ __('store.qty_increase') }}"
                {{ $canBuy ? '' : 'disabled' }}
              >
                <i class="fa-solid fa-plus"></i>
              </button>
            </div>

            <button
              type="submit"
              class="btn pill add-btn {{ $canBuy ? '' : 'is-disabled' }}"
              {{ $canBuy ? '' : 'disabled' }}
            >
              <span class="label">
                {{ $canBuy ? __('store.add_to_cart') : __('store.out_of_stock') }}
              </span>
              @if($canBuy)
                <span class="check-icon" aria-hidden="true"><i class="fa-solid fa-check"></i></span>
              @endif
            </button>
          </form>
        @else
          <a class="btn pill" href="{{ route('login') }}?redirect={{ urlencode(request()->fullUrl()) }}">
            {{ __('store.login_to_buy') }}
          </a>
        @endauth
      </div>
    </article>
  @empty
    <p style="color:#cfe3ff">{{ __('store.no_products') }}</p>
  @endforelse
</div>

@if ($products->total() > 0)
  <div class="pagi-stack">
    <div class="page-links">
      {{ $products->onEachSide(1)->links('vendor.pagination.fitguide') }}
    </div>

    <div class="pagination-info">
      {{ __('store.showing') }}
      {{ $products->firstItem() }}
      {{ __('store.to') }}
      {{ $products->lastItem() }}
      {{ __('store.of') }}
      {{ $products->total() }}
      {{ __('store.results') }}
    </div>
  </div>
@endif