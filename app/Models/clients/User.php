<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    use HasFactory;

    protected $table = 'tbl_user';


    public function getUserId($username)
    {
        return DB::table($this->table)
            ->where('userName', $username) // ✅ Sửa 'username' thành 'userName'
            ->value('userId');
    }
    public function getUser($id)
    {
        $users = DB::table($this->table)
            ->where('userId', $id)->first();

        return $users;
    }

    public function updateUser($id, $data)
    {
        $update = DB::table($this->table)
            ->where('userId', $id)
            ->update($data);

        return $update;
    }

    public function getMyTours($id)
    {
        $myTours = DB::table('tbl_booking')
            ->join('tbl_tours', 'tbl_booking.tourId', '=', 'tbl_tours.tourId')
            ->leftJoin('tbl_payment', 'tbl_booking.bookingId', '=', 'tbl_payment.bookingId')
            ->where('tbl_booking.userId', $id)
            ->select('tbl_booking.*', 'tbl_tours.title', 'tbl_tours.priceAdult', 'tbl_tours.priceChild', 'tbl_payment.status as paymentStatus')
            ->orderByDesc('tbl_booking.bookingDate')
            ->get();

        foreach ($myTours as $tour) {
            // Lấy danh sách hình ảnh thuộc về tour
            $tour->images = DB::table('tbl_images')
                ->where('tourId', $tour->tourId)
                ->pluck('imageUrl')
                ->toArray();
        }

        return $myTours;
    }
}