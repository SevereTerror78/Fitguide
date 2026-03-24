@extends('admin.layout')

@section('content')
<div class="p-8 max-w-3xl">

    <h1 class="text-3xl font-bold mb-6">Edit Product</h1>

    <form method="POST"
          action="{{ route('admin.products.update', $product->id) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- NAME --}}
        <label class="block mb-4">
            <span class="block font-medium mb-1">Name</span>
            <input
                type="text"
                name="name"
                class="w-full p-2 border rounded"
                value="{{ old('name', $product->name) }}"
                required
            >
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </label>

        {{-- PRICE --}}
        <label class="block mb-4">
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
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </label>

        {{-- STOCK --}}
        <label class="block mb-4">
            <span class="block font-medium mb-1">Stock</span>
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
            <span class="block font-medium mb-1">Category</span>
            <select name="product_type_id" class="w-full p-2 border rounded">
                @foreach($productTypes as $type)
                    <option value="{{ $type->id }}"
                        {{ old('product_type_id', $product->product_type_id) == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
            @error('product_type_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </label>

        {{-- IMAGE --}}
        <label class="block mb-6">
            <span class="block font-medium mb-1">Product Image</span>

            {{-- Current image preview --}}
            @if($product->image)
                <div class="mb-3">
                    <img
                        src="{{ asset('images/'.$product->image) }}"
                        alt="Product image"
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
                JPG, PNG, WebP • max 2MB.  
                If you don’t upload a new image, the current one will stay.
            </p>

            @error('image')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </label>

        {{-- SUBMIT --}}
        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
            Save Changes
        </button>

    </form>
</div>
@endsection
