<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clients\Tours;
use App\Models\clients\Booking;
use App\Models\clients\User;

class BookingController extends Controller
{
    private $tours;
    private $user;

    public function __construct()
    {
        $this->tours = new Tours();
        $this->user  = new User();
    }

    // Trang đặt Tour
    public function index(Request $request, $tourId)
    {
        $title      = "Đặt Tour";
        $tourDetail = $this->tours->getTourDetail($tourId);

        if (!$tourDetail) {
            return redirect()->route('packages')->with('error', 'Tour không tồn tại!');
        }

        // Lấy thông tin user từ session
        $username = $request->session()->get('username');
        $user = $this->user->getUser($this->user->getUserId($username));
        $tours = $this->tours->getAllTours();

        return view('clients.error.booking', compact('tourDetail', 'title', 'user', 'tours'));
    }

    // Xử lý gửi đơn đặt tour
    public function submit(Request $request)
    {
        $request->validate([
            'tourId'          => 'required',
            'bookingDate'     => 'required|date',
            'numAdults'       => 'required|integer|min:1',
            'numChild'        => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    $maxChild = floor($request->numAdults / 2);
                    if ($value > $maxChild) {
                        $fail("Với {$request->numAdults} người lớn, bạn chỉ được thêm tối đa {$maxChild} trẻ em.");
                    }
                },
            ],
            'specialRequests' => 'nullable|string|max:255',
        ]);

        $username = $request->session()->get('username');
        $userId   = $this->user->getUserId($username);

        $tourDetail = $this->tours->getTourDetail($request->tourId);

        if (!$tourDetail) {
            return redirect()->route('packages')->with('error', 'Tour không tồn tại!');
        }

        $totalPeople = $request->numAdults + $request->numChild;
        if ($tourDetail->quantity < $totalPeople) {
            return redirect()->back()->withInput()->with('error', "Rất tiếc, Tour này chỉ còn trống {$tourDetail->quantity} chỗ!");
        }

        $totalPrice = ($tourDetail->priceAdult * $request->numAdults)
                    + ($tourDetail->priceChild * $request->numChild);

        // Lưu booking vào table tbl_booking
        $booking = Booking::create([
            'tourId'           => $request->tourId,
            'userId'           => $userId,
            'bookingDate'      => $request->bookingDate,
            'numAdults'        => $request->numAdults,
            'numChild'         => $request->numChild,
            'totalPrice'       => $totalPrice,
            'bookingStatus'    => 'pending',
            'specialRequestes' => $request->specialRequests, // Tên cột đúng trong SQL là specialRequestes
        ]);

        // Trừ đi số lượng chỗ của tour
        \Illuminate\Support\Facades\DB::table('tbl_tours')
            ->where('tourId', $request->tourId)
            ->decrement('quantity', $totalPeople);

        // Redirect sang trang thanh toán
        return redirect()->route('payment.index', ['bookingId' => $booking->bookingId])
                ->with('message', 'Đã lưu thông tin đặt tour. Vui lòng thanh toán để hoàn tất!');
    }
}
