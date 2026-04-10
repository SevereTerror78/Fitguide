<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
<<<<<<< HEAD
    /** Kosár lekérése sessionből */
=======
>>>>>>> fc7673c (frontend update and some new feature)
    private function getCart(Request $request): array
    {
        return $request->session()->get('cart', []);
    }

<<<<<<< HEAD
    /** Kosár mentése sessionbe */
=======
>>>>>>> fc7673c (frontend update and some new feature)
    private function saveCart(Request $request, array $cart): void
    {
        $request->session()->put('cart', $cart);
    }

<<<<<<< HEAD
    /** Kosár oldal megjelenítése */
    public function index(Request $request)
    {
        $cart = $this->getCart($request);
        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        $shipping = 0.0;
        $total = $subtotal + $shipping;

        return response()
            ->view('cart.index', compact('cart', 'subtotal', 'shipping', 'total'))
=======
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
>>>>>>> fc7673c (frontend update and some new feature)
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
    }

<<<<<<< HEAD
    /** Termék hozzáadása a kosárhoz */
    public function add(Request $request, Product $product)
    {
        // Csak akkor tiltson, ha explicit inaktív
        if (!is_null($product->is_active) && !$product->is_active) {
            return $request->expectsJson()
                ? response()->json(['ok' => false, 'msg' => 'Product inactive.'], 422)
                : back();
        }

        $qty = max(1, (int)$request->input('qty', 1));

        // Készletellenőrzés, ha van stock mező
        if (!is_null($product->stock)) {
            if ($product->stock <= 0) {
                return $request->expectsJson()
                    ? response()->json(['ok' => false, 'msg' => 'Out of stock.'], 422)
                    : back();
            }
            if ($qty > $product->stock) {
                return $request->expectsJson()
                    ? response()->json(['ok' => false, 'msg' => 'Not enough stock.'], 422)
=======
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
>>>>>>> fc7673c (frontend update and some new feature)
                    : back();
            }
        }

<<<<<<< HEAD
        // Kosár frissítése
=======
>>>>>>> fc7673c (frontend update and some new feature)
        $cart = $this->getCart($request);

        if (isset($cart[$product->id])) {
            $newQty = $cart[$product->id]['qty'] + $qty;
<<<<<<< HEAD
            if (!is_null($product->stock) && $newQty > $product->stock) {
                return $request->expectsJson()
                    ? response()->json(['ok' => false, 'msg' => 'Not enough stock.'], 422)
                    : back();
            }
=======

            if (!is_null($product->stock) && $newQty > $product->stock) {
                return $request->expectsJson()
                    ? response()->json(['ok' => false, 'msg' => __('cart.errors.not_enough_stock')], 422)
                    : back();
            }

>>>>>>> fc7673c (frontend update and some new feature)
            $cart[$product->id]['qty'] = $newQty;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
<<<<<<< HEAD
                'name'       => $product->name,
                'price'      => (float)$product->price,
=======
                'name'       => $product->translated_name,
                'price_huf'  => (int) $product->price_huf,
>>>>>>> fc7673c (frontend update and some new feature)
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

<<<<<<< HEAD
    /** Kosár frissítése (mennyiség módosítása) */
   public function update(Request $request, Product $product)
=======
    public function update(Request $request, Product $product)
>>>>>>> fc7673c (frontend update and some new feature)
    {
        $cart = $this->getCart($request);

        if (!isset($cart[$product->id])) {
            return $request->expectsJson()
<<<<<<< HEAD
                ? response()->json(['ok' => false, 'msg' => 'Product not in cart.'], 404)
=======
                ? response()->json(['ok' => false, 'msg' => __('cart.errors.product_not_in_cart')], 404)
>>>>>>> fc7673c (frontend update and some new feature)
                : back();
        }

        $qty = max(1, (int) $request->input('qty', 1));

        if (!is_null($product->stock) && $qty > $product->stock) {
            return $request->expectsJson()
<<<<<<< HEAD
                ? response()->json(['ok' => false, 'msg' => 'Not enough stock.'], 422)
                : back();
        }

        // ── Qty frissítés ─────────────────────────────
        $cart[$product->id]['qty'] = $qty;
        $this->saveCart($request, $cart);

        // ── Alapszámítások ────────────────────────────
        $lineTotal = $cart[$product->id]['price'] * $qty;
        $subtotal  = collect($cart)->sum(fn ($i) => $i['price'] * $i['qty']);
        $shipping  = 0.0;

        // ── DISCOUNT SZÁMÍTÁS (SESSION ALAPÚ) ─────────
        $discountSession = $request->session()->get('discount');
        $discountAmount  = 0.0;

        if ($discountSession && isset($discountSession['percent'])) {
            $percent = (float) $discountSession['percent'];
            $percent = max(1, min(100, $percent));

            $discountAmount = round($subtotal * ($percent / 100), 2);

            // frissítjük a sessiont, mert a subtotal változott
=======
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

>>>>>>> fc7673c (frontend update and some new feature)
            $discountSession['amount'] = $discountAmount;
            $request->session()->put('discount', $discountSession);
        }

<<<<<<< HEAD
        // ── TOTAL ─────────────────────────────────────
        $total = max(0, $subtotal + $shipping - $discountAmount);
        $count = collect($cart)->sum('qty');

        // ── JSON RESPONSE (frontend kompatibilis) ─────
=======
        $total = max(0, $subtotal + $shipping - $discountAmount);
        $count = collect($cart)->sum('qty');

>>>>>>> fc7673c (frontend update and some new feature)
        if ($request->expectsJson()) {
            return response()->json([
                'ok'        => true,
                'qty'       => $qty,
<<<<<<< HEAD
                'lineTotal' => number_format($lineTotal, 2, '.', ''),
                'subtotal'  => number_format($subtotal, 2, '.', ''),
                'shipping'  => number_format($shipping, 2, '.', ''),
                'discount'  => number_format($discountAmount, 2, '.', ''),
                'total'     => number_format($total, 2, '.', ''),
=======
                'lineTotal' => $lineTotal,
                'subtotal'  => $subtotal,
                'shipping'  => $shipping,
                'discount'  => $discountAmount,
                'total'     => $total,
>>>>>>> fc7673c (frontend update and some new feature)
                'count'     => $count,
            ]);
        }

        return back();
    }

<<<<<<< HEAD

    /** Termék eltávolítása a kosárból */
    public function remove(Request $request, Product $product)
    {
        $cart = $this->getCart($request);
=======
    public function remove(Request $request, Product $product)
    {
        $cart = $this->getCart($request);

>>>>>>> fc7673c (frontend update and some new feature)
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

<<<<<<< HEAD
    /** Kosár teljes ürítése */
=======
>>>>>>> fc7673c (frontend update and some new feature)
    public function clear(Request $request)
    {
        $this->saveCart($request, []);
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['ok' => true, 'count' => 0]);
        }
        return back();
    }

<<<<<<< HEAD
    /** Kosárban lévő termékek száma (AJAX) */
=======
>>>>>>> fc7673c (frontend update and some new feature)
    public function count(Request $request)
    {
        $count = collect($this->getCart($request))->sum('qty');
        return response()->json(['count' => $count]);
    }
<<<<<<< HEAD
=======

>>>>>>> fc7673c (frontend update and some new feature)
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
<<<<<<< HEAD
            return response()->json(['ok' => false, 'msg' => 'Invalid code.'], 404);
=======
            return response()->json([
                'ok' => false,
                'msg' => __('cart.discount.invalid_code'),
            ], 404);
>>>>>>> fc7673c (frontend update and some new feature)
        }

        if (!$discount->isValid()) {
            $reason = $discount->usedOrNot ? 'used' : 'expired';
<<<<<<< HEAD
            return response()->json(['ok' => false, 'msg' => "This code is {$reason}.", 'reason' => $reason], 422);
        }

        $cart = $request->session()->get('cart', []);
        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        $shipping = 0.0;

        $percent = (float) $discount->discountAmount;   // pl 10
        $percent = max(1, min(100, $percent));

        $discountAmount = round($subtotal * ($percent / 100), 2);
=======

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
>>>>>>> fc7673c (frontend update and some new feature)
        $total = max(0, $subtotal + $shipping - $discountAmount);

        $request->session()->put('discount', [
            'id' => $discount->id,
            'code' => $discount->discountCode,
            'percent' => $percent,
            'amount' => $discountAmount,
        ]);

        return response()->json([
            'ok' => true,
<<<<<<< HEAD
            'msg' => "Discount applied ({$percent}%).",
            'percent' => number_format($percent, 2, '.', ''),
            'discount' => number_format($discountAmount, 2, '.', ''),
            'subtotal' => number_format($subtotal, 2, '.', ''),
            'shipping' => number_format($shipping, 2, '.', ''),
            'total' => number_format($total, 2, '.', ''),
=======
            'msg' => __('cart.discount.applied', ['percent' => (int) $percent]),
            'percent' => $percent,
            'discount' => $discountAmount,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
>>>>>>> fc7673c (frontend update and some new feature)
        ]);
    }

    public function removeDiscount(Request $request)
    {
        $request->session()->forget('discount');

        $cart = $request->session()->get('cart', []);
<<<<<<< HEAD
        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        $shipping = 0.0;
=======
        $subtotal = collect($cart)->sum(fn($i) => $i['price_huf'] * $i['qty']);
        $shipping = 0;
>>>>>>> fc7673c (frontend update and some new feature)
        $total = $subtotal + $shipping;

        return response()->json([
            'ok' => true,
<<<<<<< HEAD
            'msg' => 'Discount removed.',
            'discount' => number_format(0, 2, '.', ''),
            'subtotal' => number_format($subtotal, 2, '.', ''),
            'shipping' => number_format($shipping, 2, '.', ''),
            'total' => number_format($total, 2, '.', ''),
        ]);
    }

}
=======
            'msg' => __('cart.discount.removed'),
            'discount' => 0,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
        ]);
    }
}
>>>>>>> fc7673c (frontend update and some new feature)
