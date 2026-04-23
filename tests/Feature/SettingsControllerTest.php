<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettingsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_settings_index_loads_for_authenticated_user(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('settings.index'))
            ->assertOk()
            ->assertViewIs('settings.index');
    }

    public function test_user_can_update_settings(): void
    {
        $user = User::factory()->create([
            'language' => 'en',
            'theme' => 'dark',
            'currency' => 'HUF',
        ]);

        $response = $this->actingAs($user)->put(route('settings.update'), [
            'language' => 'hu',
            'theme' => 'light',
            'currency' => 'EUR',
        ]);

        $response->assertRedirect(route('settings.index'));
        $response->assertSessionHas('locale', 'hu');

        $user->refresh();
        $this->assertSame('hu', $user->language);
        $this->assertSame('light', $user->theme);
        $this->assertSame('EUR', $user->currency);
    }

    public function test_user_can_update_only_language_from_quick_switch(): void
    {
        $user = User::factory()->create(['language' => 'en']);

        $response = $this->actingAs($user)->post(route('settings.language'), [
            'language' => 'hu',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('locale', 'hu');

        $user->refresh();
        $this->assertSame('hu', $user->language);
    }
}
