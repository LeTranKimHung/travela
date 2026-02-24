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
        $request->validate([
            'title' => 'required',
            'priceAdult' => 'required|numeric',
            'priceChild' => 'required|numeric',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'quantity' => 'required|numeric',
            'domain' => 'required',
            'time' => 'required',
            'destination' => 'required',
            'description' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $tourId = DB::table('tbl_tours')->insertGetId([
            'title' => $request->title,
            'priceAdult' => $request->priceAdult,
            'priceChild' => $request->priceChild,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'availability' => 1,
            'domain' => $request->domain,
            'time' => $request->time,
            'quantity' => $request->quantity,
            'destination' => $request->destination,
            'description' => $request->description
        ]);

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach (array_slice($files, 0, 10) as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('clients/img/galery-tour'), $fileName);
                
                DB::table('tbl_images')->insert([
                    'tourId' => $tourId,
                    'imageURL' => $fileName,
                    'uploadDate' => now()
                ]);
            }
        }

        return redirect()->route('admin.tours.index')->with('success', 'Thêm mới Tour thành công');
    }
    public function edit($id) {
        $tour = DB::table('tbl_tours')->where('tourId', $id)->first();
        $images = DB::table('tbl_images')->where('tourId', $id)->get();
        return view('admin.tours.edit', compact('tour', 'images'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required',
            'priceAdult' => 'required|numeric',
            'priceChild' => 'required|numeric',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'quantity' => 'required|numeric',
            'domain' => 'required',
            'time' => 'required',
            'destination' => 'required',
            'description' => 'required',
        ]);

        DB::table('tbl_tours')->where('tourId', $id)->update([
            'title' => $request->title,
            'priceAdult' => $request->priceAdult,
            'priceChild' => $request->priceChild,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'domain' => $request->domain,
            'time' => $request->time,
            'quantity' => $request->quantity,
            'destination' => $request->destination,
            'description' => $request->description,
        ]);

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach (array_slice($files, 0, 10) as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('clients/img/galery-tour'), $fileName);
                
                DB::table('tbl_images')->insert([
                    'tourId' => $id,
                    'imageURL' => $fileName,
                    'uploadDate' => now()
                ]);
            }
        }

        return redirect()->route('admin.tours.index')->with('success', 'Cập nhật Tour thành công');
    }

    public function destroy($id) {
        // Xóa ảnh liên quan trong db
        DB::table('tbl_images')->where('tourId', $id)->delete();
        // Xóa tour
        DB::table('tbl_tours')->where('tourId', $id)->delete();
        
        return redirect()->route('admin.tours.index')->with('success', 'Xóa Tour thành công');
    }
}