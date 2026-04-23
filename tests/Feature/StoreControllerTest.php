<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreControllerTest extends TestCase
{
    use RefreshDatabase;

    private function makeType(string $name = 'Supplements', string $slug = 'supplements'): ProductType
    {
        return ProductType::query()->create([
            'name' => $name,
            'name_hu' => $name,
            'slug' => $slug,
        ]);
    }

    public function test_store_index_loads(): void
    {
        $type = $this->makeType();

        Product::query()->create([
            'name' => 'Whey',
            'name_hu' => 'Whey',
            'description' => 'Protein',
            'description_hu' => 'Protein',
            'price_huf' => 10000,
            'stock' => 5,
            'product_type_id' => $type->id,
            'is_active' => true,
        ]);

        $this->get(route('store.index'))
            ->assertOk()
            ->assertViewIs('store.index')
            ->assertViewHas('products')
            ->assertViewHas('productTypes');
    }

    public function test_store_ajax_returns_partial_view(): void
    {
        $type = $this->makeType();
        Product::query()->create([
            'name' => 'Bar',
            'name_hu' => 'Bar',
            'description' => 'Snack',
            'description_hu' => 'Snack',
            'price_huf' => 1200,
            'stock' => 5,
            'product_type_id' => $type->id,
            'is_active' => true,
        ]);

        $this->get(route('store.index', ['ajax' => 1]), ['X-Requested-With' => 'XMLHttpRequest'])
            ->assertOk();
    }
}
