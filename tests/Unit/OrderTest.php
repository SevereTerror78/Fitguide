<?php

namespace Tests\Unit;

use App\Models\Order;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function test_is_fulfilled_returns_false_when_fulfilled_at_is_null(): void
    {
        $order = new Order(['fulfilled_at' => null]);
        $this->assertFalse($order->isFulfilled());
    }

    public function test_is_fulfilled_returns_true_when_fulfilled_at_is_set(): void
    {
        $order = new Order(['fulfilled_at' => now()]);
        $this->assertTrue($order->isFulfilled());
    }

    public function test_user_can_cancel_pickup_order_with_new_status(): void
    {
        $order = new Order([
            'payment_method' => 'pickup',
            'fulfillment_status' => 'new',
        ]);

        $this->assertTrue($order->canBeCancelledByUser());
    }

    public function test_user_can_cancel_cod_order_with_processing_status(): void
    {
        $order = new Order([
            'payment_method' => 'cod',
            'fulfillment_status' => 'processing',
        ]);

        $this->assertTrue($order->canBeCancelledByUser());
    }

    public function test_user_cannot_cancel_card_order(): void
    {
        $order = new Order([
            'payment_method' => 'card',
            'fulfillment_status' => 'new',
        ]);

        $this->assertFalse($order->canBeCancelledByUser());
    }

    public function test_user_cannot_cancel_order_in_disallowed_fulfillment_state(): void
    {
        $order = new Order([
            'payment_method' => 'pickup',
            'fulfillment_status' => 'shipped',
        ]);

        $this->assertFalse($order->canBeCancelledByUser());
    }
}
