<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;
<<<<<<< HEAD
<<<<<<< HEAD
=======
use App\Models\AdminNotification;
>>>>>>> fc7673c (frontend update and some new feature)
=======
use App\Models\AdminNotification;
>>>>>>> 5c55d34 (new features)
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
<<<<<<< HEAD
<<<<<<< HEAD
                $q->where('name', 'like', "%$search%");
=======
=======
>>>>>>> 5c55d34 (new features)
                $q->where(function ($qq) use ($search) {
                    if (app()->getLocale() === 'hu') {
                        $qq->where('name_hu', 'like', "%{$search}%")
                           ->orWhere('name', 'like', "%{$search}%");
                    } else {
                        $qq->where('name', 'like', "%{$search}%")
                           ->orWhere('name_hu', 'like', "%{$search}%");
                    }
                });
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
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
<<<<<<< HEAD
<<<<<<< HEAD
            'price'           => 'required|numeric|min:0',
=======
            'price_huf'       => 'required|integer|min:0',
>>>>>>> fc7673c (frontend update and some new feature)
=======
            'price_huf'       => 'required|integer|min:0',
>>>>>>> 5c55d34 (new features)
            'stock'           => 'required|integer|min:0',
            'product_type_id' => 'required|exists:product_types,id',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

<<<<<<< HEAD
<<<<<<< HEAD
        // stock alapján aktív/inaktív
        $data['is_active'] = ((int)$data['stock']) > 0;

        // kép mentés public/images alá
=======
=======
>>>>>>> 5c55d34 (new features)
        if (app()->getLocale() === 'hu') {
            $data['name_hu'] = $data['name'];
            unset($data['name']);
        }

        $data['is_active'] = ((int) $data['stock']) > 0;

<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imageName);
        }
<<<<<<< HEAD
<<<<<<< HEAD
        $data['image'] = $imageName;

        Product::create($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully!');
=======
=======
>>>>>>> 5c55d34 (new features)

        $data['image'] = $imageName;

        $product = Product::create($data);

        $this->handleLowStockNotification($product);

        return redirect()
            ->route('admin.products.index')
            ->with('success', __('admin.products.flash.created'));
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
    }

    public function edit(Product $product)
    {
<<<<<<< HEAD
<<<<<<< HEAD
        $productTypes = ProductType::all();
=======
        $productTypes = ProductType::orderBy('name')->get();
>>>>>>> fc7673c (frontend update and some new feature)
=======
        $productTypes = ProductType::orderBy('name')->get();
>>>>>>> 5c55d34 (new features)
        return view('admin.products.edit', compact('product', 'productTypes'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
<<<<<<< HEAD
<<<<<<< HEAD
            'price'           => 'required|numeric|min:0',
=======
            'price_huf'       => 'required|integer|min:0',
>>>>>>> fc7673c (frontend update and some new feature)
=======
            'price_huf'       => 'required|integer|min:0',
>>>>>>> 5c55d34 (new features)
            'stock'           => 'required|integer|min:0',
            'product_type_id' => 'required|exists:product_types,id',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

<<<<<<< HEAD
<<<<<<< HEAD
        // ha stock 0, legyen inaktív
        $data['is_active'] = ((int)$data['stock']) > 0;

        // ha jött új kép: régit töröljük + újat mentjük
        if ($request->hasFile('image')) {
            // régi törlés
=======
=======
>>>>>>> 5c55d34 (new features)
        if (app()->getLocale() === 'hu') {
            $data['name_hu'] = $data['name'];
            unset($data['name']);
        }

        $data['is_active'] = ((int) $data['stock']) > 0;

        if ($request->hasFile('image')) {
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
            if ($product->image) {
                $oldPath = public_path('images/' . $product->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

<<<<<<< HEAD
<<<<<<< HEAD
            // új mentés
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        } else {
<<<<<<< HEAD
<<<<<<< HEAD
            // ha nem töltesz fel újat, ne írja nullára
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
            unset($data['image']);
        }

        $product->update($data);

<<<<<<< HEAD
<<<<<<< HEAD
        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
=======
=======
>>>>>>> 5c55d34 (new features)
        $this->handleLowStockNotification($product);

        return redirect()
            ->route('admin.products.index')
            ->with('success', __('admin.products.flash.updated'));
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
    }

    public function destroy(Product $product)
    {
<<<<<<< HEAD
<<<<<<< HEAD
        // kép törlés törlés előtt
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
        if ($product->image) {
            $path = public_path('images/' . $product->image);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
<<<<<<< HEAD
<<<<<<< HEAD
            ->with('success', 'Product deleted successfully.');
    }
}
=======
=======
>>>>>>> 5c55d34 (new features)
            ->with('success', __('admin.products.flash.deleted'));
    }

    private function handleLowStockNotification(Product $product): void
    {
        $threshold = 10;

        if ((int) $product->stock >= $threshold) {
            AdminNotification::where('product_id', $product->id)
                ->whereNull('read_at')
                ->where('type', 'low_stock')
                ->update(['read_at' => now()]);
            return;
        }

        $existing = AdminNotification::where('product_id', $product->id)
            ->whereNull('read_at')
            ->where('type', 'low_stock')
            ->first();

        $payload = [
            'type'       => 'low_stock',
            'title'      => __('admin.notifications.low_stock_title'),
            'message'    => __('admin.notifications.low_stock_message', [
                'name' => $product->translated_name,
                'threshold' => $threshold,
            ]),
            'product_id' => $product->id,
            'stock'      => (int) $product->stock,
            'threshold'  => (int) $threshold,
        ];

        if ($existing) {
            $existing->update($payload);
        } else {
            AdminNotification::create($payload);
        }
    }
<<<<<<< HEAD
}
>>>>>>> fc7673c (frontend update and some new feature)
=======
}
>>>>>>> 5c55d34 (new features)
