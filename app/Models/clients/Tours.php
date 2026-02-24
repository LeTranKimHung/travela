<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Tours extends Model
{
    use HasFactory;
    protected $table = 'tbl_tours';
    protected $primaryKey = 'tourId';
    public $timestamps = false;

    /**
     * Get all tours with optional filters
     */
    public function getAllTours($filters = [])
    {
        $query = DB::table($this->table);
        
        // Lọc theo domain (Miền Bắc, Miền Trung, Miền Nam)
        if (!empty($filters['domain'])) {
            $query->where('domain', $filters['domain']);
        }
        
        // Lọc theo điểm đến hoặc tiêu đề tour
        if (!empty($filters['destination'])) {
            $query->where(function($q) use ($filters) {
                $q->where('destination', 'LIKE', '%' . $filters['destination'] . '%')
                  ->orWhere('title', 'LIKE', '%' . $filters['destination'] . '%');
            });
        }
        
        // Lọc theo thời gian tour (time)
        if (!empty($filters['time'])) {
            $query->where('time', 'LIKE', '%' . $filters['time'] . '%');
        }
        
        // Lọc theo số người (quantity)
        if (!empty($filters['quantity'])) {
            switch($filters['quantity']) {
                case '1-2':
                    $query->where('quantity', '>=', 1)->where('quantity', '<=', 2);
                    break;
                case '3-5':
                    $query->where('quantity', '>=', 3)->where('quantity', '<=', 5);
                    break;
                case '6+':
                    $query->where('quantity', '>=', 6);
                    break;
            }
        }
        
        // Lọc theo khoảng giá người lớn
        if (!empty($filters['price_min'])) {
            $query->where('priceAdult', '>=', $filters['price_min']);
        }
        
        if (!empty($filters['price_max'])) {
            $query->where('priceAdult', '<=', $filters['price_max']);
        }
        
        // Lọc theo tính khả dụng (availability)
        if (!empty($filters['availability'])) {
            $query->where('availability', $filters['availability']);
        }
        
        // Lọc theo ngày bắt đầu
        if (!empty($filters['start_date'])) {
            $query->whereDate('startDate', '>=', $filters['start_date']);
        }
        
        // Lọc theo ngày kết thúc
        if (!empty($filters['end_date'])) {
            $query->whereDate('endDate', '<=', $filters['end_date']);
        }
        
        $allTours = $query->get();
        
        // Lấy hình ảnh cho mỗi tour
        foreach($allTours as $tour){
            $tour->images = DB::table('tbl_images')
                ->where('tourid', $tour->tourId)
                ->pluck('imageUrl')
                ->toArray();
        }
        
        return $allTours;
    }

    /**
     * Get tour detail
     */
    public function getTourDetail($id)
    {
        $getTourDetail = DB::table($this->table)
            ->where('tourId', $id)
            ->first();

        if ($getTourDetail) {
            $getTourDetail->images = DB::table('tbl_images')
                ->where('tourId', $getTourDetail->tourId)
                ->limit(5)
                ->pluck('imageUrl')
                ->toArray();

            $getTourDetail->timeline = DB::table('tbl_timeline')
                ->where('tourId', $getTourDetail->tourId)
                ->get();
        }

        return $getTourDetail;
    }
    
    /**
     * Get unique domains (Miền Bắc, Miền Trung, Miền Nam)
     */
    public function getDomains()
    {
        return DB::table($this->table)
            ->select('domain')
            ->distinct()
            ->whereNotNull('domain')
            ->pluck('domain');
    }
    
    /**
     * Get unique destinations
     */
    public function getDestinations()
    {
        return DB::table($this->table)
            ->select('destination')
            ->distinct()
            ->whereNotNull('destination')
            ->where('destination', '!=', '')
            ->pluck('destination');
    }
    
    /**
     * Get unique time options
     */
    public function getTimeOptions()
    {
        return DB::table($this->table)
            ->select('time')
            ->distinct()
            ->whereNotNull('time')
            ->where('time', '!=', '')
            ->pluck('time');
    }
}