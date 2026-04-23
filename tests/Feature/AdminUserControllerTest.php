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
        /** @var User $admin */
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        /** @var User $user */
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $this->actingAs($admin)
            ->put(route('admin.users.update', $user), [
                'name' => 'Updated User',
                'email' => 'updated@example.com',
                'role' => 'admin',
            ])
            ->assertRedirect(route('admin.users.index'));

        $fresh = $user->fresh();

        $this->assertSame('Updated User', $fresh->name);
        $this->assertSame('updated@example.com', $fresh->email);
        $this->assertSame('admin', $fresh->role);
    }
}