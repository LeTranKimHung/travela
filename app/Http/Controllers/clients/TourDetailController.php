<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clients\Tours;
use App\Models\clients\User;
use Illuminate\Support\Facades\DB;

class TourDetailController extends Controller
{
    private $tours;
    private $user;

    public function __construct()
    {
        $this->tours = new Tours();
        $this->user  = new User();
    }

    // Route: GET /tour-detail/{id}
    public function index($id = 0)
    {
        $title      = "Tour Details";
        $tourDetail = $this->tours->getTourDetail($id);

        if (!$tourDetail) {
            return redirect()->route('home')->with('error', 'Tour không tồn tại hoặc đã bị xóa!');
        }

        return view('clients.error.tour-detail', compact('title', 'tourDetail'));
    }

    // Route: POST /reviews/check-booking
    // Kiểm tra xem user đã đặt tour này chưa (để cho phép review)
    public function checkBooking(Request $request)
    {
        $username = $request->session()->get('username');
        if (!$username) {
            return response()->json(['success' => false, 'message' => 'Chưa đăng nhập']);
        }

        $userId = $this->user->getUserId($username);
        $tourId = $request->input('tourId');

        $booking = DB::table('tbl_booking')
            ->where('userId', $userId)
            ->where('tourId', $tourId)
            ->where('bookingStatus', 'confirmed')
            ->first();

        if ($booking) {
            return response()->json(['success' => true, 'message' => 'Bạn có thể đánh giá tour này.']);
        }

        return response()->json(['success' => false, 'message' => 'Bạn chưa đặt hoặc chưa hoàn thành tour này.']);
    }

    // Route: POST /reviews/submit
    // Gửi đánh giá tour
    public function submitReview(Request $request)
    {
        $request->validate([
            'tourId'  => 'required',
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $username = $request->session()->get('username');
        if (!$username) {
            return response()->json(['success' => false, 'message' => 'Vui lòng đăng nhập để đánh giá.']);
        }

        $userId = $this->user->getUserId($username);

        // Kiểm tra đã review chưa
        $existed = DB::table('tbl_reviews')
            ->where('userId', $userId)
            ->where('tourId', $request->tourId)
            ->first();

        if ($existed) {
            return response()->json(['success' => false, 'message' => 'Bạn đã đánh giá tour này rồi.']);
        }

        DB::table('tbl_reviews')->insert([
            'tourId'  => $request->tourId,
            'userId'  => $userId,
            'rating'  => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json(['success' => true, 'message' => 'Cảm ơn bạn đã đánh giá!']);
    }
}
