<?php

namespace Tests\Unit;

use App\Models\Discount;
use Carbon\Carbon;
use Tests\TestCase;

class DiscountTest extends TestCase
{
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
        $discount = new Discount();
        $discount->discountAmount = 10;
        $discount->save();

        $this->assertNotEmpty($discount->discountCode);
        $this->assertSame(10, strlen($discount->discountCode));
    }
}
