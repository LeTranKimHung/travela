<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class NotificationService
{
    protected $table = 'tbl_notifications';

    /**
     * Tạo thông báo cho 1 user cụ thể
     */
    public function create(int $userId, string $type, string $title, string $message, ?string $link = null): void
    {
        DB::table($this->table)->insert([
            'userId'     => $userId,
            'type'       => $type,
            'title'      => $title,
            'message'    => $message,
            'link'       => $link,
            'is_read'    => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Tạo thông báo cho tất cả user (broadcast)
     * Thay vì dùng userId = 0 (dễ gây lỗi trạng thái đọc), 
     * ta sẽ tạo record cho từng user để đảm bảo mỗi người có trạng thái đọc riêng.
     */
    public function broadcast(string $type, string $title, string $message, ?string $link = null): void
    {
        $users = DB::table('tbl_user')->where('isActive', 'y')->get();
        
        foreach ($users as $user) {
            $this->create($user->userId, $type, $title, $message, $link);
        }
    }

    /**
     * Lấy thông báo chưa đọc của user
     */
    public function getUnread(int $userId): \Illuminate\Support\Collection
    {
        return DB::table($this->table)
            ->where('userId', $userId)
            ->where('is_read', false)
            ->orderByDesc('created_at')
            ->limit(20)
            ->get();
    }

    /**
     * Lấy tất cả thông báo của user (đã và chưa đọc)
     */
    public function getAll(int $userId): \Illuminate\Support\Collection
    {
        return DB::table($this->table)
            ->where('userId', $userId)
            ->orderByDesc('created_at')
            ->limit(30)
            ->get();
    }

    /**
     * Đếm số thông báo chưa đọc
     */
    public function countUnread(int $userId): int
    {
        return DB::table($this->table)
            ->where('userId', $userId)
            ->where('is_read', false)
            ->count();
    }

    /**
     * Đánh dấu đã đọc một thông báo
     */
    public function markRead(int $notifId, int $userId): void
    {
        DB::table($this->table)
            ->where('notifId', $notifId)
            ->where('userId', $userId)
            ->update(['is_read' => true, 'updated_at' => now()]);
    }

    /**
     * Đánh dấu tất cả đã đọc
     */
    public function markAllRead(int $userId): void
    {
        DB::table($this->table)
            ->where('userId', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true, 'updated_at' => now()]);
    }
}
