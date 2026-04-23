<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdviceControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_advice_index_loads(): void
    {
        $this->get(route('advice.index'))
            ->assertOk()
            ->assertViewIs('advice.index');
    }

    public function test_bmi_calculates_and_redirects_with_flash_data(): void
    {
        $response = $this->post(route('advice.bmi'), [
            'weight' => 70,
            'height' => 175,
        ]);

        $response->assertRedirect(route('advice.index'));
        $response->assertSessionHas('category_key', 'normal');
        $response->assertSessionHas('advice_key', 'normal');
        $response->assertSessionHas('old_weight', 70.0);
        $response->assertSessionHas('old_height', 175.0);
    }
}
