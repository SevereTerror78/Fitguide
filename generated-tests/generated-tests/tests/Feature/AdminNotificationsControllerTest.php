<?php

namespace Tests\Feature;

use App\Models\AdminNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminNotificationsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_notifications_index(): void
    {
        $this->withoutMiddleware();

        AdminNotification::query()->create([
            'type' => 'low_stock',
            'title' => 'Low stock',
            'message' => 'Test',
        ]);

        $this->get(route('admin.notifications.index'))
            ->assertOk()
            ->assertViewIs('admin.notifications.index')
            ->assertViewHas('notifications')
            ->assertViewHas('unreadCount');
    }

    public function test_mark_read_sets_read_at(): void
    {
        $this->withoutMiddleware();

        $notification = AdminNotification::query()->create([
            'type' => 'low_stock',
            'title' => 'Low stock',
            'message' => 'Test',
            'read_at' => null,
        ]);

        $this->post(route('admin.notifications.read', $notification))
            ->assertRedirect();

        $this->assertNotNull($notification->fresh()->read_at);
    }

    public function test_mark_all_read_marks_everything_read(): void
    {
        $this->withoutMiddleware();

        AdminNotification::query()->create([
            'type' => 'low_stock',
            'title' => 'One',
            'message' => 'One',
        ]);
        AdminNotification::query()->create([
            'type' => 'low_stock',
            'title' => 'Two',
            'message' => 'Two',
        ]);

        $this->post(route('admin.notifications.readAll'))->assertRedirect();

        $this->assertSame(0, AdminNotification::unread()->count());
    }
}
