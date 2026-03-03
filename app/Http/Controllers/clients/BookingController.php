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

        // Lấy mã giảm giá khả dụng
        $availableCoupons = \Illuminate\Support\Facades\DB::table('tbl_coupons')
            ->where('is_active', 1)
            ->where(function($q) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', now());
            })
            ->where(function($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>=', now());
            })
            ->where(function($q) {
                $q->whereNull('usage_limit')->orWhereRaw('used_count < usage_limit');
            })
            ->get();

        return view('clients.error.booking', compact('tourDetail', 'title', 'user', 'tours', 'availableCoupons'));
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

        $couponCode = null;
        $discountAmount = 0;

        // Xử lý Coupon logic
        if ($request->filled('coupon_code')) {
            $coupon = \Illuminate\Support\Facades\DB::table('tbl_coupons')
                ->where('code', strtoupper($request->coupon_code))
                ->where('is_active', 1)
                ->where(function($q) {
                    $q->whereNull('starts_at')->orWhere('starts_at', '<=', now());
                })
                ->where(function($q) {
                    $q->whereNull('expires_at')->orWhere('expires_at', '>=', now());
                })
                ->first();

            if ($coupon) {
                if ($coupon->usage_limit === null || $coupon->used_count < $coupon->usage_limit) {
                    if ($totalPrice >= $coupon->min_order_value) {
                        $couponCode = $coupon->code;
                        if ($coupon->type == 'percent') {
                            $discountAmount = ($totalPrice * $coupon->value) / 100;
                        } else {
                            $discountAmount = $coupon->value;
                        }

                        // Đảm bảo không giảm giá quá tổng tiền
                        if ($discountAmount > $totalPrice) {
                            $discountAmount = $totalPrice;
                        }
                        
                        $totalPrice -= $discountAmount;

                        // Tăng biến đếm số lần sử dụng coupon
                        \Illuminate\Support\Facades\DB::table('tbl_coupons')
                            ->where('couponId', $coupon->couponId)
                            ->increment('used_count');
                    } else {
                        return redirect()->back()->withInput()->with('error', "Đơn hàng tối thiểu để áp dụng mã này là " . number_format($coupon->min_order_value) . "đ!");
                    }
                } else {
                    return redirect()->back()->withInput()->with('error', "Mã giảm giá đã hết lượt sử dụng!");
                }
            } else {
                return redirect()->back()->withInput()->with('error', "Mã giảm giá không hợp lệ hoặc đã hết hạn!");
            }
        }

        // Lưu booking vào table tbl_booking
        $booking = Booking::create([
            'tourId'           => $request->tourId,
            'userId'           => $userId,
            'bookingDate'      => $request->bookingDate,
            'numAdults'        => $request->numAdults,
            'numChild'         => $request->numChild,
            'totalPrice'       => $totalPrice, // Đã trừ tiền coupon
            'bookingStatus'    => 'pending',
            'specialRequestes' => $request->specialRequests,
            // Coupon có the luu thong qua Model hoang truc tiep tren DB
        ]);

        if ($couponCode) {
            \Illuminate\Support\Facades\DB::table('tbl_booking')
                ->where('bookingId', $booking->bookingId) // tbl_booking có primary char gi do
                ->update([
                    'couponCode' => $couponCode,
                    'discountAmount' => $discountAmount
                ]);
        }

        // Trừ đi số lượng chỗ của tour
        \Illuminate\Support\Facades\DB::table('tbl_tours')
            ->where('tourId', $request->tourId)
            ->decrement('quantity', $totalPeople);

        // Redirect sang trang thanh toán
        return redirect()->route('payment.index', ['bookingId' => $booking->bookingId])
                ->with('message', 'Đã lưu thông tin đặt tour. Vui lòng thanh toán để hoàn tất!');
    }
}
