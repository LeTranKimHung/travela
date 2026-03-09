<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller {
    public function index() {
        $tourCount = DB::table('tbl_tours')->count();
        $bookingCount = DB::table('tbl_booking')->where('bookingStatus', 'confirmed')->count();
        
        // Tính doanh thu từ các đơn hàng đã xác nhận (confirmed)
        $totalRevenue = DB::table('tbl_booking')
            ->where('bookingStatus', 'confirmed')
            ->sum('totalPrice');

        // Lấy doanh thu theo tháng (Năm hiện tại)
        $currentYear = date('Y');
        $monthlyRevenue = DB::table('tbl_booking')
            ->select(DB::raw('sum(totalPrice) as total'), DB::raw('MONTH(bookingDate) as month'))
            ->where('bookingStatus', 'confirmed')
            ->whereYear('bookingDate', $currentYear)
            ->groupBy(DB::raw('MONTH(bookingDate)'))
            ->get();
            
        $revenueMonths = [];
        $revenueData = [];
        
        for ($i = 1; $i <= 12; $i++) {
            $revenueMonths[] = 'Tháng ' . $i;
            $revenueData[] = 0;
        }

        foreach ($monthlyRevenue as $rev) {
            $monthIndex = $rev->month - 1;
            $revenueData[$monthIndex] = (int)$rev->total;
        }

        // Lấy trạng thái đơn hàng
        $statusCounts = DB::table('tbl_booking')
            ->select('bookingStatus', DB::raw('count(*) as total'))
            ->groupBy('bookingStatus')
            ->pluck('total', 'bookingStatus')
            ->toArray();

        $bookingStatusData = [
            'confirmed' => $statusCounts['confirmed'] ?? 0,
            'pending' => $statusCounts['pending'] ?? 0,
            'cancelled' => $statusCounts['cancelled'] ?? 0,
        ];

        return view('admin.index', compact('tourCount', 'bookingCount', 'totalRevenue', 'revenueMonths', 'revenueData', 'bookingStatusData'));
    }
}