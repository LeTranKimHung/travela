<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'tbl_booking'; //
    protected $primaryKey = 'bookingId'; //
    public $timestamps = false; // Tắt nếu bảng không có created_at/updated_at

    protected $fillable = [
        'tourId',
        'userId',
        'bookingDate',
        'numAdults',
        'numChild',
        'totalPrice',
        'bookingStatus',
        'specialRequestes' // Lưu ý: Tên cột trong DB là 'specialRequestes' (có chữ e)
    ];
}