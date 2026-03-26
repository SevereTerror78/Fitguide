<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Termékek listázása opcionális típus szűréssel.
     * ?type=all|supplements|snacks|equipment|clothing|accessories|packages-gift
     */
    public function index(Request $request)
    {
        $type   = $request->query('type', 'all');
        $search = trim((string) $request->query('search', ''));

        $products = Product::with('productType')
            ->when($type !== 'all', function ($q) use ($type) {
                $q->whereHas('productType', fn($t) => $t->where('slug', $type));
            })
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(24)
            ->appends([
                'type'   => $type,
                'search' => $search,
            ]);

        if ($request->ajax()) {
            return view('store.partials.products', compact('products', 'type'))->render();
        }

        $productTypes = ProductType::all();

        return view('store.index', compact('products', 'productTypes'))
            ->with('active', $type);
    }

}
