<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private function getCart(Request $request): array
    {
        return $request->session()->get('cart', []);
    }

    private function saveCart(Request $request, array $cart): void
    {
        $request->session()->put('cart', $cart);
    }

    public function index(Request $request)
    {
        $cart = $this->getCart($request);
        $subtotal = collect($cart)->sum(fn($i) => $i['price_huf'] * $i['qty']);
        $shipping = 0;
        $discount = 0;

        $discountSession = $request->session()->get('discount');
        if ($discountSession && isset($discountSession['percent'])) {
            $percent = max(1, min(100, (float) $discountSession['percent']));
            $discount = (int) round($subtotal * ($percent / 100));
        }

        $total = max(0, $subtotal + $shipping - $discount);

        return response()
            ->view('cart.index', compact('cart', 'subtotal', 'shipping', 'discount', 'total'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
    }

    public function add(Request $request, Product $product)
    {
        if (!is_null($product->is_active) && !$product->is_active) {
            return $request->expectsJson()
                ? response()->json(['ok' => false, 'msg' => __('cart.errors.product_inactive')], 422)
                : back();
        }

        $qty = max(1, (int) $request->input('qty', 1));

        if (!is_null($product->stock)) {
            if ($product->stock <= 0) {
                return $request->expectsJson()
                    ? response()->json(['ok' => false, 'msg' => __('cart.errors.out_of_stock')], 422)
                    : back();
            }

            if ($qty > $product->stock) {
                return $request->expectsJson()
                    ? response()->json(['ok' => false, 'msg' => __('cart.errors.not_enough_stock')], 422)
                    : back();
            }
        }

        $cart = $this->getCart($request);

        if (isset($cart[$product->id])) {
            $newQty = $cart[$product->id]['qty'] + $qty;

            if (!is_null($product->stock) && $newQty > $product->stock) {
                return $request->expectsJson()
                    ? response()->json(['ok' => false, 'msg' => __('cart.errors.not_enough_stock')], 422)
                    : back();
            }

            $cart[$product->id]['qty'] = $newQty;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name'       => $product->translated_name,
                'price_huf'  => (int) $product->price_huf,
                'qty'        => $qty,
            ];
        }

        $this->saveCart($request, $cart);
        $count = collect($cart)->sum('qty');

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'ok'    => true,
                'count' => $count,
            ]);
        }

        return back();
    }

    public function update(Request $request, Product $product)
    {
        $cart = $this->getCart($request);

        if (!isset($cart[$product->id])) {
            return $request->expectsJson()
                ? response()->json(['ok' => false, 'msg' => __('cart.errors.product_not_in_cart')], 404)
                : back();
        }

        $qty = max(1, (int) $request->input('qty', 1));

        if (!is_null($product->stock) && $qty > $product->stock) {
            return $request->expectsJson()
                ? response()->json(['ok' => false, 'msg' => __('cart.errors.not_enough_stock')], 422)
                : back();
        }

        $cart[$product->id]['qty'] = $qty;
        $this->saveCart($request, $cart);

        $lineTotal = $cart[$product->id]['price_huf'] * $qty;
        $subtotal  = collect($cart)->sum(fn ($i) => $i['price_huf'] * $i['qty']);
        $shipping  = 0;

        $discountSession = $request->session()->get('discount');
        $discountAmount  = 0;

        if ($discountSession && isset($discountSession['percent'])) {
            $percent = max(1, min(100, (float) $discountSession['percent']));
            $discountAmount = (int) round($subtotal * ($percent / 100));

            $discountSession['amount'] = $discountAmount;
            $request->session()->put('discount', $discountSession);
        }

        $total = max(0, $subtotal + $shipping - $discountAmount);
        $count = collect($cart)->sum('qty');

        if ($request->expectsJson()) {
            return response()->json([
                'ok'        => true,
                'qty'       => $qty,
                'lineTotal' => $lineTotal,
                'subtotal'  => $subtotal,
                'shipping'  => $shipping,
                'discount'  => $discountAmount,
                'total'     => $total,
                'count'     => $count,
            ]);
        }

        return back();
    }

    public function remove(Request $request, Product $product)
    {
        $cart = $this->getCart($request);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            $this->saveCart($request, $cart);
        }

        $count = collect($cart)->sum('qty');

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'ok'    => true,
                'count' => $count,
            ]);
        }

        return back();
    }

    public function clear(Request $request)
    {
        $this->saveCart($request, []);
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['ok' => true, 'count' => 0]);
        }
        return back();
    }

    public function count(Request $request)
    {
        $count = collect($this->getCart($request))->sum('qty');
        return response()->json(['count' => $count]);
    }

    public function applyDiscount(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50',
        ]);

        $code = strtoupper(trim($request->code));

        $discount = Discount::where('user_id', Auth::id())
            ->where('discountCode', $code)
            ->first();

        if (!$discount) {
            return response()->json([
                'ok' => false,
                'msg' => __('cart.discount.invalid_code'),
            ], 404);
        }

        if (!$discount->isValid()) {
            $reason = $discount->usedOrNot ? 'used' : 'expired';

            return response()->json([
                'ok' => false,
                'msg' => __('cart.discount.code_' . $reason),
                'reason' => $reason,
            ], 422);
        }

        $cart = $request->session()->get('cart', []);
        $subtotal = collect($cart)->sum(fn($i) => $i['price_huf'] * $i['qty']);
        $shipping = 0;

        $percent = max(1, min(100, (float) $discount->discountAmount));
        $discountAmount = (int) round($subtotal * ($percent / 100));
        $total = max(0, $subtotal + $shipping - $discountAmount);

        $request->session()->put('discount', [
            'id' => $discount->id,
            'code' => $discount->discountCode,
            'percent' => $percent,
            'amount' => $discountAmount,
        ]);

        return response()->json([
            'ok' => true,
            'msg' => __('cart.discount.applied', ['percent' => (int) $percent]),
            'percent' => $percent,
            'discount' => $discountAmount,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
        ]);
    }

    public function removeDiscount(Request $request)
    {
        $request->session()->forget('discount');

        $cart = $request->session()->get('cart', []);
        $subtotal = collect($cart)->sum(fn($i) => $i['price_huf'] * $i['qty']);
        $shipping = 0;
        $total = $subtotal + $shipping;

        return response()->json([
            'ok' => true,
            'msg' => __('cart.discount.removed'),
            'discount' => 0,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
        ]);
    }
}