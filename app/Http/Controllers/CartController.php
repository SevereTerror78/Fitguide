<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /** Kosár lekérése sessionből */
    private function getCart(Request $request): array
    {
        return $request->session()->get('cart', []);
    }

    /** Kosár mentése sessionbe */
    private function saveCart(Request $request, array $cart): void
    {
        $request->session()->put('cart', $cart);
    }

    /** Kosár oldal megjelenítése */
    public function index(Request $request)
    {
        $cart = $this->getCart($request);
        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        $shipping = 0.0;
        $total = $subtotal + $shipping;

        return response()
            ->view('cart.index', compact('cart', 'subtotal', 'shipping', 'total'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
    }

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
                    : back();
            }
        }

        // Kosár frissítése
        $cart = $this->getCart($request);

        if (isset($cart[$product->id])) {
            $newQty = $cart[$product->id]['qty'] + $qty;
            if (!is_null($product->stock) && $newQty > $product->stock) {
                return $request->expectsJson()
                    ? response()->json(['ok' => false, 'msg' => 'Not enough stock.'], 422)
                    : back();
            }
            $cart[$product->id]['qty'] = $newQty;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name'       => $product->name,
                'price'      => (float)$product->price,
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

    /** Kosár frissítése (mennyiség módosítása) */
   public function update(Request $request, Product $product)
    {
        $cart = $this->getCart($request);

        if (!isset($cart[$product->id])) {
            return $request->expectsJson()
                ? response()->json(['ok' => false, 'msg' => 'Product not in cart.'], 404)
                : back();
        }

        $qty = max(1, (int) $request->input('qty', 1));

        if (!is_null($product->stock) && $qty > $product->stock) {
            return $request->expectsJson()
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
            $discountSession['amount'] = $discountAmount;
            $request->session()->put('discount', $discountSession);
        }

        // ── TOTAL ─────────────────────────────────────
        $total = max(0, $subtotal + $shipping - $discountAmount);
        $count = collect($cart)->sum('qty');

        // ── JSON RESPONSE (frontend kompatibilis) ─────
        if ($request->expectsJson()) {
            return response()->json([
                'ok'        => true,
                'qty'       => $qty,
                'lineTotal' => number_format($lineTotal, 2, '.', ''),
                'subtotal'  => number_format($subtotal, 2, '.', ''),
                'shipping'  => number_format($shipping, 2, '.', ''),
                'discount'  => number_format($discountAmount, 2, '.', ''),
                'total'     => number_format($total, 2, '.', ''),
                'count'     => $count,
            ]);
        }

        return back();
    }


    /** Termék eltávolítása a kosárból */
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

    /** Kosár teljes ürítése */
    public function clear(Request $request)
    {
        $this->saveCart($request, []);
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['ok' => true, 'count' => 0]);
        }
        return back();
    }

    /** Kosárban lévő termékek száma (AJAX) */
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
            return response()->json(['ok' => false, 'msg' => 'Invalid code.'], 404);
        }

        if (!$discount->isValid()) {
            $reason = $discount->usedOrNot ? 'used' : 'expired';
            return response()->json(['ok' => false, 'msg' => "This code is {$reason}.", 'reason' => $reason], 422);
        }

        $cart = $request->session()->get('cart', []);
        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        $shipping = 0.0;

        $percent = (float) $discount->discountAmount;   // pl 10
        $percent = max(1, min(100, $percent));

        $discountAmount = round($subtotal * ($percent / 100), 2);
        $total = max(0, $subtotal + $shipping - $discountAmount);

        $request->session()->put('discount', [
            'id' => $discount->id,
            'code' => $discount->discountCode,
            'percent' => $percent,
            'amount' => $discountAmount,
        ]);

        return response()->json([
            'ok' => true,
            'msg' => "Discount applied ({$percent}%).",
            'percent' => number_format($percent, 2, '.', ''),
            'discount' => number_format($discountAmount, 2, '.', ''),
            'subtotal' => number_format($subtotal, 2, '.', ''),
            'shipping' => number_format($shipping, 2, '.', ''),
            'total' => number_format($total, 2, '.', ''),
        ]);
    }

    public function removeDiscount(Request $request)
    {
        $request->session()->forget('discount');

        $cart = $request->session()->get('cart', []);
        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        $shipping = 0.0;
        $total = $subtotal + $shipping;

        return response()->json([
            'ok' => true,
            'msg' => 'Discount removed.',
            'discount' => number_format(0, 2, '.', ''),
            'subtotal' => number_format($subtotal, 2, '.', ''),
            'shipping' => number_format($shipping, 2, '.', ''),
            'total' => number_format($total, 2, '.', ''),
        ]);
    }

}
