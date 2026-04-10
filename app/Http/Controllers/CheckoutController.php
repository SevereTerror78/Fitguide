<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
<<<<<<< HEAD

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

=======
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
>>>>>>> fc7673c (frontend update and some new feature)
use Stripe\StripeClient;

class CheckoutController extends Controller
{
<<<<<<< HEAD
    public function show(Request $request)
    {
        $cart = $request->session()->get('cart', []);
=======
    private const PICKUP_POINTS = [
        'budapest' => 'Budapest — 1051, Arany János utca 10. (HU)',
        'debrecen' => 'Debrecen — 4025, Piac utca 12. (HU)',
        'miskolc'  => 'Miskolc — 3525, Széchenyi utca 15. (HU)',
        'szeged'   => 'Szeged — 6720, Kárász utca 9. (HU)',
        'gyor'     => 'Győr — 9022, Baross Gábor út 18. (HU)',
    ];

    public function quote(Request $request)
    {
        $country = strtoupper(trim((string) $request->query('country', 'HU')));
        $method  = (string) $request->query('method', 'card');

        if (!in_array($method, ['card', 'cod', 'pickup'], true)) {
            $method = 'card';
        }

        $countryKeys = array_keys((array) config('countries', []));
        if (!empty($countryKeys) && !in_array($country, $countryKeys, true)) {
            $country = 'HU';
        }

        $request->session()->put('checkout_country', $country);
        $request->session()->put('checkout_payment_method', $method);

        $cart = $this->getCart($request);
        $subtotal = $this->cartSubtotalHuf($cart);

        $percent = $this->getDiscountPercent($request);
        $discountAmount = $this->calculateDiscountHuf($subtotal, $percent);
        $shipping = $this->shippingHuf($country, $method);
        $total = max(0, $subtotal + $shipping - $discountAmount);

        if ($request->expectsJson()) {
            return response()->json([
                'country'          => $country,
                'method'           => $method,
                'currency'         => 'HUF',
                'subtotal'         => $subtotal,
                'shipping'         => $shipping,
                'discount_percent' => $percent,
                'discount_amount'  => $discountAmount,
                'total'            => $total,
            ]);
        }

        return redirect()->route('checkout.show', [
            'country' => $country,
            'method'  => $method,
        ]);
    }

    public function show(Request $request)
    {
        $cart = $this->getCart($request);

>>>>>>> fc7673c (frontend update and some new feature)
        if (empty($cart)) {
            return redirect()->route('store.index')->with('error', 'Your cart is empty.');
        }

<<<<<<< HEAD
        $subtotal = collect($cart)->sum(fn ($item) => $item['price'] * $item['qty']);
        $shipping = 0.0;

        $discountSession = $request->session()->get('discount');
        $percent = isset($discountSession['percent']) ? (float) $discountSession['percent'] : 0.0;
        $percent = max(0, min(100, $percent));

        $discountAmount = $percent > 0 ? round($subtotal * ($percent / 100), 2) : 0.0;
=======
        $subtotal = $this->cartSubtotalHuf($cart);

        $selectedMethod = (string) $request->query(
            'method',
            (string) old(
                'payment_method',
                (string) $request->session()->get('checkout_payment_method', 'card')
            )
        );

        if (!in_array($selectedMethod, ['card', 'cod', 'pickup'], true)) {
            $selectedMethod = 'card';
        }

        $selectedCountry = strtoupper((string) $request->query(
            'country',
            (string) old(
                'country',
                (string) $request->session()->get('checkout_country', 'HU')
            )
        ));

        $countryKeys = array_keys((array) config('countries', []));
        if (!empty($countryKeys) && !in_array($selectedCountry, $countryKeys, true)) {
            $selectedCountry = 'HU';
        }

        $shipping = $this->shippingHuf($selectedCountry, $selectedMethod);
        $percent = $this->getDiscountPercent($request);
        $discountAmount = $this->calculateDiscountHuf($subtotal, $percent);
>>>>>>> fc7673c (frontend update and some new feature)
        $total = max(0, $subtotal + $shipping - $discountAmount);

        return view('checkout.show', compact(
            'cart',
            'subtotal',
            'shipping',
            'total',
            'percent',
<<<<<<< HEAD
            'discountAmount'
=======
            'discountAmount',
            'selectedCountry',
            'selectedMethod'
>>>>>>> fc7673c (frontend update and some new feature)
        ));
    }

    public function place(Request $request)
    {
<<<<<<< HEAD
        $cart = $request->session()->get('cart', []);
=======
        $cart = $this->getCart($request);

>>>>>>> fc7673c (frontend update and some new feature)
        if (empty($cart)) {
            return redirect()->route('store.index')->with('error', 'Your cart is empty.');
        }

<<<<<<< HEAD
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

        // ✅ session discount
        $discountSession = $request->session()->get('discount');
        $discountId = $discountSession['id'] ?? null;

        $percent = isset($discountSession['percent']) ? (float) $discountSession['percent'] : 0.0;
        $percent = max(0, min(100, $percent));

        $discountAmount = $percent > 0 ? round($subtotal * ($percent / 100), 2) : 0.0;
        $total = max(0, $subtotal + $shipping - $discountAmount);

        // 🔴 meglévő pending CARD order újrahasznosítása
        $existingPending = null;
        if ($paymentMethod === 'card') {
            $existingPending = Order::where('user_id', Auth::id())
                ->where('payment_method', 'card')
                ->where('payment_status', 'pending')
                ->whereNull('paid_at')
                ->latest('id')
                ->first();
        }

=======
        $paymentMethod = $this->normalizePaymentMethod((string) $request->input('payment_method', 'card'));
        $request->session()->put('checkout_payment_method', $paymentMethod);

        $validated = $this->validateCheckoutRequest($request, $paymentMethod);
        $validated = $this->normalizeValidatedAddressData($validated, $paymentMethod);

        $subtotal = $this->cartSubtotalHuf($cart);

        $discountSession = $request->session()->get('discount', []);
        $discountId = $discountSession['id'] ?? null;
        $percent = $this->getDiscountPercent($request);
        $discountAmount = $this->calculateDiscountHuf($subtotal, $percent);

        $countryCode = $paymentMethod === 'pickup'
            ? null
            : strtoupper(trim((string) ($validated['country'] ?? 'HU')));

        if ($paymentMethod !== 'pickup') {
            $request->session()->put('checkout_country', $countryCode ?: 'HU');
        }

        $shipping = $this->shippingHuf($countryCode, $paymentMethod);
        $total = max(0, $subtotal + $shipping - $discountAmount);

>>>>>>> fc7673c (frontend update and some new feature)
        try {
            $order = DB::transaction(function () use (
                $cart,
                $validated,
                $subtotal,
                $shipping,
                $total,
<<<<<<< HEAD
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
=======
                $paymentMethod
            ) {
                $order = $this->createOrder($validated, $subtotal, $shipping, $total, $paymentMethod);
                $this->createOrderItemsAndAdjustStock($order, $cart, $paymentMethod);

                if (in_array($paymentMethod, ['pickup', 'cod'], true) && is_null($order->fulfilled_at)) {
                    $order->forceFill(['fulfilled_at' => now()])->save();
>>>>>>> fc7673c (frontend update and some new feature)
                }

                return $order;
            });

<<<<<<< HEAD
            // ✅ COD / PICKUP: itt már “leadott”, töröld a sessiont (CART + DISCOUNT!)
            if ($paymentMethod !== 'card') {
                $order->update(['fulfillment_status' => 'processing']);

                // ✅ FIX: ne csak cart, hanem discount is
                $request->session()->forget(['cart', 'discount']);

                return redirect()->route('checkout.success', ['order_id' => $order->id]);
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
                // ✅ használjuk a named route-ot
                'success_url' => route('checkout.success', ['order_id' => $order->id]),
                'cancel_url'  => route('checkout.show', [], true) . '?cancelled=1',
            ]);
=======
            if ($paymentMethod !== 'card') {
                $order->update(['fulfillment_status' => 'processing']);
                $request->session()->forget(['cart', 'discount']);
                return redirect()->route('checkout.success', ['order_id' => $order->id]);
            }

            $order->load('items');
            $session = $this->createStripeCheckoutSession($order, $discountAmount, $discountId);
>>>>>>> fc7673c (frontend update and some new feature)

            $order->update([
                'stripe_checkout_session_id' => $session->id,
            ]);

            return redirect()->away($session->url);
<<<<<<< HEAD

=======
>>>>>>> fc7673c (frontend update and some new feature)
        } catch (\Exception $e) {
            return back()->with('error', 'Order failed: ' . $e->getMessage());
        }
    }

<<<<<<< HEAD
    /**
     * ✅ STRIPE SUCCESS LANDING
     * Itt kell sessiont takarítani, mert ez a user böngésző requestje.
     */
=======
>>>>>>> fc7673c (frontend update and some new feature)
    public function success(Request $request)
    {
        $orderId = (int) $request->query('order_id');

        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$order) {
            return redirect()->route('store.index')->with('error', 'Order not found.');
        }

<<<<<<< HEAD
        // Ha CARD, akkor lehet hogy a webhook még dolgozik pár pillanatig.
        // Ne töröljünk, amíg nincs tényleg paid.
        if ($order->payment_method === 'card' && $order->payment_status !== 'paid') {
            // (opcionális) itt renderelhetsz egy "Processing payment..." oldalt is
=======
        if ($order->payment_method === 'card' && $order->payment_status !== 'paid') {
            try {
                $stripe = new StripeClient(config('services.stripe.secret'));

                if ($order->stripe_checkout_session_id) {
                    $session = $stripe->checkout->sessions->retrieve($order->stripe_checkout_session_id, []);

                    if (($session->payment_status ?? null) === 'paid') {
                        $order->update([
                            'payment_status' => 'paid',
                            'status' => Order::STATUS_CART,
                            'fulfillment_status' => 'processing',
                        ]);
                    }
                }
            } catch (\Exception $e) {
                // Stripe hiba esetén ne dobjuk el az oldalt
            }
        }

        if ($order->payment_method === 'card' && $order->payment_status !== 'paid') {
>>>>>>> fc7673c (frontend update and some new feature)
            return redirect()->route('orders.index')
                ->with('info', 'Payment is processing. Refresh in a moment.');
        }

<<<<<<< HEAD
        // ✅ itt a lényeg: CART + DISCOUNT törlés
        $request->session()->forget(['cart', 'discount']);
=======
        $request->session()->forget(['cart', 'discount', 'checkout_country', 'checkout_payment_method']);
>>>>>>> fc7673c (frontend update and some new feature)
        $request->session()->regenerate();

        return redirect()->route('orders.index')->with('success', 'Payment successful!');
    }
<<<<<<< HEAD
}
=======

    private function getCart(Request $request): array
    {
        return $request->session()->get('cart', []);
    }

    private function cartSubtotalHuf(array $cart): int
    {
        return (int) collect($cart)->sum(fn ($item) => ((int) $item['price_huf']) * ((int) $item['qty']));
    }

    private function getDiscountPercent(Request $request): float
    {
        $discountSession = $request->session()->get('discount');
        $percent = isset($discountSession['percent']) ? (float) $discountSession['percent'] : 0.0;

        return max(0, min(100, $percent));
    }

    private function calculateDiscountHuf(int $subtotal, float $percent): int
    {
        return $percent > 0 ? (int) round($subtotal * ($percent / 100)) : 0;
    }

    private function shippingHuf(?string $country, string $method): int
    {
        return (int) round(shipping_fee($country, $method));
    }

    private function normalizePaymentMethod(string $paymentMethod): string
    {
        return in_array($paymentMethod, ['card', 'cod', 'pickup'], true)
            ? $paymentMethod
            : 'card';
    }

    private function validateCheckoutRequest(Request $request, string $paymentMethod): array
    {
        $rules = [
            'payment_method' => 'required|in:card,cod,pickup',
            'full_name'      => 'required|string|max:255',
            'address_line2'  => 'nullable|string|max:255',
        ];

        if ($paymentMethod === 'pickup') {
            $rules['pickup_location'] = 'required|in:' . implode(',', array_keys(self::PICKUP_POINTS));
        } else {
            $countryKeys = array_keys((array) config('countries', []));
            $countryIn = !empty($countryKeys) ? ('|in:' . implode(',', $countryKeys)) : '';

            $rules = array_merge($rules, [
                'address_line1'   => 'required|string|max:255',
                'city'            => 'required|string|max:255',
                'postal_code'     => 'required|string|max:20',
                'country'         => 'required|string|size:2' . $countryIn,
                'pickup_location' => 'nullable',
            ]);
        }

        return $request->validate($rules);
    }

    private function normalizeValidatedAddressData(array $validated, string $paymentMethod): array
    {
        if ($paymentMethod === 'pickup') {
            $validated['address_line1'] = null;
            $validated['address_line2'] = null;
            $validated['city'] = null;
            $validated['postal_code'] = null;
            $validated['country'] = null;
        }

        return $validated;
    }

    private function createOrder(
        array $validated,
        int $subtotal,
        int $shipping,
        int $total,
        string $paymentMethod
    ): Order {
        return Order::create([
            'user_id' => Auth::id(),

            'status'  => $paymentMethod === 'card'
                ? Order::STATUS_PENDING_PAYMENT
                : Order::STATUS_CART,

            'payment_method'     => $paymentMethod,
            'payment_status'     => $paymentMethod === 'card' ? 'pending' : 'unpaid',
            'fulfillment_status' => 'new',

            'currency' => 'HUF',
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total'    => $total,

            'full_name'     => $validated['full_name'],
            'address_line1' => $validated['address_line1'] ?? null,
            'address_line2' => $validated['address_line2'] ?? null,
            'city'          => $validated['city'] ?? null,
            'postal_code'   => $validated['postal_code'] ?? null,
            'country'       => isset($validated['country'])
                ? strtoupper((string) $validated['country'])
                : null,

            'pickup_location' => $paymentMethod === 'pickup'
                ? $validated['pickup_location']
                : null,
        ]);
    }

    private function createOrderItemsAndAdjustStock(Order $order, array $cart, string $paymentMethod): void
    {
        foreach ($cart as $item) {
            $product = Product::where('id', $item['product_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($product->is_active === false) {
                throw new \Exception("Product {$product->name} is inactive.");
            }

            $qty = (int) $item['qty'];

            if (!is_null($product->stock) && $product->stock < $qty) {
                throw new \Exception("Product {$product->name} not available.");
            }

            if (in_array($paymentMethod, ['pickup', 'cod'], true) && !is_null($product->stock)) {
                $product->stock = (int) $product->stock - $qty;
                $product->save();
            }

            $unitPriceHuf = (int) $product->price_huf;
            $lineTotalHuf = $unitPriceHuf * $qty;

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product->id,
                'name'       => $product->name,
                'unit_price' => $unitPriceHuf,
                'qty'        => $qty,
                'line_total' => $lineTotalHuf,
            ]);
        }
    }

    private function createStripeCheckoutSession(Order $order, int $discountAmount, ?int $discountId)
{
    $stripe = new StripeClient(config('services.stripe.secret'));

    $locale = app()->getLocale() === 'hu' ? 'hu' : 'en';

    $items = $order->items->map(function ($it) {
        return [
            'name' => $it->name,
            'unit_price' => (int) $it->unit_price,
            'qty' => (int) $it->qty,
            'line_total' => (int) $it->line_total,
        ];
    })->values()->all();

    $subtotal = (int) $order->subtotal;
    $shipping = (int) $order->shipping;
    $discount = max(0, (int) $discountAmount);

    $lineItems = [];

    if ($subtotal > 0) {
        $allocatedDiscount = 0;
        $lastIndex = count($items) - 1;

        foreach ($items as $index => $item) {
            $itemLineTotal = $item['line_total'];

            if ($discount > 0 && $subtotal > 0) {
                if ($index === $lastIndex) {
                    $itemDiscount = $discount - $allocatedDiscount;
                } else {
                    $itemDiscount = (int) floor(($itemLineTotal / $subtotal) * $discount);
                    $allocatedDiscount += $itemDiscount;
                }
            } else {
                $itemDiscount = 0;
            }

            $discountedLineTotal = max(0, $itemLineTotal - $itemDiscount);
            $unitAmount = $item['qty'] > 0
                ? (int) floor($discountedLineTotal / $item['qty'])
                : 0;

            $remainder = $discountedLineTotal - ($unitAmount * $item['qty']);

            if ($remainder > 0) {
                if (($item['qty'] - 1) > 0) {
                    $lineItems[] = [
                        'price_data' => [
                            'currency' => 'huf',
                            'product_data' => [
                                'name' => $item['name'],
                            ],
                            'unit_amount' => $unitAmount * 100,
                        ],
                        'quantity' => $item['qty'] - 1,
                    ];
                }

                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'huf',
                        'product_data' => [
                            'name' => $item['name'],
                        ],
                        'unit_amount' => ($unitAmount + $remainder) * 100,
                    ],
                    'quantity' => 1,
                ];
            } else {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'huf',
                        'product_data' => [
                            'name' => $item['name'],
                        ],
                        'unit_amount' => $unitAmount * 100,
                    ],
                    'quantity' => $item['qty'],
                ];
            }
        }
    }

    if ($shipping > 0) {
        $lineItems[] = [
            'price_data' => [
                'currency' => 'huf',
                'product_data' => [
                    'name' => __('checkout.shipping'),
                ],
                'unit_amount' => $shipping * 100,
            ],
            'quantity' => 1,
        ];
    }

    $lineItems = array_values(array_filter($lineItems, function ($item) {
        return ($item['quantity'] ?? 0) > 0
            && (($item['price_data']['unit_amount'] ?? 0) > 0);
    }));

    return $stripe->checkout->sessions->create([
        'mode' => 'payment',
        'payment_method_types' => ['card'],
        'locale' => $locale,
        'line_items' => $lineItems,
        'metadata' => [
            'order_id'    => (string) $order->id,
            'user_id'     => (string) $order->user_id,
            'discount_id' => $discountId ? (string) $discountId : '',
            'country'     => (string) ($order->country ?? ''),
            'shipping'    => (string) ($order->shipping ?? 0),
        ],
        'success_url' => route('checkout.success', ['order_id' => $order->id]),
        'cancel_url'  => route('checkout.show', [], true) . '?cancelled=1',
    ]);
    }
}
>>>>>>> fc7673c (frontend update and some new feature)
