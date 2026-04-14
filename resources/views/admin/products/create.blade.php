@extends('admin.layout')

@section('content')
<div class="p-4 md:p-8">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 md:px-8 md:py-6 border-b border-gray-100">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">
                {{ __('admin.products.add_product') }}
            </h1>
        </div>

        <form method="POST"
              action="{{ route('admin.products.store') }}"
              enctype="multipart/form-data"
              class="px-6 py-6 md:px-8 md:py-8 space-y-6">
            @csrf

            {{-- NAME --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    {{ __('admin.products.form.name') }}
                </label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- PRICE --}}
            <div>
                <label for="price_huf" class="block text-sm font-semibold text-gray-700 mb-2">
                    {{ __('admin.products.form.price') }} (HUF)
                </label>
                <input
                    id="price_huf"
                    type="number"
                    name="price_huf"
                    step="1"
                    min="0"
                    value="{{ old('price_huf') }}"
                    required
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                @error('price_huf')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- STOCK --}}
            <div>
                <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">
                    {{ __('admin.products.form.stock') }}
                </label>
                <input
                    id="stock"
                    type="number"
                    name="stock"
                    min="0"
                    value="{{ old('stock') }}"
                    required
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                @error('stock')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- CATEGORY --}}
            <div>
                <label for="product_type_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    {{ __('admin.products.form.category') }}
                </label>
                <select
                    id="product_type_id"
                    name="product_type_id"
                    required
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-900 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                    @foreach($productTypes as $type)
                        <option value="{{ $type->id }}"
                            {{ old('product_type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->translated_name ?? $type->name }}
                        </option>
                    @endforeach
                </select>
                @error('product_type_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- IMAGE --}}
            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                    {{ __('admin.products.form.product_image') }}
                </label>

                <input
                    id="image"
                    type="file"
                    name="image"
                    accept="image/*"
                    class="block w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:font-medium file:text-blue-700 hover:file:bg-blue-100"
                >

                <p class="mt-2 text-sm text-gray-500">
                    {{ __('admin.products.form.image_help') }}
                </p>

                @error('image')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- STATUS --}}
            <div>
                <label for="is_active" class="block text-sm font-semibold text-gray-700 mb-2">
                    {{ __('admin.products.table.status') }}
                </label>
                <select
                    id="is_active"
                    name="is_active"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-900 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>
                        {{ __('admin.products.filters.active') }}
                    </option>
                    <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>
                        {{ __('admin.products.filters.inactive') }}
                    </option>
                </select>
                @error('is_active')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- ACTIONS --}}
            <div class="flex flex-col-reverse sm:flex-row sm:justify-between gap-3 pt-2">
                <a href="{{ route('admin.products.index') }}"
                class="inline-flex items-center justify-center rounded-xl bg-gray-100 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-200 transition">
                    {{ __('admin.products.actions.back') }}
                </a>

                <button type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700 transition shadow-sm">
                    {{ __('admin.products.add_product') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection