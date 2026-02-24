<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clients\Booking;
use App\Models\clients\Payment;
use App\Models\clients\Tours;
use App\Models\clients\User;

class PaymentController extends Controller
{
    private $tours;
    private $booking;

    public function __construct()
    {
        $this->user = new User();
        $this->tours = new Tours();
    }

    // Hiển thị trang thanh toán
    public function index(Request $request)
    {
        $bookingId = $request->query('bookingId');
        $booking = Booking::findOrFail($bookingId);
        $tour = $this->tours->getTourDetail($booking->tourId);
        
        $title = "Thanh toán đơn hàng #" . $bookingId;
        $totalPrice = $booking->totalPrice;
        return view('clients.error.payment', compact('booking', 'tour', 'totalPrice', 'title'));
    }

    // Xử lý phương thức thanh toán được chọn
    public function process(Request $request)
    {
        $request->validate([
            'booking_id'     => 'required|exists:tbl_booking,bookingId',
            'payment_method' => 'required|string',
        ]);

        $booking = Booking::findOrFail($request->booking_id);
        
        // Cập nhật hoặc tạo bản ghi payment
        // (Tùy logic, ở đây ví dụ đơn giản)
        
        if ($request->payment_method === 'banking') {
            // Chuyển khoản ngân hàng - coi như chờ confirm
            return view('clients.error.payment-success', ['title' => 'Thông tin chuyển khoản']);
        } elseif ($request->payment_method === 'vnpay') {
            // [TODO] Chuyển đến VNPay
            return redirect()->route('payment.vnpay')->with('booking_id', $booking->bookingId);
        } elseif ($request->payment_method === 'momo') {
            return $this->momoPayment($request);
        } elseif ($request->payment_method === 'zalopay') {
            return redirect()->route('payment.zalopay.view', ['bookingId' => $booking->bookingId]);
        }

        return back()->with('error', 'Phương thức thanh toán không hợp lệ!');
    }

    // ===== MoMo =====

    public function momoPayment(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:tbl_booking,bookingId',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        // Tạo bản ghi payment
        $payment = Payment::create([
            'bookingId'      => $booking->bookingId,
            'payment_method' => 'momo',
            'amount'         => $booking->totalPrice,
            'discount_amount'=> 0,
            'final_amount'   => $booking->totalPrice,
            'status'         => 'pending',
        ]);

        // [TODO] Tích hợp MoMo API thực tế
        return redirect()->route('payment.momo.callback')->with(['payment_id' => $payment->paymentId, 'message' => 'Thanh toán MoMo đang được xử lý!']);
    }

    public function momoCallback(Request $request)
    {
        $title = "Kết quả thanh toán MoMo";
        return view('clients.error.payment-success', compact('title'));
    }

    // ===== PayPal =====

    public function paypalPayment(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:tbl_booking,bookingId',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        Payment::create([
            'bookingId'      => $booking->bookingId,
            'payment_method' => 'paypal',
            'amount'         => $booking->totalPrice,
            'discount_amount'=> 0,
            'final_amount'   => $booking->totalPrice,
            'status'         => 'pending',
        ]);

        // [TODO] Tích hợp PayPal SDK
        return redirect()->route('payment.paypal.success')->with('message', 'Đang chuyển đến PayPal...');
    }

    public function paypalSuccess(Request $request)
    {
        $title = "Thanh toán PayPal thành công";
        return view('clients.error.payment-success', compact('title'));
    }

    public function paypalCancel(Request $request)
    {
        return redirect()->route('home')->with('error', 'Bạn đã hủy thanh toán PayPal.');
    }

    // ===== ZaloPay =====

    private function processZaloPay($payment, $booking)
    {
        $config = [
            "app_id"   => 2554,
            "key1"     => "sdngKKJmqEMzvh5QQcdD2A9XBSKUNaYn",
            "key2"     => "trMrHtvjo6myautxDUiAcYsVtaeQ8nhf",
            "endpoint" => "https://sb-openapi.zalopay.vn/v2/create",
        ];

        $embeddata = json_encode(['redirecturl' => route('home')]);
        $items     = json_encode([['itemid' => "tour", 'itemname' => "Tour du lịch"]]);

        $order = [
            "app_id"      => $config["app_id"],
            "app_time"    => round(microtime(true) * 1000),
            "app_trans_id"=> date("ymd") . "_" . $booking->bookingId,
            "app_user"    => "user123",
            "item"        => $items,
            "embed_data"  => $embeddata,
            "amount"      => (int) $payment->final_amount,
            "description" => "Travela - Thanh toán đơn hàng #" . $booking->bookingId,
            "bank_code"   => "zalopayapp",
        ];

        $data = $order["app_id"] . "|" . $order["app_trans_id"] . "|" . $order["app_user"] . "|"
              . $order["amount"] . "|" . $order["app_time"] . "|" . $order["embed_data"] . "|" . $order["item"];
        $order["mac"] = hash_hmac("sha256", $data, $config["key1"]);

        $client   = new \GuzzleHttp\Client();
        $response = $client->post($config["endpoint"], ['form_params' => $order]);
        $result   = json_decode($response->getBody()->getContents(), true);

        if ($result['return_code'] == 1) {
            return redirect($result['order_url']);
        }

        return back()->with('error', 'Lỗi ZaloPay: ' . $result['return_message']);
    }

    // Hiển thị form nhập thông tin ZaloPay
    public function zalopayView(Request $request)
    {
        $bookingId = $request->query('bookingId');
        $booking = Booking::findOrFail($bookingId);
        $tour = $this->tours->getTourDetail($booking->tourId);
        $title = "Thông tin ZaloPay";

        return view('clients.error.payment-zalopay', compact('booking', 'tour', 'title'));
    }

    // Xử lý gửi thông tin ZaloPay (Thẻ ngân hàng)
    public function zalopaySubmit(Request $request)
    {
        $request->validate([
            'booking_id'  => 'required|exists:tbl_booking,bookingId',
            'card_number' => 'required|string',
            'card_holder' => 'required|string',
            'expiry_date' => 'required|string',
            'cvv'         => 'nullable|string',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        // Giả lập lưu payment với thông tin thẻ
        Payment::create([
            'bookingId'      => $booking->bookingId,
            'payment_method' => 'zalopay',
            'amount'         => $booking->totalPrice,
            'discount_amount'=> 0,
            'final_amount'   => $booking->totalPrice,
            'status'         => 'success', // Mock thành công
            'payment_details'=> json_encode([
                'card_number' => $request->card_number,
                'card_holder' => $request->card_holder,
                'expiry_date' => $request->expiry_date,
                'cvv'         => $request->cvv
            ])
        ]);

        return redirect()->route('payment.momo.callback')->with('message', 'Thanh toán bằng thẻ qua ZaloPay đã được ghi nhận thành công!');
    }
}
