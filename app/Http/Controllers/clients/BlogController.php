<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clients\Tours;

class BlogController extends Controller
{
    private $tours;
    public function __construct()
    {
        $this->tours = new Tours();
    }
    public function index()
    {
        $title = "Blog";
        $tours = $this->tours->getAllTours();
        $posts = \Illuminate\Support\Facades\DB::table('tbl_posts')->orderBy('created_at', 'desc')->get();
        return view('clients.error.blog', compact('title', 'tours', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        $post = \Illuminate\Support\Facades\DB::table('tbl_posts')->where('postId', $id)->first();
        if (!$post) {
            abort(404);
        }
        $title = $post->title;
        $tours = $this->tours->getAllTours();
        // Lấy thêm bài viết liên quan (ví dụ 3 bài khác)
        $relatedPosts = \Illuminate\Support\Facades\DB::table('tbl_posts')
            ->where('postId', '!=', $id)
            ->limit(3)
            ->get();

        return view('clients.error.blog-detail', compact('title', 'post', 'tours', 'relatedPosts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
