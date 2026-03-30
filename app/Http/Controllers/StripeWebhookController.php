<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Product;
use App\Models\StripeWebhookEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        $secret = config('services.stripe.webhook_secret');
        if (!$secret) {
            return response()->json(['error' => 'Missing STRIPE_WEBHOOK_SECRET'], 500);
        }

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);
        } catch (\UnexpectedValueException $e) {
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

<<<<<<< HEAD
<<<<<<< HEAD
        // event-idempotencia (gyors kilépés)
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
        if (StripeWebhookEvent::where('event_id', $event->id)->exists()) {
            return response()->json(['ok' => true]);
        }

        $order = null;

<<<<<<< HEAD
<<<<<<< HEAD
        // Order betöltés metadata-ból
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
        if (isset($event->data->object->metadata->order_id)) {
            $orderId = (int) $event->data->object->metadata->order_id;
            $order = Order::with(['items', 'user'])->find($orderId);
        }

        try {
            switch ($event->type) {
<<<<<<< HEAD
<<<<<<< HEAD

                case 'checkout.session.completed': {
                    if (!$order) break;
=======
=======
>>>>>>> 5c55d34 (new features)
                case 'checkout.session.completed': {
                    if (!$order) {
                        break;
                    }
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)

                    $session = $event->data->object;
                    $paymentIntentId = $session->payment_intent ?? null;

<<<<<<< HEAD
<<<<<<< HEAD
                    // ✅ discount metadata
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
                    $discountId = null;
                    if (isset($session->metadata->discount_id) && $session->metadata->discount_id !== '') {
                        $discountId = (int) $session->metadata->discount_id;
                    }

                    DB::transaction(function () use ($order, $session, $paymentIntentId, $discountId) {
<<<<<<< HEAD
<<<<<<< HEAD

                        // 1) ✅ paid állapot (régi + új mezők)
                        if ($order->status !== 'paid' || $order->payment_status !== 'paid') {
                            $order->forceFill([
                                'status' => 'paid',

                                // ✅ ÚJ mezők
=======
                        if ($order->status !== 'paid' || $order->payment_status !== 'paid') {
                            $order->forceFill([
                                'status' => 'paid',
>>>>>>> fc7673c (frontend update and some new feature)
=======
                        if ($order->status !== 'paid' || $order->payment_status !== 'paid') {
                            $order->forceFill([
                                'status' => 'paid',
>>>>>>> 5c55d34 (new features)
                                'payment_method' => $order->payment_method ?: 'card',
                                'payment_status' => 'paid',
                                'fulfillment_status' => $order->fulfillment_status === 'new'
                                    ? 'processing'
                                    : ($order->fulfillment_status ?: 'processing'),
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
                                'stripe_checkout_session_id' => $session->id ?? $order->stripe_checkout_session_id,
                                'stripe_payment_intent_id' => $paymentIntentId ?? $order->stripe_payment_intent_id,
                                'paid_at' => now(),
                                'payment_failed_at' => null,
                                'payment_last_error' => null,
                            ])->save();
                        }

<<<<<<< HEAD
<<<<<<< HEAD
                        // 2) teljesítés csak egyszer
                        $order->refresh();
                        if (!is_null($order->fulfilled_at)) {
                            return; // már lefutott készlet/email/pont
                        }

                        // 3) ✅ DISCOUNT ELÉGETÉS (csak sikeres fizetés után)
=======
=======
>>>>>>> 5c55d34 (new features)
                        $order->refresh();

                        if (!is_null($order->fulfilled_at)) {
                            return;
                        }

<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
                        if ($discountId) {
                            $discount = Discount::where('id', $discountId)
                                ->where('user_id', $order->user_id)
                                ->lockForUpdate()
                                ->first();

                            if ($discount && $discount->isValid()) {
                                $discount->update(['usedOrNot' => true]);
                            }
                        }

<<<<<<< HEAD
<<<<<<< HEAD
                        // 4) Készlet csökkentés (safe)
                        foreach ($order->items as $item) {
                            $product = Product::lockForUpdate()->find($item->product_id);
                            if (!$product) continue;
=======
=======
>>>>>>> 5c55d34 (new features)
                        foreach ($order->items as $item) {
                            $product = Product::lockForUpdate()->find($item->product_id);

                            if (!$product) {
                                continue;
                            }
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)

                            if (!is_null($product->stock) && $product->stock < $item->qty) {
                                throw new \Exception("Stock mismatch for product_id={$item->product_id}");
                            }

                            if (!is_null($product->stock)) {
                                $product->decrement('stock', $item->qty);
                            }
                        }

<<<<<<< HEAD
<<<<<<< HEAD
                        // 5) Pont (paid után)
                        $order->awardPointsIfEligible();

                        // 6) Email (paid után)
=======
                        $order->awardPointsIfEligible();

>>>>>>> fc7673c (frontend update and some new feature)
                        Mail::to($order->user->email)->send(
                            new OrderPlaced(
                                $order->items->map(fn ($i) => [
                                    'product_id' => $i->product_id,
<<<<<<< HEAD
                                    'name' => $i->name,
                                    'price' => (float) $i->unit_price,
                                    'qty' => (int) $i->qty,
                                ])->toArray(),
                                (float) $order->subtotal,
                                (float) $order->shipping,
                                (float) $order->total,
=======
                                    'name'       => $i->name,
                                    'price'      => (int) $i->unit_price,
                                    'qty'        => (int) $i->qty,
                                ])->toArray(),
                                (int) $order->subtotal,
                                (int) $order->shipping,
                                (int) $order->total,
>>>>>>> fc7673c (frontend update and some new feature)
                                $order
                            )
                        );

<<<<<<< HEAD
                        // 7) teljesítve (nálad ez “lezárás”, maradhat)
=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
                        $order->awardPointsIfEligible();

                        Mail::to($order->user->email)
                            ->locale($order->user->language ?? 'hu')
                            ->send(
                                new OrderPlaced(
                                    $order->items->map(fn ($i) => [
                                        'product_id' => $i->product_id,
                                        'name'       => $i->name,
                                        'price'      => (int) $i->unit_price,
                                        'qty'        => (int) $i->qty,
                                    ])->toArray(),
                                    (int) $order->subtotal,
                                    (int) $order->shipping,
                                    (int) $order->total,
                                    $order
                                )
                            );

>>>>>>> 5c55d34 (new features)
                        $order->forceFill([
                            'fulfilled_at' => now(),
                        ])->save();
                    });

                    break;
                }

                case 'payment_intent.payment_failed': {
<<<<<<< HEAD
<<<<<<< HEAD
                    if (!$order) break;

                    $pi = $event->data->object;

                    // ✅ failed állapot (régi + új mezők)
                    if ($order->status !== 'paid' && $order->payment_status !== 'paid') {
                        $order->forceFill([
                            'status' => 'failed',

                            // ✅ ÚJ mezők
                            'payment_status' => 'failed',
                            'fulfillment_status' => 'cancelled',

=======
=======
>>>>>>> 5c55d34 (new features)
                    if (!$order) {
                        break;
                    }

                    $pi = $event->data->object;

                    if ($order->status !== 'paid' && $order->payment_status !== 'paid') {
                        $order->forceFill([
                            'status' => 'failed',
                            'payment_status' => 'failed',
                            'fulfillment_status' => 'cancelled',
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
                            'stripe_payment_intent_id' => $pi->id ?? $order->stripe_payment_intent_id,
                            'payment_failed_at' => now(),
                            'payment_last_error' => $pi->last_payment_error->message ?? 'Payment failed',
                        ])->save();
                    }

                    break;
                }

                case 'checkout.session.expired': {
<<<<<<< HEAD
<<<<<<< HEAD
                    if (!$order) break;
=======
                    if (!$order) {
                        break;
                    }
>>>>>>> fc7673c (frontend update and some new feature)
=======
                    if (!$order) {
                        break;
                    }
>>>>>>> 5c55d34 (new features)

                    if ($order->status !== 'paid' && $order->payment_status !== 'paid') {
                        $order->forceFill([
                            'status' => 'failed',
<<<<<<< HEAD
<<<<<<< HEAD

                            // ✅ ÚJ mezők
                            'payment_status' => 'failed',
                            'fulfillment_status' => 'cancelled',

=======
                            'payment_status' => 'failed',
                            'fulfillment_status' => 'cancelled',
>>>>>>> fc7673c (frontend update and some new feature)
=======
                            'payment_status' => 'failed',
                            'fulfillment_status' => 'cancelled',
>>>>>>> 5c55d34 (new features)
                            'payment_failed_at' => now(),
                            'payment_last_error' => 'Checkout session expired',
                        ])->save();
                    }

                    break;
                }

                default:
                    break;
            }
<<<<<<< HEAD
<<<<<<< HEAD

        } finally {
            // ✅ minden esetben logoljuk az eventet (idempotencia)
            StripeWebhookEvent::create([
                'event_id' => $event->id,
                'type' => $event->type,
                'order_id' => $order?->id,
                'processed_at' => now(),
                'payload' => json_decode($payload, true),
=======
=======
>>>>>>> 5c55d34 (new features)
        } finally {
            StripeWebhookEvent::create([
                'event_id'     => $event->id,
                'type'         => $event->type,
                'order_id'     => $order?->id,
                'processed_at' => now(),
                'payload'      => json_decode($payload, true),
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
            ]);
        }

        return response()->json(['ok' => true]);
    }
<<<<<<< HEAD
<<<<<<< HEAD
}
=======
}
>>>>>>> fc7673c (frontend update and some new feature)
=======
}
>>>>>>> 5c55d34 (new features)
