<?php

namespace Tests\Unit;

use App\Models\AdminNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_unread_scope_returns_only_unread_rows(): void
    {
        AdminNotification::create([
            'type' => 'low_stock',
            'title' => 'A',
            'message' => 'A',
            'read_at' => null,
        ]);

        AdminNotification::create([
            'type' => 'low_stock',
            'title' => 'B',
            'message' => 'B',
            'read_at' => now(),
        ]);

        $this->assertSame(1, AdminNotification::unread()->count());
    }
}
