@extends('admin.layout')

@section('content')
<div class="p-8 max-w-3xl">

<<<<<<< HEAD
    <h1 class="text-3xl font-bold mb-6">Edit Product</h1>
=======
    <h1 class="text-3xl font-bold mb-6">{{ __('admin.products.edit_title') }}</h1>
>>>>>>> fc7673c (frontend update and some new feature)

    <form method="POST"
          action="{{ route('admin.products.update', $product->id) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

<<<<<<< HEAD
        {{-- NAME --}}
        <label class="block mb-4">
            <span class="block font-medium mb-1">Name</span>
=======
        {{-- NAME (single field, locale based) --}}
        <label class="block mb-4">
            <span class="block font-medium mb-1">{{ __('admin.products.form.name') }}</span>
>>>>>>> fc7673c (frontend update and some new feature)
            <input
                type="text"
                name="name"
                class="w-full p-2 border rounded"
<<<<<<< HEAD
                value="{{ old('name', $product->name) }}"
=======
                value="{{ old('name', $product->translated_name) }}"
>>>>>>> fc7673c (frontend update and some new feature)
                required
            >
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </label>

        {{-- PRICE --}}
        <label class="block mb-4">
<<<<<<< HEAD
            <span class="block font-medium mb-1">Price</span>
            <input
                type="number"
                name="price"
                step="0.01"
                class="w-full p-2 border rounded"
                value="{{ old('price', $product->price) }}"
                required
            >
            @error('price')
=======
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
>>>>>>> fc7673c (frontend update and some new feature)
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </label>

        {{-- STOCK --}}
        <label class="block mb-4">
<<<<<<< HEAD
            <span class="block font-medium mb-1">Stock</span>
=======
            <span class="block font-medium mb-1">{{ __('admin.products.form.stock') }}</span>
>>>>>>> fc7673c (frontend update and some new feature)
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
<<<<<<< HEAD
            <span class="block font-medium mb-1">Category</span>
=======
            <span class="block font-medium mb-1">{{ __('admin.products.form.category') }}</span>
>>>>>>> fc7673c (frontend update and some new feature)
            <select name="product_type_id" class="w-full p-2 border rounded">
                @foreach($productTypes as $type)
                    <option value="{{ $type->id }}"
                        {{ old('product_type_id', $product->product_type_id) == $type->id ? 'selected' : '' }}>
<<<<<<< HEAD
                        {{ $type->name }}
=======
                        {{ $type->translated_name ?? $type->name }}
>>>>>>> fc7673c (frontend update and some new feature)
                    </option>
                @endforeach
            </select>
            @error('product_type_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </label>

        {{-- IMAGE --}}
        <label class="block mb-6">
<<<<<<< HEAD
            <span class="block font-medium mb-1">Product Image</span>

            {{-- Current image preview --}}
=======
            <span class="block font-medium mb-1">{{ __('admin.products.form.product_image') }}</span>

>>>>>>> fc7673c (frontend update and some new feature)
            @if($product->image)
                <div class="mb-3">
                    <img
                        src="{{ asset('images/'.$product->image) }}"
<<<<<<< HEAD
                        alt="Product image"
=======
                        alt="{{ __('admin.products.alt.product_image') }}"
>>>>>>> fc7673c (frontend update and some new feature)
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
<<<<<<< HEAD
                JPG, PNG, WebP • max 2MB.  
                If you don’t upload a new image, the current one will stay.
=======
                {{ __('admin.products.form.image_help') }}
>>>>>>> fc7673c (frontend update and some new feature)
            </p>

            @error('image')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </label>

<<<<<<< HEAD
        {{-- SUBMIT --}}
        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
            Save Changes
=======
        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
            {{ __('admin.products.save_changes') }}
>>>>>>> fc7673c (frontend update and some new feature)
        </button>

    </form>
</div>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> fc7673c (frontend update and some new feature)
