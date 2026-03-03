<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected NotificationService $notif;

    public function __construct(NotificationService $notif)
    {
        $this->notif = $notif;
    }

    /**
     * GET /notifications — Lấy danh sách thông báo (AJAX)
     */
    public function index(Request $request)
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return response()->json(['notifications' => [], 'unread' => 0]);
        }

        $notifications = $this->notif->getAll((int) $userId);
        $unread        = $this->notif->countUnread((int) $userId);

        // Format thời gian relative
        $notifications = $notifications->map(function ($n) {
            $n->time_ago  = $this->timeAgo($n->created_at);
            $n->icon      = $this->typeIcon($n->type);
            $n->color     = $this->typeColor($n->type);
            return $n;
        });

        return response()->json([
            'notifications' => $notifications,
            'unread'        => $unread,
        ]);
    }

    /**
     * POST /notifications/{id}/read — Đánh dấu đã đọc
     */
    public function markRead(Request $request, int $id)
    {
        $userId = $this->getUserId();
        if (!$userId) return response()->json(['ok' => false]);
        $this->notif->markRead($id, (int) $userId);
        return response()->json(['ok' => true]);
    }

    /**
     * POST /notifications/read-all — Đánh dấu tất cả đã đọc
     */
    public function markAllRead(Request $request)
    {
        $userId = $this->getUserId();
        if (!$userId) return response()->json(['ok' => false]);
        $this->notif->markAllRead((int) $userId);
        return response()->json(['ok' => true]);
    }

    // ────────── Helpers ──────────

    private function getUserId()
    {
        $userId = session('userId');
        if (!$userId && session('username')) {
            $user = \Illuminate\Support\Facades\DB::table('tbl_user')
                ->where('userName', session('username'))
                ->first();
            if ($user) {
                $userId = $user->userId;
                session(['userId' => $userId]);
            }
        }
        return $userId;
    }

    private function timeAgo(string $datetime): string
    {
        $now = \Carbon\Carbon::now();
        $date = \Carbon\Carbon::parse($datetime);
        
        $diffMin = $now->diffInMinutes($date);
        
        if ($diffMin < 1) {
            return 'Vừa xong';
        }
        
        if ($diffMin < 60) {
            return $diffMin . ' phút trước';
        }
        
        if ($date->isToday()) {
            return $now->diffInHours($date) . ' giờ trước';
        }
        
        if ($date->isYesterday()) {
            return 'Hôm qua lúc ' . $date->format('H:i');
        }
        
        $diffDays = $now->diffInDays($date);
        if ($diffDays < 7) {
            return $diffDays . ' ngày trước';
        }
        
        $diffWeeks = $now->diffInWeeks($date);
        if ($diffWeeks == 1 && $diffDays < 14) {
            return '1 tuần trước';
        }
        
        if ($diffWeeks > 1 && $diffWeeks <= 4) {
            return $diffWeeks . ' tuần trước';
        }
        
        return $date->format('d/m/Y H:i');
    }

    private function typeIcon(string $type): string
    {
        return match ($type) {
            'booking_confirmed'  => 'fas fa-check-circle',
            'booking_cancelled'  => 'fas fa-times-circle',
            'booking_pending'    => 'fas fa-clock',
            'new_post'           => 'fas fa-newspaper',
            default              => 'fas fa-bell',
        };
    }

    private function typeColor(string $type): string
    {
        return match ($type) {
            'booking_confirmed'  => '#10b981',
            'booking_cancelled'  => '#ef4444',
            'booking_pending'    => '#f59e0b',
            'new_post'           => '#0ea5e9',
            default              => '#6366f1',
        };
    }
}
