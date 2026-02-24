<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GalleryAdminController extends Controller
{
    public function index()
    {
        $galleries = DB::table('tbl_galleries')->orderBy('created_at', 'desc')->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('clients/img/gallery'), $imageName);
        }

        DB::table('tbl_galleries')->insert([
            'title' => $request->title,
            'category' => $request->category,
            'image' => $imageName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.galleries.index')->with('success', 'Thêm ảnh vào bộ sưu tập thành công!');
    }

    public function edit($id)
    {
        $gallery = DB::table('tbl_galleries')->where('galleryId', $id)->first();
        if (!$gallery) return abort(404);
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gallery = DB::table('tbl_galleries')->where('galleryId', $id)->first();
        $imageName = $gallery->image;

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ
            if ($imageName && File::exists(public_path('clients/img/gallery/' . $imageName))) {
                File::delete(public_path('clients/img/gallery/' . $imageName));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('clients/img/gallery'), $imageName);
        }

        DB::table('tbl_galleries')->where('galleryId', $id)->update([
            'title' => $request->title,
            'category' => $request->category,
            'image' => $imageName,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.galleries.index')->with('success', 'Cập nhật ảnh thành công!');
    }

    public function destroy($id)
    {
        $gallery = DB::table('tbl_galleries')->where('galleryId', $id)->first();
        if ($gallery) {
            if ($gallery->image && File::exists(public_path('clients/img/gallery/' . $gallery->image))) {
                File::delete(public_path('clients/img/gallery/' . $gallery->image));
            }
            DB::table('tbl_galleries')->where('galleryId', $id)->delete();
        }
        return redirect()->route('admin.galleries.index')->with('success', 'Xóa ảnh thành công!');
    }
}
