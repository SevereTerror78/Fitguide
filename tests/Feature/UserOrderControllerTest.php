<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserOrderControllerTest extends TestCase
{
    use RefreshDatabase;

    private function makeOrderFor(User $user, array $overrides = []): Order
    {
        return Order::query()->create(array_merge([
            'user_id' => $user->id,
            'status' => Order::STATUS_PAID,
            'payment_method' => 'pickup',
            'payment_status' => 'paid',
            'fulfillment_status' => 'new',
            'currency' => 'HUF',
            'subtotal' => 10000,
            'shipping' => 0,
            'total' => 10000,
            'full_name' => 'Teszt Elek',
            'address_line1' => 'Fő utca 1.',
            'city' => 'Budapest',
            'postal_code' => '1111',
            'country' => 'HU',
        ], $overrides));
    }

    public function test_user_can_view_own_order(): void
    {
        $user = User::factory()->create();
        $order = $this->makeOrderFor($user);

        $this->actingAs($user)
            ->get(route('orders.show', $order))
            ->assertOk()
            ->assertViewIs('orders.show');
    }

    public function test_user_cannot_view_someone_elses_order(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $order = $this->makeOrderFor($owner);

        $this->actingAs($other)
            ->get(route('orders.show', $order))
            ->assertForbidden();
    }

    public function test_user_can_cancel_allowed_order(): void
    {
        $user = User::factory()->create();
        $order = $this->makeOrderFor($user, [
            'payment_method' => 'pickup',
            'fulfillment_status' => 'new',
        ]);

        $this->actingAs($user)
            ->patch(route('orders.cancel', $order))
            ->assertRedirect();

        $this->assertSame('cancelled', $order->fresh()->fulfillment_status);
    }
}
