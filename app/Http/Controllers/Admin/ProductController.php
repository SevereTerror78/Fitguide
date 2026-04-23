<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\AdminNotification;
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
                $q->where(function ($qq) use ($search) {
                    if (app()->getLocale() === 'hu') {
                        $qq->where('name_hu', 'like', "%{$search}%")
                           ->orWhere('name', 'like', "%{$search}%");
                    } else {
                        $qq->where('name', 'like', "%{$search}%")
                           ->orWhere('name_hu', 'like', "%{$search}%");
                    }
                });
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
            'price_huf'       => 'required|integer|min:0',
            'stock'           => 'required|integer|min:0',
            'product_type_id' => 'required|exists:product_types,id',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'       => 'nullable|boolean',
        ]);

        $rawName = $data['name'];

        $data['name'] = $rawName;
        $data['name_hu'] = $rawName;

        $data['is_active'] = (bool) ($data['is_active'] ?? (((int) $data['stock']) > 0));

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imageName);
        }

        $data['image'] = $imageName;

        $product = Product::create($data);

        $this->handleLowStockNotification($product);

        return redirect()
            ->route('admin.products.index')
            ->with('success', __('admin.products.flash.created'));
    }

    public function edit(Product $product)
    {
        $productTypes = ProductType::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'productTypes'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'price_huf'       => 'required|integer|min:0',
            'stock'           => 'required|integer|min:0',
            'product_type_id' => 'required|exists:product_types,id',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'       => 'nullable|boolean',
        ]);

        $rawName = $data['name'];

        $data['name'] = $rawName;
        $data['name_hu'] = $rawName;

        $data['is_active'] = (bool) ($data['is_active'] ?? (((int) $data['stock']) > 0));

        if ($request->hasFile('image')) {
            if ($product->image) {
                $oldPath = public_path('images/' . $product->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        } else {
            unset($data['image']);
        }

        $product->update($data);

        $this->handleLowStockNotification($product);

        return redirect()
            ->route('admin.products.index')
            ->with('success', __('admin.products.flash.updated'));
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            $path = public_path('images/' . $product->image);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
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
    
}