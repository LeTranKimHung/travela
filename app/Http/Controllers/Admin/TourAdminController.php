<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TourAdminController extends Controller {
    public function index() {
        $tours = DB::table('tbl_tours')->get();
        return view('admin.tours.index', compact('tours'));
    }

    public function create() { return view('admin.tours.create'); }

    public function store(Request $request) {
        DB::table('tbl_tours')->insert([
            'title' => $request->title,
            'priceAdult' => $request->priceAdult,
            'priceChild' => $request->priceChild,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'availability' => 1
        ]);
        return redirect()->route('admin.tours.index')->with('success', 'Thêm mới thành công');
    }
}