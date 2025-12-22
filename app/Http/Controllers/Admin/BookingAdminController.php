<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BookingAdminController extends Controller
{
    public function index()
    {
        // Join để lấy tên khách và tên tour
        $bookings = DB::table('tbl_booking')
            ->join('tbl_user', 'tbl_booking.userId', '=', 'tbl_user.userId')
            ->join('tbl_tours', 'tbl_booking.tourId', '=', 'tbl_tours.tourId')
            ->select('tbl_booking.*', 'tbl_user.userName', 'tbl_tours.title as tourTitle')
            ->get();
            
        return view('admin.bookings.index', compact('bookings'));
    }

    public function updateStatus($id, $status)
    {
        DB::table('tbl_booking')
            ->where('bookingId', $id)
            ->update(['bookingStatus' => $status]);
            
        return back()->with('success', 'Cập nhật trạng thái thành công');
    }
}
