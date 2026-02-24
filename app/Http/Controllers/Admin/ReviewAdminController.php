<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewAdminController extends Controller
{
    public function index()
    {
        $reviews = DB::table('tbl_reviews')->orderBy('created_at', 'desc')->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('admin.reviews.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
        ]);

        DB::table('tbl_reviews')->insert([
            'name' => $request->name,
            'location' => $request->location,
            'content' => $request->content,
            'rating' => $request->rating ?? 5,
            'status' => $request->has('status') ? 1 : 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.reviews.index')->with('success', 'Thêm đánh giá thành công!');
    }

    public function edit($id)
    {
        $review = DB::table('tbl_reviews')->where('reviewId', $id)->first();
        if (!$review) return abort(404);
        return view('admin.reviews.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
        ]);

        DB::table('tbl_reviews')->where('reviewId', $id)->update([
            'name' => $request->name,
            'location' => $request->location,
            'content' => $request->content,
            'rating' => $request->rating ?? 5,
            'status' => $request->has('status') ? 1 : 0,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.reviews.index')->with('success', 'Cập nhật đánh giá thành công!');
    }

    public function destroy($id)
    {
        DB::table('tbl_reviews')->where('reviewId', $id)->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Xóa đánh giá thành công!');
    }
}
