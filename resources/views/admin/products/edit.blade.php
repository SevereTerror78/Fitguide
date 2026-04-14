@extends('admin.layout')

@section('content')
<div class="p-8 max-w-3xl">

    <h1 class="text-3xl font-bold mb-6">{{ __('admin.products.edit_title') }}</h1>

    <form method="POST"
          action="{{ route('admin.products.update', $product->id) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- NAME (single field, locale based) --}}
        <label class="block mb-4">
            <span class="block font-medium mb-1">{{ __('admin.products.form.name') }}</span>
            <input
                type="text"
                name="name"
                class="w-full p-2 border rounded"
                value="{{ old('name', $product->translated_name) }}"
                required
            >
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </label>

        {{-- PRICE --}}
        <label class="block mb-4">
            <span class="block font-medium mb-1">{{ __('admin.products.form.price') }} (HUF)</span>
            <input
                type="number"
                name="price_huf"
                step="1"
                min="0"
                class="w-full p-2 border rounded"
                value="{{ old('price_huf', $product->price_huf) }}"
                required
            >
            @error('price_huf')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </label>

        {{-- STOCK --}}
        <label class="block mb-4">
            <span class="block font-medium mb-1">{{ __('admin.products.form.stock') }}</span>
            <input
                type="number"
                name="stock"
                class="w-full p-2 border rounded"
                value="{{ old('stock', $product->stock) }}"
                required
            >
            @error('stock')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </label>

        {{-- CATEGORY --}}
        <label class="block mb-4">
            <span class="block font-medium mb-1">{{ __('admin.products.form.category') }}</span>
            <select name="product_type_id" class="w-full p-2 border rounded">
                @foreach($productTypes as $type)
                    <option value="{{ $type->id }}"
                        {{ old('product_type_id', $product->product_type_id) == $type->id ? 'selected' : '' }}>
                        {{ $type->translated_name ?? $type->name }}
                    </option>
                @endforeach
            </select>
            @error('product_type_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </label>

        {{-- IMAGE --}}
        <label class="block mb-6">
            <span class="block font-medium mb-1">{{ __('admin.products.form.product_image') }}</span>

            @if($product->image)
                <div class="mb-3">
                    <img
                        src="{{ asset('images/'.$product->image) }}"
                        alt="{{ __('admin.products.alt.product_image') }}"
                        class="h-20 w-20 object-cover rounded border"
                    >
                </div>
            @endif

            <input
                type="file"
                name="image"
                accept="image/*"
                class="w-full p-2 border rounded"
            >

            <p class="text-sm text-gray-500 mt-1">
                {{ __('admin.products.form.image_help') }}
            </p>

            @error('image')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </label>

        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
            {{ __('admin.products.save_changes') }}
        </button>

    </form>
</div>
@endsection