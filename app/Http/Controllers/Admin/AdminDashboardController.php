<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller {
    public function index() {
        $tourCount = DB::table('tbl_tours')->count();
        $bookingCount = DB::table('tbl_booking')->count();
        return view('admin.index', compact('tourCount', 'bookingCount'));
    }
}