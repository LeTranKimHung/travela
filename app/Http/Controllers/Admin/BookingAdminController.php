<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    public function index(Request $request)
    {
        $query = DB::table('tbl_booking')
            ->join('tbl_user', 'tbl_booking.userId', '=', 'tbl_user.userId')
            ->join('tbl_tours', 'tbl_booking.tourId', '=', 'tbl_tours.tourId')
            ->select('tbl_booking.*', 'tbl_user.userName', 'tbl_tours.title as tourTitle');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('tbl_user.userName', 'like', "%{$search}%")
                  ->orWhere('tbl_tours.title', 'like', "%{$search}%")
                  ->orWhere('tbl_booking.bookingId', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('tbl_booking.bookingStatus', $request->status);
        } else {
            $query->whereNotIn('tbl_booking.bookingStatus', ['cancelled', 'canceled']);
        }

        $bookings = $query->orderBy('tbl_booking.bookingId', 'desc')->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function export()
    {
        $bookings = DB::table('tbl_booking')
            ->join('tbl_user', 'tbl_booking.userId', '=', 'tbl_user.userId')
            ->join('tbl_tours', 'tbl_booking.tourId', '=', 'tbl_tours.tourId')
            ->whereNotIn('tbl_booking.bookingStatus', ['cancelled', 'canceled'])
            ->select('tbl_booking.*', 'tbl_user.userName', 'tbl_tours.title as tourTitle')
            ->get();

        $fileName = 'bookings_export.csv';
        $headers = array(
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('ID', 'Khách hàng', 'Tên Tour', 'Ngày đặt', 'Tổng tiền (VND)', 'Trạng thái');

        $callback = function() use($bookings, $columns) {
            $file = fopen('php://output', 'w');
            // Write UTF-8 BOM so Excel opens it correctly
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, $columns);

            foreach ($bookings as $b) {
                $statusMap = [
                    'confirmed' => 'Đã xác nhận',
                    'completed' => 'Hoàn thành',
                    'pending'   => 'Chờ duyệt'
                ];
                $statusName = $statusMap[$b->bookingStatus] ?? $b->bookingStatus;

                fputcsv($file, array(
                    $b->bookingId,
                    $b->userName,
                    $b->tourTitle,
                    $b->bookingDate,
                    $b->totalPrice,
                    $statusName
                ));
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
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

        // Nếu admin huỷ đơn, cộng lại số lượng trống vào tour
        if (in_array($status, ['cancelled', 'canceled'])) {
            $totalPeople = $booking->numAdults + $booking->numChild;
            DB::table('tbl_tours')->where('tourId', $booking->tourId)->increment('quantity', $totalPeople);
        }

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
