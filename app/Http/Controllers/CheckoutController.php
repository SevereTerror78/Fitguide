<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

use Stripe\StripeClient;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('store.index')->with('error', 'Your cart is empty.');
        }

        $subtotal = collect($cart)->sum(fn ($item) => $item['price'] * $item['qty']);
        $shipping = 0.0;

        $discountSession = $request->session()->get('discount');
        $percent = isset($discountSession['percent']) ? (float) $discountSession['percent'] : 0.0;
        $percent = max(0, min(100, $percent));

        $discountAmount = $percent > 0 ? round($subtotal * ($percent / 100), 2) : 0.0;
        $total = max(0, $subtotal + $shipping - $discountAmount);

        return view('checkout.show', compact(
            'cart',
            'subtotal',
            'shipping',
            'total',
            'percent',
            'discountAmount'
        ));
    }

    public function place(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('store.index')->with('error', 'Your cart is empty.');
        }

        $rawMethod = $request->input('payment_method', 'card');
        if (!in_array($rawMethod, ['card', 'cod', 'pickup'], true)) {
            $rawMethod = 'card';
        }

        $rules = [
            'payment_method'  => 'required|in:card,cod,pickup',
            'full_name'       => 'required|string|max:255',
            'address_line2'   => 'nullable|string|max:255',
            'pickup_location' => 'nullable|string|max:255',
        ];

        if ($rawMethod !== 'pickup') {
            $rules = array_merge($rules, [
                'address_line1' => 'required|string|max:255',
                'city'          => 'required|string|max:255',
                'postal_code'   => 'required|string|max:20',
                'country'       => 'required|string|max:100',
            ]);
        }

        $validated = $request->validate($rules);
        $paymentMethod = $validated['payment_method'];

        $subtotal = collect($cart)->sum(fn ($item) => $item['price'] * $item['qty']);
        $shipping = 0.0;

        $discountSession = $request->session()->get('discount');
        $discountId = $discountSession['id'] ?? null;

        $percent = isset($discountSession['percent']) ? (float) $discountSession['percent'] : 0.0;
        $percent = max(0, min(100, $percent));
        $discountAmount = $percent > 0 ? round($subtotal * ($percent / 100), 2) : 0.0;

        $total = max(0, $subtotal + $shipping - $discountAmount);

        // 🔴 FONTOS: meglévő pending CARD order újrahasznosítása
        $existingPending = null;
        if ($paymentMethod === 'card') {
            $existingPending = Order::where('user_id', Auth::id())
                ->where('payment_method', 'card')
                ->where('payment_status', 'pending')
                ->whereNull('paid_at')
                ->latest('id')
                ->first();
        }

        try {
            $order = DB::transaction(function () use (
                $cart,
                $validated,
                $subtotal,
                $shipping,
                $total,
                $paymentMethod,
                $existingPending
            ) {
                if ($paymentMethod === 'card' && $existingPending) {
                    $order = $existingPending;

                    $order->forceFill([
                        'status'              => Order::STATUS_PENDING_PAYMENT,
                        'payment_method'      => 'card',
                        'payment_status'      => 'pending',
                        'fulfillment_status'  => 'new',
                        'currency'            => 'EUR',
                        'subtotal'            => $subtotal,
                        'shipping'            => $shipping,
                        'total'               => $total,
                        'full_name'           => $validated['full_name'],
                        'address_line1'       => $validated['address_line1'] ?? null,
                        'address_line2'       => $validated['address_line2'] ?? null,
                        'city'                => $validated['city'] ?? null,
                        'postal_code'         => $validated['postal_code'] ?? null,
                        'country'             => $validated['country'] ?? null,
                        'pickup_location'     => null,
                    ])->save();

                    $order->items()->delete();
                } else {
                    $order = Order::create([
                        'user_id' => Auth::id(),
                        'status'  => $paymentMethod === 'card'
                            ? Order::STATUS_PENDING_PAYMENT
                            : 'placed',
                        'payment_method'     => $paymentMethod,
                        'payment_status'     => $paymentMethod === 'card' ? 'pending' : 'unpaid',
                        'fulfillment_status' => 'new',
                        'currency' => 'EUR',
                        'subtotal' => $subtotal,
                        'shipping' => $shipping,
                        'total'    => $total,
                        'full_name'     => $validated['full_name'],
                        'address_line1' => $validated['address_line1'] ?? null,
                        'address_line2' => $validated['address_line2'] ?? null,
                        'city'          => $validated['city'] ?? null,
                        'postal_code'   => $validated['postal_code'] ?? null,
                        'country'       => $validated['country'] ?? null,
                        'pickup_location' => $paymentMethod === 'pickup'
                            ? ($validated['pickup_location'] ?? 'Pickup point')
                            : null,
                    ]);
                }

                foreach ($cart as $item) {
                    $product = Product::findOrFail($item['product_id']);

                    if ($product->is_active === false) {
                        throw new \Exception("Product {$product->name} is inactive.");
                    }

                    if (!is_null($product->stock) && $product->stock < $item['qty']) {
                        throw new \Exception("Product {$product->name} not available.");
                    }

                    OrderItem::create([
                        'order_id'   => $order->id,
                        'product_id' => $product->id,
                        'name'       => $product->name,
                        'unit_price' => $product->price,
                        'qty'        => $item['qty'],
                        'line_total' => $product->price * $item['qty'],
                    ]);
                }

                return $order;
            });

            // ✅ COD / PICKUP
            if ($paymentMethod !== 'card') {
                $order->update(['fulfillment_status' => 'processing']);
                $request->session()->forget('cart');
                return redirect()->to('/checkout/success?order_id=' . $order->id);
            }

            // ✅ CARD – Stripe
            $order->load('items');
            $stripe = new StripeClient(config('services.stripe.secret'));

            $lineItems = $order->items->map(function ($it) use ($order) {
                return [
                    'price_data' => [
                        'currency' => strtolower($order->currency),
                        'product_data' => ['name' => $it->name],
                        'unit_amount' => (int) round($it->unit_price * 100),
                    ],
                    'quantity' => (int) $it->qty,
                ];
            })->values()->all();

            $couponId = null;
            if ($percent > 0) {
                $coupon = $stripe->coupons->create([
                    'percent_off' => $percent,
                    'duration'    => 'once',
                    'name'        => 'FitGuide Discount',
                ]);
                $couponId = $coupon->id;
            }

            $session = $stripe->checkout->sessions->create([
                'mode' => 'payment',
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'discounts' => $couponId ? [['coupon' => $couponId]] : [],
                'metadata' => [
                    'order_id' => (string) $order->id,
                    'user_id'  => (string) $order->user_id,
                    'discount_id' => $discountId ? (string) $discountId : '',
                ],
                'success_url' => url('/checkout/success?order_id=' . $order->id),
                'cancel_url'  => route('checkout.show') . '?cancelled=1',
            ]);

            $order->update([
                'stripe_checkout_session_id' => $session->id,
            ]);

            return redirect()->away($session->url);

        } catch (\Exception $e) {
            return back()->with('error', 'Order failed: ' . $e->getMessage());
        }
    }
}
