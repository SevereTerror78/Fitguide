<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_loads_with_expected_view_data(): void
    {
        $this->withoutMiddleware();

        $type = ProductType::query()->create([
            'name' => 'Supplements',
            'name_hu' => 'Supplements',
            'slug' => 'supplements',
        ]);

        $user = User::factory()->create();

        Product::query()->create([
            'name' => 'Whey',
            'name_hu' => 'Whey',
            'price_huf' => 10000,
            'stock' => 0,
            'product_type_id' => $type->id,
            'is_active' => true,
        ]);

        Order::query()->create([
            'user_id' => $user->id,
            'status' => 'paid',
            'payment_method' => 'pickup',
            'payment_status' => 'paid',
            'fulfillment_status' => 'processing',
            'currency' => 'HUF',
            'subtotal' => 10000,
            'shipping' => 0,
            'total' => 10000,
            'full_name' => 'Teszt Elek',
        ]);

        $this->get(route('admin.dashboard'))
            ->assertOk()
            ->assertViewIs('admin.dashboard')
            ->assertViewHasAll([
                'salesToday',
                'activeProducts',
                'outOfStock',
                'activeUsers',
                'recentOrders',
                'chartLabels',
                'chartValues',
            ]);
    }
}
