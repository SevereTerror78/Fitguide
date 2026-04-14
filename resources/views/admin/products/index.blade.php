@extends('admin.layout')

@section('content')
<div class="p-8">

    <h1 class="text-4xl font-bold mb-6">{{ __('admin.products.title') }}</h1>

    {{-- SEARCH + FILTERS + ADD --}}
    <div class="flex flex-wrap gap-4 mb-6">

        {{-- Search --}}
        <form id="searchForm" method="GET" class="flex gap-4 flex-1">
            <input type="text"
                name="search"
                value="{{ $search }}"
                placeholder="{{ __('admin.products.search_placeholder') }}"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white shadow-sm focus:ring-2 focus:ring-blue-500">

            {{-- Category Filter --}}
            <select name="category"
                onchange="document.getElementById('searchForm').submit()"
                class="px-4 py-2 rounded-lg border border-gray-300 bg-white shadow-sm focus:ring-2 focus:ring-blue-500">

                <option value="all">{{ __('admin.products.filters.all_categories') }}</option>
                @foreach($productTypes as $type)
                    <option value="{{ $type->id }}" {{ $category == $type->id ? 'selected' : '' }}>
                        {{ $type->translated_name }}
                    </option>
                @endforeach
            </select>

            {{-- Status Filter --}}
            <select name="status"
                onchange="document.getElementById('searchForm').submit()"
                class="px-4 py-2 rounded-lg border border-gray-300 bg-white shadow-sm focus:ring-2 focus:ring-blue-500">
                <option value="all" {{ $status=='all' ? 'selected' : '' }}>{{ __('admin.products.filters.all') }}</option>
                <option value="active" {{ $status=='active' ? 'selected' : '' }}>{{ __('admin.products.filters.active') }}</option>
                <option value="inactive" {{ $status=='inactive' ? 'selected' : '' }}>{{ __('admin.products.filters.inactive') }}</option>
            </select>
        </form>

        <a href="{{ route('admin.products.create') }}"
            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            + {{ __('admin.products.add_product') }}
        </a>

    </div>

    {{-- DESKTOP TABLE --}}
    <div class="products-table-desktop bg-white shadow rounded-xl overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="py-3 px-4">{{ __('admin.products.table.image') }}</th>
                    <th class="py-3 px-4">{{ __('admin.products.table.name') }}</th>
                    <th class="py-3 px-4">{{ __('admin.products.table.price') }}</th>
                    <th class="py-3 px-4">{{ __('admin.products.table.stock') }}</th>
                    <th class="py-3 px-4">{{ __('admin.products.table.category') }}</th>
                    <th class="py-3 px-4">{{ __('admin.products.table.status') }}</th>
                    <th class="py-3 px-4">{{ __('admin.products.table.actions') }}</th>
                </tr>
            </thead>

            <tbody>
            @forelse($products as $p)
                <tr class="border-b hover:bg-gray-50 transition align-middle">

                    {{-- IMAGE --}}
                    <td class="py-3 px-4 align-middle">
                        @if($p->image)
                            <img src="{{ asset('images/' . $p->image) }}"
                                 class="w-10 h-10 rounded object-cover"
                                 alt="{{ __('admin.products.alt.product_image') }}">
                        @else
                            <i class="fa-regular fa-image text-gray-400 text-xl" aria-hidden="true"></i>
                        @endif
                    </td>

                    {{-- NAME --}}
                    <td class="py-3 px-4 align-middle font-medium">{{ $p->translated_name }}</td>

                    {{-- PRICE --}}
                    <td class="py-3 px-4 align-middle">{{ $p->price_formatted }}</td>

                    {{-- STOCK --}}
                    <td class="py-3 px-4 align-middle">{{ $p->stock }}</td>

                    {{-- CATEGORY --}}
                    <td class="py-3 px-4 align-middle">{{ $p->productType->translated_name ?? '-' }}</td>

                    {{-- STATUS --}}
                    <td class="py-3 px-4 align-middle">
                        @if($p->is_active)
                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs">
                                {{ __('admin.products.filters.active') }}
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs">
                                {{ __('admin.products.filters.inactive') }}
                            </span>
                        @endif
                    </td>

                    {{-- ACTIONS --}}
                    <td class="py-3 px-4">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.products.edit', $p->id) }}"
                               class="text-blue-600 hover:text-blue-800"
                               title="{{ __('admin.products.actions.edit_title') }}">
                                <i class="fa-solid fa-pen-to-square text-lg relative top-[2px]"></i>
                            </a>

                            <form action="{{ route('admin.products.destroy', $p->id) }}"
                                  method="POST"
                                  class="js-confirm-delete"
                                  data-confirm="{{ __('admin.products.confirm_delete') }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:text-red-800"
                                        title="{{ __('admin.products.actions.delete_title') }}">
                                    <i class="fa-solid fa-trash text-lg relative top-[2px]"></i>
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="7" class="py-6 text-center text-gray-500">
                        {{ __('admin.products.no_products_found') }}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- MOBILE CARDS --}}
    <div class="products-mobile-list">
        @forelse($products as $p)
            <div class="product-mobile-card">
                <div class="product-mobile-top">
                    <div class="product-mobile-image">
                        @if($p->image)
                            <img src="{{ asset('images/' . $p->image) }}"
                                 alt="{{ __('admin.products.alt.product_image') }}">
                        @else
                            <div class="product-mobile-placeholder">
                                <i class="fa-regular fa-image"></i>
                            </div>
                        @endif
                    </div>

                    <div class="product-mobile-main">
                        <div class="product-mobile-name">{{ $p->translated_name }}</div>
                        <div class="product-mobile-price">{{ $p->price_formatted }}</div>
                    </div>
                </div>

                <div class="product-mobile-meta">
                    <div class="product-mobile-row">
                        <span class="label">{{ __('admin.products.table.stock') }}</span>
                        <span class="value">{{ $p->stock }}</span>
                    </div>

                    <div class="product-mobile-row">
                        <span class="label">{{ __('admin.products.table.category') }}</span>
                        <span class="value">{{ $p->productType->translated_name ?? '-' }}</span>
                    </div>

                    <div class="product-mobile-row">
                        <span class="label">{{ __('admin.products.table.status') }}</span>
                        <span class="value">
                            @if($p->is_active)
                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs">
                                    {{ __('admin.products.filters.active') }}
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs">
                                    {{ __('admin.products.filters.inactive') }}
                                </span>
                            @endif
                        </span>
                    </div>
                </div>

                <div class="product-mobile-actions">
                    <a href="{{ route('admin.products.edit', $p->id) }}"
                       class="mobile-action-edit">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>{{ __('admin.products.actions.edit_title') }}</span>
                    </a>

                    <form action="{{ route('admin.products.destroy', $p->id) }}"
                          method="POST"
                          class="js-confirm-delete"
                          data-confirm="{{ __('admin.products.confirm_delete') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="mobile-action-delete">
                            <i class="fa-solid fa-trash"></i>
                            <span>{{ __('admin.products.actions.delete_title') }}</span>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow p-6 text-center text-gray-500">
                {{ __('admin.products.no_products_found') }}
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="mt-6 flex justify-center">
        {{ $products->onEachSide(1)->links('vendor.pagination.admin') }}
    </div>

    <div class="mt-2 text-center text-sm text-gray-600">
        {{ __('admin.pagination.showing', [
            'from' => $products->firstItem(),
            'to' => $products->lastItem(),
            'total' => $products->total()
        ]) }}
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('form.js-confirm-delete').forEach((form) => {
        form.addEventListener('submit', (e) => {
            const msg = form.getAttribute('data-confirm') || 'Are you sure?';
            if (!confirm(msg)) e.preventDefault();
        });
    });
});
</script>
@endpush