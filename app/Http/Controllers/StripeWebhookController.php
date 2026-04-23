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

        if (StripeWebhookEvent::where('event_id', $event->id)->exists()) {
            return response()->json(['ok' => true]);
        }

        $order = null;

        if (isset($event->data->object->metadata->order_id)) {
            $orderId = (int) $event->data->object->metadata->order_id;
            $order = Order::with(['items', 'user'])->find($orderId);
        }

        try {
            switch ($event->type) {
                case 'checkout.session.completed': {
                    if (!$order) {
                        break;
                    }

                    $session = $event->data->object;
                    $paymentIntentId = $session->payment_intent ?? null;

                    $discountId = null;
                    if (isset($session->metadata->discount_id) && $session->metadata->discount_id !== '') {
                        $discountId = (int) $session->metadata->discount_id;
                    }

                    DB::transaction(function () use ($order, $session, $paymentIntentId, $discountId) {
                        if ($order->status !== 'paid' || $order->payment_status !== 'paid') {
                            $order->forceFill([
                                'status' => 'paid',
                                'payment_method' => $order->payment_method ?: 'card',
                                'payment_status' => 'paid',
                                'fulfillment_status' => $order->fulfillment_status === 'new'
                                    ? 'processing'
                                    : ($order->fulfillment_status ?: 'processing'),
                                'stripe_checkout_session_id' => $session->id ?? $order->stripe_checkout_session_id,
                                'stripe_payment_intent_id' => $paymentIntentId ?? $order->stripe_payment_intent_id,
                                'paid_at' => now(),
                                'payment_failed_at' => null,
                                'payment_last_error' => null,
                            ])->save();
                        }

                        $order->refresh();

                        if (!is_null($order->fulfilled_at)) {
                            return;
                        }

                        if ($discountId) {
                            $discount = Discount::where('id', $discountId)
                                ->where('user_id', $order->user_id)
                                ->lockForUpdate()
                                ->first();

                            if ($discount && $discount->isValid()) {
                                $discount->update(['usedOrNot' => true]);
                            }
                        }

                        foreach ($order->items as $item) {
                            $product = Product::lockForUpdate()->find($item->product_id);

                            if (!$product) {
                                continue;
                            }

                            if (!is_null($product->stock) && $product->stock < $item->qty) {
                                throw new \Exception("Stock mismatch for product_id={$item->product_id}");
                            }

                            if (!is_null($product->stock)) {
                                $product->decrement('stock', $item->qty);
                            }
                        }

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

                        $order->forceFill([
                            'fulfilled_at' => now(),
                        ])->save();
                    });

                    break;
                }

                case 'payment_intent.payment_failed': {
                    if (!$order) {
                        break;
                    }

                    $pi = $event->data->object;

                    if ($order->status !== 'paid' && $order->payment_status !== 'paid') {
                        $order->forceFill([
                            'status' => 'failed',
                            'payment_status' => 'failed',
                            'fulfillment_status' => 'cancelled',
                            'stripe_payment_intent_id' => $pi->id ?? $order->stripe_payment_intent_id,
                            'payment_failed_at' => now(),
                            'payment_last_error' => $pi->last_payment_error->message ?? 'Payment failed',
                        ])->save();
                    }

                    break;
                }

                case 'checkout.session.expired': {
                    if (!$order) {
                        break;
                    }

                    if ($order->status !== 'paid' && $order->payment_status !== 'paid') {
                        $order->forceFill([
                            'status' => 'failed',
                            'payment_status' => 'failed',
                            'fulfillment_status' => 'cancelled',
                            'payment_failed_at' => now(),
                            'payment_last_error' => 'Checkout session expired',
                        ])->save();
                    }

                    break;
                }

                default:
                    break;
            }
        } finally {
            StripeWebhookEvent::create([
                'event_id'     => $event->id,
                'type'         => $event->type,
                'order_id'     => $order?->id,
                'processed_at' => now(),
                'payload'      => json_decode($payload, true),
            ]);
        }

        return response()->json(['ok' => true]);
    }
}