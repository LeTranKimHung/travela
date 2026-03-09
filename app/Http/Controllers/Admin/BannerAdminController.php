<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BannerAdminController extends Controller
{
    public function index()
    {
        $banners = DB::table('tbl_banners')->orderBy('bannerId', 'desc')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|string|max:255',
            'status' => 'required|in:0,1'
        ]);

        $imageName = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('clients/img/banners'), $imageName);
        }

        DB::table('tbl_banners')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'imageURL' => 'clients/img/banners/' . $imageName,
            'link' => $request->link,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Thêm Banner thành công!');
    }

    public function edit($id)
    {
        $banner = DB::table('tbl_banners')->where('bannerId', $id)->first();
        if (!$banner) {
            return redirect()->route('admin.banners.index')->with('error', 'Không tìm thấy Banner');
        }
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|string|max:255',
            'status' => 'required|in:0,1'
        ]);

        $banner = DB::table('tbl_banners')->where('bannerId', $id)->first();
        if (!$banner) {
            return redirect()->route('admin.banners.index')->with('error', 'Không tìm thấy Banner');
        }

        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'status' => $request->status,
            'updated_at' => now()
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('clients/img/banners'), $imageName);
            
            // Xoá ảnh cũ (nếu có)
            if (File::exists(public_path($banner->imageURL))) {
                File::delete(public_path($banner->imageURL));
            }
            
            $updateData['imageURL'] = 'clients/img/banners/' . $imageName;
        }

        DB::table('tbl_banners')->where('bannerId', $id)->update($updateData);

        return redirect()->route('admin.banners.index')->with('success', 'Cập nhật Banner thành công!');
    }

    public function destroy($id)
    {
        $banner = DB::table('tbl_banners')->where('bannerId', $id)->first();
        if ($banner) {
            if (File::exists(public_path($banner->imageURL))) {
                File::delete(public_path($banner->imageURL));
            }
            DB::table('tbl_banners')->where('bannerId', $id)->delete();
        }

        return redirect()->route('admin.banners.index')->with('success', 'Xóa Banner thành công!');
    }
}
