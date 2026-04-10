<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        $notifications = AdminNotification::query()
            ->latest()
            ->paginate(20);

        $unreadCount = AdminNotification::unread()->count();

        return view('admin.notifications.index', compact('notifications', 'unreadCount'));
    }

    public function markRead(AdminNotification $notification)
    {
        if (!$notification->read_at) {
            $notification->update(['read_at' => now()]);
        }
        return back();
    }

    public function markAllRead()
    {
        AdminNotification::unread()->update(['read_at' => now()]);
        return back();
    }
}