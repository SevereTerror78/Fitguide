<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search   = $request->input('search');
        $category = $request->input('category', 'all');
        $status   = $request->input('status', 'all');

        $products = Product::query()
            ->with('productType')
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })
            ->when($category !== 'all', function ($q) use ($category) {
                $q->where('product_type_id', $category);
            })
            ->when($status !== 'all', function ($q) use ($status) {
                $q->where('is_active', $status === 'active');
            })
            ->orderBy('id', 'asc')
            ->paginate(20)
            ->withQueryString();

        $productTypes = ProductType::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'productTypes', 'search', 'category', 'status'));
    }

    public function create()
    {
        $productTypes = ProductType::orderBy('name')->get();
        return view('admin.products.create', compact('productTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'description'     => 'nullable|string',
            'price'           => 'required|numeric|min:0',
            'stock'           => 'required|integer|min:0',
            'product_type_id' => 'required|exists:product_types,id',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // stock alapján aktív/inaktív
        $data['is_active'] = ((int)$data['stock']) > 0;

        // kép mentés public/images alá
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imageName);
        }
        $data['image'] = $imageName;

        Product::create($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $productTypes = ProductType::all();
        return view('admin.products.edit', compact('product', 'productTypes'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'price'           => 'required|numeric|min:0',
            'stock'           => 'required|integer|min:0',
            'product_type_id' => 'required|exists:product_types,id',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // ha stock 0, legyen inaktív
        $data['is_active'] = ((int)$data['stock']) > 0;

        // ha jött új kép: régit töröljük + újat mentjük
        if ($request->hasFile('image')) {
            // régi törlés
            if ($product->image) {
                $oldPath = public_path('images/' . $product->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            // új mentés
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        } else {
            // ha nem töltesz fel újat, ne írja nullára
            unset($data['image']);
        }

        $product->update($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // kép törlés törlés előtt
        if ($product->image) {
            $path = public_path('images/' . $product->image);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
