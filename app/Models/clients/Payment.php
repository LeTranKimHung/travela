<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    // 1. Khai báo tên bảng thực tế trong Database
    protected $table = 'tbl_payment'; 

    // 2. Khai báo khóa chính của bảng
    protected $primaryKey = 'paymentId'; 

    // 3. Bật timestamps nếu bạn có cột created_at và updated_at
    public $timestamps = true; 

    // 4. Các trường cho phép lưu dữ liệu hàng loạt (Mass Assignment)
    protected $fillable = [
        'bookingId',      // Liên kết với bảng tbl_booking
        'payment_method', // Phương thức: banking, momo, vnpay
        'amount',         // Số tiền gốc
        'discount_amount',// Số tiền giảm giá
        'final_amount',   // Số tiền cuối cùng phải trả
        'status',         // Trạng thái: pending, success, cancel
        'transaction_id', // Mã giao dịch từ ngân hàng/ví
        'payment_details' // Thông tin chi tiết thêm (nếu có)
    ];

    // 5. Thiết lập mối quan hệ với đơn đặt tour (Booking)
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'bookingId', 'bookingId');
    }
}