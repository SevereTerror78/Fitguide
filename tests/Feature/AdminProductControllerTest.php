<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProductControllerTest extends TestCase
{
    use RefreshDatabase;

    private function type(): ProductType
    {
        return ProductType::query()->create([
            'name' => 'Supplements',
            'name_hu' => 'Supplements',
            'slug' => 'supplements',
        ]);
    }

    public function test_admin_products_index_loads(): void
    {
        $this->withoutMiddleware();

        $type = $this->type();

        Product::query()->create([
            'name' => 'Whey',
            'name_hu' => 'Whey',
            'price_huf' => 10000,
            'stock' => 5,
            'product_type_id' => $type->id,
            'is_active' => true,
        ]);

        $this->get(route('admin.products.index'))
            ->assertOk()
            ->assertViewIs('admin.products.index')
            ->assertViewHas('products');
    }

    public function test_admin_can_store_product_and_create_low_stock_notification(): void
    {
        $this->withoutMiddleware();

        $type = $this->type();

        $this->post(route('admin.products.store'), [
            'name' => 'Creatine',
            'price_huf' => 5990,
            'stock' => 3,
            'product_type_id' => $type->id,
        ])->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', [
            'name' => 'Creatine',
        ]);

        $this->assertDatabaseHas('admin_notifications', [
            'type' => 'low_stock',
        ]);
    }

    public function test_admin_can_update_product(): void
    {
        /** @var User $admin */
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $type = $this->type();

        $product = Product::query()->create([
            'name' => 'Old',
            'name_hu' => 'Old',
            'price_huf' => 5000,
            'stock' => 20,
            'product_type_id' => $type->id,
            'is_active' => true,
        ]);

        $this->actingAs($admin)
            ->put(route('admin.products.update', $product), [
                'name' => 'New',
                'name_hu' => 'Új',
                'description' => 'Desc',
                'description_hu' => 'Leírás',
                'price_huf' => 7000,
                'stock' => 7,
                'product_type_id' => $type->id,
                'is_active' => 1,
            ])
            ->assertRedirect(route('admin.products.index'));

        $this->assertSame('New', $product->fresh()->name);
    }
}