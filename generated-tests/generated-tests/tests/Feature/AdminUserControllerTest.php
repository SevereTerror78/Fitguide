<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_users_index_loads(): void
    {
        $this->withoutMiddleware();
        User::factory()->create();

        $this->get(route('admin.users.index'))
            ->assertOk()
            ->assertViewIs('admin.users.index')
            ->assertViewHas('users');
    }

    public function test_admin_can_update_another_user(): void
    {
        $this->withoutMiddleware();

        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($admin)
            ->put(route('admin.users.update', $user), [
                'name' => 'Updated User',
                'email' => 'updated@example.com',
                'role' => 'admin',
            ])
            ->assertRedirect(route('admin.users.index'));

        $this->assertSame('Updated User', $user->fresh()->name);
        $this->assertSame('admin', $user->fresh()->role);
    }
}
