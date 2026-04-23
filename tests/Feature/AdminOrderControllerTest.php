<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminOrderControllerTest extends TestCase
{
    use RefreshDatabase;

    private function makeOrder(User $user, array $overrides = []): Order
    {
        return Order::create(array_merge([
            'user_id' => $user->id,
            'status' => Order::STATUS_PENDING_PAYMENT,
            'payment_method' => 'card',
            'payment_status' => 'pending',
            'fulfillment_status' => 'new',
            'currency' => 'HUF',
            'subtotal' => 10000,
            'shipping' => 1500,
            'total' => 11500,
            'full_name' => 'Teszt Elek',
            'address_line1' => 'Fő utca 1.',
            'city' => 'Budapest',
            'postal_code' => '1111',
            'country' => 'Hungary',
        ], $overrides));
    }

    public function test_admin_orders_index_loads(): void
    {
        $this->withoutMiddleware();

        $user = User::factory()->create();
        $this->makeOrder($user);

        $this->get(route('admin.orders.index'))
            ->assertOk()
            ->assertViewIs('admin.orders.index')
            ->assertViewHas('orders');
    }

    public function test_admin_can_mark_order_paid(): void
    {
        /** @var User $admin */
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        /** @var User $user */
        $user = User::factory()->create([
            'points' => 0,
        ]);

        $order = $this->makeOrder($user, [
            'status' => Order::STATUS_PENDING_PAYMENT,
            'payment_status' => 'pending',
        ]);

        $this->actingAs($admin)
            ->put(route('admin.orders.status', $order), [
                'payment_status' => 'paid',
            ])
            ->assertRedirect();

        $fresh = $order->fresh();

        $this->assertSame('paid', $fresh->payment_status);
        $this->assertSame('paid', $fresh->status);
        $this->assertNotNull($fresh->paid_at);
    }

    public function test_admin_can_mark_order_failed(): void
    {
        /** @var User $admin */
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        /** @var User $user */
        $user = User::factory()->create();

        $order = $this->makeOrder($user, [
            'payment_status' => 'pending',
        ]);

        $this->actingAs($admin)
            ->put(route('admin.orders.status', $order), [
                'payment_status' => 'failed',
            ])
            ->assertRedirect();

        $fresh = $order->fresh();

        $this->assertSame('failed', $fresh->payment_status);
        $this->assertSame('failed', $fresh->status);
        $this->assertNotNull($fresh->payment_failed_at);
    }

    public function test_admin_sets_fulfilled_at_when_order_is_delivered(): void
    {
        /** @var User $admin */
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        /** @var User $user */
        $user = User::factory()->create();

        $order = $this->makeOrder($user, [
            'payment_status' => 'paid',
            'status' => 'paid',
            'fulfillment_status' => 'processing',
        ]);

        $this->actingAs($admin)
            ->put(route('admin.orders.status', $order), [
                'fulfillment_status' => 'delivered',
            ])
            ->assertRedirect();

        $fresh = $order->fresh();

        $this->assertSame('delivered', $fresh->fulfillment_status);
        $this->assertNotNull($fresh->fulfilled_at);
    }
}