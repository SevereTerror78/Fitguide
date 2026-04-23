<?php

namespace Tests\Unit;

use App\Models\Discount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DiscountTest extends TestCase
{
    use RefreshDatabase;

    public function test_discount_is_valid_when_unused_and_not_expired(): void
    {
        $discount = new Discount([
            'usedOrNot' => false,
            'expiryDate' => Carbon::tomorrow(),
        ]);

        $this->assertTrue($discount->isValid());
    }

    public function test_discount_is_invalid_when_used(): void
    {
        $discount = new Discount([
            'usedOrNot' => true,
            'expiryDate' => Carbon::tomorrow(),
        ]);

        $this->assertFalse($discount->isValid());
    }

    public function test_discount_is_invalid_when_expired(): void
    {
        $discount = new Discount([
            'usedOrNot' => false,
            'expiryDate' => Carbon::yesterday(),
        ]);

        $this->assertFalse($discount->isValid());
    }

    public function test_discount_generates_code_when_missing_on_create(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $discount = Discount::create([
            'user_id' => $user->id,
            'discountAmount' => 10,
            'usedOrNot' => false,
        ]);

        $this->assertNotEmpty($discount->discountCode);
        $this->assertSame(10, strlen($discount->discountCode));
    }
}