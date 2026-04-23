<?php

namespace Tests\Unit;

use App\Models\ProductType;
use Tests\TestCase;

class ProductTypeTest extends TestCase
{
    public function test_translated_name_uses_hungarian_name_when_locale_is_hu(): void
    {
        app()->setLocale('hu');

        $type = new ProductType();
        $type->name = 'Supplements';
        $type->name_hu = 'Kiegészítők';

        $this->assertSame('Kiegészítők', $type->translated_name);
    }
}
