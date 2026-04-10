@extends('admin.layout')

@section('content')
<<<<<<< HEAD
<div class="p-8 bg-gray-100 min-h-screen">

    <div class="max-w-4xl mx-auto">

        <h1 class="text-3xl font-bold mb-8 text-gray-800">Add New Product</h1>

        <div class="bg-white border border-gray-200 shadow-xl rounded-xl p-10">

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- NAME --}}
                <div>
                    <label class="font-semibold text-sm text-gray-700">Name</label>
                    <input type="text" name="name"
                        class="w-full mt-1 p-3 border rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- DESCRIPTION --}}
                <div>
                    <label class="font-semibold text-sm text-gray-700">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full mt-1 p-3 border rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                {{-- PRICE + STOCK --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="font-semibold text-sm text-gray-700">Price (€)</label>
                        <input type="number" name="price" step="0.01"
                            class="w-full mt-1 p-3 border rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="font-semibold text-sm text-gray-700">Stock</label>
                        <input type="number" name="stock"
                            class="w-full mt-1 p-3 border rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                {{-- CATEGORY --}}
                <div>
                    <label class="font-semibold text-sm text-gray-700">Category</label>
                    <select name="product_type_id"
                        class="w-full mt-1 p-3 border rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($productTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- STATUS --}}
                <div>
                    <label class="font-semibold text-sm text-gray-700">Status</label>
                    <select name="is_active"
                        class="w-full mt-1 p-3 border rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                {{-- IMAGE --}}
                <div>
                    <label class="font-semibold text-sm text-gray-700">Image</label>
                    <input type="file" name="image"
                        class="w-full mt-1 p-3 border rounded-lg bg-gray-50 cursor-pointer">
                </div>

                {{-- BUTTONS --}}
                <div class="flex justify-end gap-4 pt-4">
                    <a href="{{ route('admin.products.index') }}"
                       class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium">
                        Cancel
                    </a>
                    <button
                        class="px-6 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-md transition">
                        Save Product
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>
@endsection
=======
<div class="p-8 max-w-3xl">

    <h1 class="text-3xl font-bold mb-6">{{ __('admin.products.edit_title') }}</h1>

    <form method="POST"
          action="{{ route('admin.products.update', $product->id) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- NAME --}}
        <label class="block mb-4">
            <span class="block font-medium mb-1">{{ __('admin.products.form.name') }}</span>
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
>>>>>>> fc7673c (frontend update and some new feature)
