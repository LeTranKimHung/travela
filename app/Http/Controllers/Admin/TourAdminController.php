<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\NotificationService;

class TourAdminController extends Controller {
    protected $notif;

    public function __construct(NotificationService $notif)
    {
        $this->notif = $notif;
    }

    public function index(Request $request) {
        $query = DB::table('tbl_tours');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('tourId', 'like', "%{$search}%")
                  ->orWhere('destination', 'like', "%{$search}%");
            });
        }

        if ($request->filled('domain')) {
            $query->where('domain', $request->domain);
        }

        $tours = $query->orderBy('tourId', 'desc')->get();
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
            'description' => $request->description,
            'policy' => $request->policy
        ]);

        // Insert timelines
        $timelineTitles = $request->input('timeline_title', []);
        $timelineDescs = $request->input('timeline_desc', []);
        for ($i = 0; $i < count($timelineTitles); $i++) {
            if (!empty(trim($timelineTitles[$i])) || !empty(trim($timelineDescs[$i]))) {
                DB::table('tbl_timeline')->insert([
                    'tourId' => $tourId,
                    'title' => $timelineTitles[$i],
                    'description' => $timelineDescs[$i]
                ]);
            }
        }

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
        
        // Broadcast notification (nếu có user thì thông báo)
        try {
            $this->notif->broadcast(
                'new_tour',
                'Tour du lịch mới!',
                'Khám phá ngay: ' . $request->title . ' tại ' . $request->destination . '. Đặt chỗ ngay để nhận ưu đãi!',
                route('tour-detail', ['id' => $tourId])
            );
        } catch (\Exception $e) {
            // Log if needed, but don't fail the request
        }

        return redirect()->route('admin.tours.index')->with('success', 'Thêm mới Tour thành công');
    }
    public function edit($id) {
        $tour = DB::table('tbl_tours')->where('tourId', $id)->first();
        $images = DB::table('tbl_images')->where('tourId', $id)->get();
        $timelines = DB::table('tbl_timeline')->where('tourId', $id)->get();
        return view('admin.tours.edit', compact('tour', 'images', 'timelines'));
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
            'policy' => $request->policy
        ]);

        // Update timelines
        DB::table('tbl_timeline')->where('tourId', $id)->delete();
        $timelineTitles = $request->input('timeline_title', []);
        $timelineDescs = $request->input('timeline_desc', []);
        for ($i = 0; $i < count($timelineTitles); $i++) {
            if (!empty(trim($timelineTitles[$i])) || !empty(trim($timelineDescs[$i]))) {
                DB::table('tbl_timeline')->insert([
                    'tourId' => $id,
                    'title' => $timelineTitles[$i],
                    'description' => $timelineDescs[$i]
                ]);
            }
        }

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