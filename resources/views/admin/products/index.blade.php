@extends('admin.layout')

@section('content')
<div class="p-8">

<<<<<<< HEAD
    <h1 class="text-4xl font-bold mb-6">Products</h1>
=======
    <h1 class="text-4xl font-bold mb-6">{{ __('admin.products.title') }}</h1>
>>>>>>> fc7673c (frontend update and some new feature)

    {{-- SEARCH + FILTERS + ADD --}}
    <div class="flex flex-wrap gap-4 mb-6">

        {{-- Search --}}
        <form id="searchForm" method="GET" class="flex gap-4 flex-1">
            <input type="text"
                name="search"
                value="{{ $search }}"
<<<<<<< HEAD
                placeholder="Search products"
=======
                placeholder="{{ __('admin.products.search_placeholder') }}"
>>>>>>> fc7673c (frontend update and some new feature)
                class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white shadow-sm focus:ring-2 focus:ring-blue-500">

            {{-- Category Filter --}}
            <select name="category"
                onchange="document.getElementById('searchForm').submit()"
                class="px-4 py-2 rounded-lg border border-gray-300 bg-white shadow-sm focus:ring-2 focus:ring-blue-500">

<<<<<<< HEAD
                <option value="all">All Categories</option>
                @foreach($productTypes as $type)
                    <option value="{{ $type->id }}" {{ $category == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
=======
                <option value="all">{{ __('admin.products.filters.all_categories') }}</option>
                @foreach($productTypes as $type)
                    <option value="{{ $type->id }}" {{ $category == $type->id ? 'selected' : '' }}>
                       {{ $type->translated_name }}
>>>>>>> fc7673c (frontend update and some new feature)
                    </option>
                @endforeach
            </select>

            {{-- Status Filter --}}
            <select name="status"
                onchange="document.getElementById('searchForm').submit()"
                class="px-4 py-2 rounded-lg border border-gray-300 bg-white shadow-sm focus:ring-2 focus:ring-blue-500">
<<<<<<< HEAD
                <option value="all" {{ $status=='all' ? 'selected' : '' }}>All</option>
                <option value="active" {{ $status=='active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $status=='inactive' ? 'selected' : '' }}>Inactive</option>
=======
                <option value="all" {{ $status=='all' ? 'selected' : '' }}>{{ __('admin.products.filters.all') }}</option>
                <option value="active" {{ $status=='active' ? 'selected' : '' }}>{{ __('admin.products.filters.active') }}</option>
                <option value="inactive" {{ $status=='inactive' ? 'selected' : '' }}>{{ __('admin.products.filters.inactive') }}</option>
>>>>>>> fc7673c (frontend update and some new feature)
            </select>
        </form>

        <a href="{{ route('admin.products.create') }}"
            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
<<<<<<< HEAD
            + Add Product
        </a>


    </div>


=======
            + {{ __('admin.products.add_product') }}
        </a>

    </div>

>>>>>>> fc7673c (frontend update and some new feature)
    {{-- TABLE --}}
    <div class="bg-white shadow rounded-xl overflow-hidden">

        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
<<<<<<< HEAD
                    <th class="py-3 px-4">Image</th>
                    <th class="py-3 px-4">Name</th>
                    <th class="py-3 px-4">Price</th>
                    <th class="py-3 px-4">Stock</th>
                    <th class="py-3 px-4">Category</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Actions</th>
=======
                    <th class="py-3 px-4">{{ __('admin.products.table.image') }}</th>
                    <th class="py-3 px-4">{{ __('admin.products.table.name') }}</th>
                    <th class="py-3 px-4">{{ __('admin.products.table.price') }}</th>
                    <th class="py-3 px-4">{{ __('admin.products.table.stock') }}</th>
                    <th class="py-3 px-4">{{ __('admin.products.table.category') }}</th>
                    <th class="py-3 px-4">{{ __('admin.products.table.status') }}</th>
                    <th class="py-3 px-4">{{ __('admin.products.table.actions') }}</th>
>>>>>>> fc7673c (frontend update and some new feature)
                </tr>
            </thead>

            <tbody>
            @forelse($products as $p)
                <tr class="border-b hover:bg-gray-50 transition align-middle">

                    {{-- IMAGE --}}
                    <td class="py-3 px-4 align-middle">
                        @if($p->image)
                            <img src="{{ asset('images/' . $p->image) }}"
<<<<<<< HEAD
                                 class="w-10 h-10 rounded object-cover">
                        @else
                            <i class="fa-regular fa-image text-gray-400 text-xl"></i>
=======
                                 class="w-10 h-10 rounded object-cover"
                                 alt="{{ __('admin.products.alt.product_image') }}">
                        @else
                            <i class="fa-regular fa-image text-gray-400 text-xl" aria-hidden="true"></i>
>>>>>>> fc7673c (frontend update and some new feature)
                        @endif
                    </td>

                    {{-- NAME --}}
<<<<<<< HEAD
                    <td class="py-3 px-4 align-middle font-medium">{{ $p->name }}</td>

                    {{-- PRICE --}}
                    <td class="py-3 px-4 align-middle">€{{ number_format($p->price, 2) }}</td>

=======
                    <td class="py-3 px-4 align-middle font-medium">{{ $p->translated_name }}</td>

                    {{-- PRICE --}}
                    <td class="py-3 px-4 align-middle">{{ $p->price_formatted }}</td>
>>>>>>> fc7673c (frontend update and some new feature)
                    {{-- STOCK --}}
                    <td class="py-3 px-4 align-middle">{{ $p->stock }}</td>

                    {{-- CATEGORY --}}
<<<<<<< HEAD
                    <td class="py-3 px-4 align-middle">{{ $p->productType->name ?? '-' }}</td>
=======
                    <td class="py-3 px-4 align-middle">{{ $p->productType->translated_name ?? '-' }}</td>
>>>>>>> fc7673c (frontend update and some new feature)

                    {{-- STATUS --}}
                    <td class="py-3 px-4 align-middle">
                        @if($p->is_active)
<<<<<<< HEAD
                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs">Active</span>
                        @else
                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs">Inactive</span>
                        @endif
                    </td>

        {{-- ACTIONS --}}
        <td class="py-3 px-4">
            <div class="flex items-center gap-3">

                
                <a href="{{ route('admin.products.edit', $p->id) }}"
                class="text-blue-600 hover:text-blue-800"
                title="Edit">
                    <i class="fa-solid fa-pen-to-square text-lg relative top-[2px]"></i>
                </a>

                <form action="{{ route('admin.products.destroy', $p->id) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 hover:text-red-800"
                            title="Delete">
                        <i class="fa-solid fa-trash text-lg relative top-[2px]"></i>
                    </button>
                </form>

            </div>
        </td>
=======
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
                                <button class="text-red-600 hover:text-red-800"
                                        title="{{ __('admin.products.actions.delete_title') }}">
                                    <i class="fa-solid fa-trash text-lg relative top-[2px]"></i>
                                </button>
                            </form>

                        </div>
                    </td>

>>>>>>> fc7673c (frontend update and some new feature)
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="py-6 text-center text-gray-500">
<<<<<<< HEAD
                        No products found.
=======
                        {{ __('admin.products.no_products_found') }}
>>>>>>> fc7673c (frontend update and some new feature)
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>

<<<<<<< HEAD
{{-- PAGINATION --}}
<div class="mt-6 flex justify-center">
    {{ $products->onEachSide(1)->links('vendor.pagination.admin') }}
</div>

<div class="mt-2 text-center text-sm text-gray-600">
    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} results
</div>



</div>
@endsection
=======
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
>>>>>>> fc7673c (frontend update and some new feature)
