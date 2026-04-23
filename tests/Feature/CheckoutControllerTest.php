<?php

namespace Tests\Feature;

use App\Mail\OrderPlaced;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CheckoutControllerTest extends TestCase
{
    use RefreshDatabase;

   protected function setUp(): void
    {
        parent::setUp();
    }

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

    public function test_quote_returns_json_summary(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $this->actingAs($user)
            ->withSession([
                'cart' => [
                    1 => [
                        'product_id' => 1,
                        'name' => 'X',
                        'price_huf' => 10000,
                        'qty' => 2,
                    ],
                ],
            ])
            ->getJson(route('checkout.quote', ['country' => 'HU', 'method' => 'card']))
            ->assertOk()
            ->assertJsonPath('subtotal', 20000)
            ->assertJsonPath('shipping', 762);
    }

    public function test_show_redirects_when_cart_is_empty(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $this->actingAs($user)
            ->withSession(['cart' => []])
            ->get(route('checkout.show'))
            ->assertRedirect(route('store.index'));
    }

    public function test_user_can_place_pickup_order(): void
    {
        Mail::fake();

        /** @var \App\Models\User $user */
        $user = User::factory()->create(['language' => 'hu']);
        $product = $this->makeProduct(['stock' => 5]);

        $response = $this->actingAs($user)
            ->withSession([
                'cart' => [
                    $product->id => [
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'price_huf' => 10000,
                        'qty' => 2,
                    ],
                ],
            ])
            ->post(route('checkout.place'), [
                'payment_method' => 'pickup',
                'full_name' => 'Teszt Elek',
                'pickup_location' => 'budapest',
            ]);

        $order = Order::query()->latest('id')->first();

        $response->assertRedirect(route('checkout.success', ['order_id' => $order->id]));
        $this->assertNotNull($order);
        $this->assertSame('pickup', $order->payment_method);
        $this->assertSame('processing', $order->fresh()->fulfillment_status);
        $this->assertSame(3, $product->fresh()->stock);

        Mail::assertSent(OrderPlaced::class);
    }
}