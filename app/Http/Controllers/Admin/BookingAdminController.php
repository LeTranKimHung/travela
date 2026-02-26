<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingStatusMail;

class BookingAdminController extends Controller
{
    protected NotificationService $notif;

    public function __construct(NotificationService $notif)
    {
        $this->notif = $notif;
    }

    public function index()
    {
        $bookings = DB::table('tbl_booking')
            ->join('tbl_user', 'tbl_booking.userId', '=', 'tbl_user.userId')
            ->join('tbl_tours', 'tbl_booking.tourId', '=', 'tbl_tours.tourId')
            ->select('tbl_booking.*', 'tbl_user.userName', 'tbl_tours.title as tourTitle')
            ->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function updateStatus($id, $status)
    {
        // Lấy thông tin booking trước khi cập nhật
        $booking = DB::table('tbl_booking')
            ->join('tbl_tours', 'tbl_booking.tourId', '=', 'tbl_tours.tourId')
            ->join('tbl_user', 'tbl_booking.userId', '=', 'tbl_user.userId')
            ->where('tbl_booking.bookingId', $id)
            ->select('tbl_booking.*', 'tbl_tours.title as tourTitle', 'tbl_user.userName', 'tbl_user.fullName')
            ->first();

        if (!$booking) {
            return back()->with('error', 'Không tìm thấy đơn hàng.');
        }

        // Nếu đơn hàng đã bị hủy hoặc hoàn thành, không cho phép cập nhật nữa
        if (in_array($booking->bookingStatus, ['cancelled', 'canceled', 'completed'])) {
            return back()->with('error', 'Đơn hàng đã ở trạng thái cuối (Hủy/Hoàn thành), không thể cập nhật thêm.');
        }

        DB::table('tbl_booking')
            ->where('bookingId', $id)
            ->update(['bookingStatus' => $status]);

        // Gửi thông báo & Email cho khách hàng
        try {
            if ($booking) {
                // Lấy thông tin email khách hàng
                $user = DB::table('tbl_user')->where('userId', $booking->userId)->first();

                $statusLabel = match ($status) {
                    'confirmed'  => 'đã được xác nhận ✅',
                    'cancelled'  => 'đã bị hủy ❌',
                    'pending'    => 'đang chờ xác nhận ⏳',
                    'completed'  => 'đã hoàn thành 🎉',
                    default      => "đã được cập nhật thành '$status'",
                };

                $type = match ($status) {
                    'confirmed' => 'booking_confirmed',
                    'cancelled' => 'booking_cancelled',
                    default     => 'booking_pending',
                };

                // 1. Gửi thông báo trong web
                $this->notif->create(
                    (int) $booking->userId,
                    $type,
                    'Cập nhật đặt tour',
                    "Đặt tour \"" . $booking->tourTitle . "\" của bạn $statusLabel.",
                    route('profile') . '#pills-history'
                );

                // 2. Gửi Email nếu có địa chỉ email
                if ($user && $user->email) {
                    Mail::to($user->email)->send(new BookingStatusMail($booking, $status));
                }
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Notification/Mail Error (Booking): ' . $e->getMessage());
        }

        return back()->with('success', 'Cập nhật trạng thái thành công');
    }
}
