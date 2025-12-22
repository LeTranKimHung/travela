<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clients\Booking;
use App\Models\clients\Payment;
use App\Models\tours\Tour;

class PaymentController extends Controller
{
    // Trong PaymentController.php
    public function index(Request $request)
    {
        // 1. Validate dữ liệu từ form Booking
        $validatedData = $request->validate([
            'tourId' => 'required|exists:tbl_tours,tourId',
            'bookingDate' => 'required|date',
            'numAdults' => 'required|integer|min:1',
            'numChild' => 'required|integer|min:0',
            'specialRequests' => 'nullable|string|max:255'
        ]);

        // 2. Lấy thông tin Tour để tính tổng tiền
        $tour = \App\Models\clients\Tours::find($request->tourId);
        $totalPrice = ($tour->priceAdult * $request->numAdults) + 
                    ($tour->priceChild * $request->numChild);

        // 3. Tạo đơn đặt tour (Booking)
        $booking = \App\Models\clients\Booking::create([
            'tourId' => $request->tourId,
            'userId' => \Illuminate\Support\Facades\Auth::id(),
            'bookingDate' => $request->bookingDate,
            'numAdults' => $request->numAdults,
            'numChild' => $request->numChild,
            'totalPrice' => $totalPrice,
            'bookingStatus' => 'pending',
            'specialRequestes' => $request->specialRequests
    ]);

    $title = "Thanh toán";
    return view('clients.error.payment', compact('booking', 'tour', 'totalPrice', 'title'));
}

    public function process(Request $request)
    {
    $request->validate([
        'payment_method' => 'required|in:banking,momo,vnpay,zalopay',
        'booking_id' => 'required|exists:tbl_booking,bookingId'
    ]);

    $booking = Booking::findOrFail($request->booking_id);  // ✅ Giờ sẽ tìm đúng theo bookingId

    // Create payment record
    $payment = Payment::create([
        'bookingId' => $booking->bookingId,  // ✅ Sửa từ booking_id thành bookingId
        'payment_method' => $request->payment_method,
        'amount' => $booking->totalPrice,  // ✅ Sửa từ total_price thành totalPrice
        'discount_amount' => $booking->discount_amount ?? 0,
        'final_amount' => $booking->totalPrice,  // ✅ Sửa từ final_price
        'status' => 'pending'
    ]);

    // Process payment based on method
    switch($request->payment_method) {
        case 'banking':
            return $this->processBankTransfer($payment, $booking);
        case 'momo':
            return $this->processMomo($payment);
        case 'vnpay':
            return $this->processVNPay($payment);
        case 'zalopay':
            return $this->processZaloPay($payment, $booking);
        default:
            return redirect()->back()->with('error', 'Phương thức thanh toán không hợp lệ');
    }
}

private function processBankTransfer($payment, $booking)
{
    $bankDetails = [
        'bank_name' => 'Vietcombank',
        'account_number' => '1234567890',
        'account_name' => 'TRAVELA COMPANY',
        'amount' => $payment->final_amount,
        'reference' => 'TOUR' . $booking->bookingId  // ✅ Sửa sang bookingId
    ];

    return view('clients.error.payment-banking', compact('payment', 'bankDetails', 'booking'));
}

    private function processMomo($payment)
    {
        // Implement MoMo payment gateway integration
        // Return redirect to MoMo payment page
    }

    private function processVNPay($payment)
    {
        // Implement VNPay payment gateway integration
        // Return redirect to VNPay payment page
    }
    private function processZaloPay($payment, $booking)
    {
        // Thông tin cấu hình (Sử dụng thông tin Sandbox/Test)
        $config = [
            "app_id" => 2554, 
            "key1" => "sdngKKJmqEMzvh5QQcdD2A9XBSKUNaYn",
            "key2" => "trMrHtvjo6myautxDUiAcYsVtaeQ8nhf",
            "endpoint" => "https://sb-openapi.zalopay.vn/v2/create"
        ];

        $embeddata = json_encode(['redirecturl' => route('payment.success')]);
        $items = json_encode([['itemid' => "tour", 'itemname' => "Tour du lịch"]]);
        
        $order = [
            "app_id" => $config["app_id"],
            "app_time" => round(microtime(true) * 1000),
            "app_trans_id" => date("ymd") . "_" . $booking->bookingId, // Mã giao dịch duy nhất
            "app_user" => "user123",
            "item" => $items,
            "embed_data" => $embeddata,
            "amount" => (int)$payment->final_amount, //
            "description" => "Travela - Thanh toán đơn hàng #" . $booking->bookingId,
            "bank_code" => "zalopayapp",
        ];

        // Tạo chữ ký bảo mật (MAC) theo quy định của ZaloPay
        $data = $order["app_id"] . "|" . $order["app_trans_id"] . "|" . $order["app_user"] . "|" . $order["amount"] . "|" . $order["app_time"] . "|" . $order["embed_data"] . "|" . $order["item"];
        $order["mac"] = hash_hmac("sha256", $data, $config["key1"]);

        // Gửi yêu cầu HTTP POST đến ZaloPay
        $client = new \GuzzleHttp\Client();
        $response = $client->post($config["endpoint"], ['form_params' => $order]);
        $result = json_decode($response->getBody()->getContents(), true);

        if ($result['return_code'] == 1) {
            return redirect($result['order_url']); // Chuyển hướng đến trang thanh toán ZaloPay
        }

        return back()->with('error', 'Lỗi ZaloPay: ' . $result['return_message']);
    }
    public function success()
    {
        return view('clients.error.payment-success');
    }

    public function cancel()
    {
        return view('clients.error.payment-cancel');
    }
}
