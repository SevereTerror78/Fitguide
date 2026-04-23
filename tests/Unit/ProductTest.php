<?php

namespace Tests\Unit;

use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_price_formatted_returns_huf_format_by_default(): void
    {
        session(['currency' => 'HUF']);

        $product = new Product(['price_huf' => 12990]);

        $this->assertSame('12 990 Ft', $product->price_formatted);
    }

    public function test_display_price_returns_eur_when_currency_is_eur(): void
    {
        session(['currency' => 'EUR']);

        $product = new Product(['price_huf' => 3810]);

        $this->assertSame(10.0, $product->display_price);
    }

    public function test_currency_symbol_returns_euro_symbol_for_eur(): void
    {
        session(['currency' => 'EUR']);

        $product = new Product(['price_huf' => 3810]);

        $this->assertSame('€', $product->currency_symbol);
    }

    public function test_image_url_returns_placeholder_when_image_missing(): void
    {
        $product = new Product(['image' => null]);

        $this->assertStringContainsString('images/placeholder-product.png', $product->image_url);
    }

    public function test_image_url_returns_external_url_as_is(): void
    {
        $product = new Product(['image' => 'https://example.com/x.png']);

        $this->assertSame('https://example.com/x.png', $product->image_url);
    }

    public function test_translated_name_uses_hungarian_when_locale_is_hu(): void
    {
        app()->setLocale('hu');

        $product = new Product([
            'name' => 'Protein',
            'name_hu' => 'Fehérje',
        ]);

        $this->assertSame('Fehérje', $product->translated_name);
    }

    public function test_translated_description_falls_back_to_default_value(): void
    {
        app()->setLocale('hu');

        $product = new Product([
            'description' => 'Default description',
            'description_hu' => null,
        ]);

        $this->assertSame('Default description', $product->translated_description);
    }
}
