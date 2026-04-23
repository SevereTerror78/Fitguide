<?php

namespace Tests\Feature;

use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    use RefreshDatabase;

    private function makeProduct(array $overrides = []): Product
    {
        $type = ProductType::query()->create([
            'name' => 'Supplements',
            'name_hu' => 'Supplements',
            'slug' => 'supplements',
        ]);

        return Product::query()->create(array_merge([
            'name' => 'Whey',
            'name_hu' => 'Whey',
            'description' => 'Protein',
            'description_hu' => 'Protein',
            'price_huf' => 10000,
            'stock' => 10,
            'product_type_id' => $type->id,
            'is_active' => true,
        ], $overrides));
    }

    public function test_cart_index_loads_for_authenticated_user(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->withSession(['cart' => []])
            ->get(route('cart.index'))
            ->assertOk()
            ->assertViewIs('cart.index');
    }

    public function test_user_can_add_product_to_cart_via_json(): void
    {
        $user = User::factory()->create();
        $product = $this->makeProduct();

        $this->actingAs($user)
            ->postJson(route('cart.add', $product), ['qty' => 2])
            ->assertOk()
            ->assertJson(['ok' => true, 'count' => 2]);

        $this->assertSame(2, session('cart')[$product->id]['qty']);
    }

    public function test_user_cannot_add_inactive_product(): void
    {
        $user = User::factory()->create();
        $product = $this->makeProduct(['is_active' => false]);

        $this->actingAs($user)
            ->postJson(route('cart.add', $product), ['qty' => 1])
            ->assertStatus(422)
            ->assertJson(['ok' => false]);
    }

    public function test_user_can_update_cart_quantity(): void
    {
        $user = User::factory()->create();
        $product = $this->makeProduct();

        $session = [
            'cart' => [
                $product->id => [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price_huf' => 10000,
                    'qty' => 1,
                ],
            ],
        ];

        $this->actingAs($user)
            ->withSession($session)
            ->postJson(route('cart.update', $product), ['qty' => 3])
            ->assertOk()
            ->assertJson(['ok' => true, 'qty' => 3]);
    }

    public function test_user_can_remove_discount_from_session(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->withSession([
                'cart' => [],
                'discount' => ['code' => 'ABC'],
            ])
            ->postJson(route('cart.discount.remove'))
            ->assertOk()
            ->assertJson(['ok' => true]);

        $this->assertNull(session('discount'));
    }

    public function test_user_can_apply_valid_discount_code(): void
    {
        $user = User::factory()->create();

        Discount::query()->create([
            'user_id' => $user->id,
            'discountCode' => 'SAVE10',
            'discountAmount' => 10,
            'usedOrNot' => false,
            'expiryDate' => now()->addDays(10),
        ]);

        $this->actingAs($user)
            ->withSession([
                'cart' => [
                    1 => ['product_id' => 1, 'name' => 'X', 'price_huf' => 10000, 'qty' => 1],
                ],
            ])
            ->postJson(route('cart.discount.apply'), ['code' => 'SAVE10'])
            ->assertOk()
            ->assertJson(['ok' => true, 'percent' => 10.0]);
    }
}
