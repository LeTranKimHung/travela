<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PostAdminController extends Controller {
    protected NotificationService $notif;

    public function __construct(NotificationService $notif)
    {
        $this->notif = $notif;
    }
    public function index() {
        $posts = DB::table('tbl_posts')->orderBy('created_at', 'desc')->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create() {
        return view('admin.posts.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'summary' => 'required',
            'content' => 'required',
            'author' => 'nullable|string|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('clients/img/blog'), $imageName);
        }

        // Sử dụng insertGetId để lấy ID vừa tạo một cách an toàn
        $postId = DB::table('tbl_posts')->insertGetId([
            'title' => $request->title,
            'summary' => $request->summary,
            'content' => $request->content,
            'image' => $imageName,
            'author' => $request->author ?? session('username') ?? 'Admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Bọc phần thông báo trong try-catch để tránh crash nếu có lỗi notification
        try {
            $this->notif->broadcast(
                'new_post',
                'Tin tức mới từ Travela',
                '"' . $request->title . '" — Xem ngay bài viết mới nhất trên Blog!',
                $postId ? route('blog-detail', ['id' => $postId]) : route('blog')
            );
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Notification Error: ' . $e->getMessage());
        }

        return redirect()->route('admin.posts.index')->with('success', 'Thêm bài viết mới thành công');
    }

    public function edit($id) {
        $post = DB::table('tbl_posts')->where('postId', $id)->first();
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required',
            'summary' => 'required',
            'content' => 'required',
            'author' => 'nullable|string|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $post = DB::table('tbl_posts')->where('postId', $id)->first();
        $imageName = $post->image;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($imageName) {
                $oldPath = public_path('clients/img/blog/' . $imageName);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('clients/img/blog'), $imageName);
        }

        DB::table('tbl_posts')->where('postId', $id)->update([
            'title' => $request->title,
            'summary' => $request->summary,
            'content' => $request->content,
            'author' => $request->author ?? session('username') ?? 'Admin',
            'image' => $imageName,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Cập nhật bài viết thành công');
    }

    public function destroy($id) {
        $post = DB::table('tbl_posts')->where('postId', $id)->first();
        if ($post->image) {
            $path = public_path('clients/img/blog/' . $post->image);
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        DB::table('tbl_posts')->where('postId', $id)->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Xóa bài viết thành công');
    }
}
