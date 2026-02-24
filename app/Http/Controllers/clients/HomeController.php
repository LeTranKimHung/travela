<?php


namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clients\Home;
use App\Models\clients\Tours;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $homeTours;
    public function __construct()
    {
        $this->homeTours = new Home();
    }
    public function index()
    {
       $title = 'Trang chủ';
       $tours = $this->homeTours->getHomeTours();
       $posts = DB::table('tbl_posts')->orderBy('created_at', 'desc')->limit(3)->get();
       $galleries = DB::table('tbl_galleries')->orderBy('created_at', 'desc')->limit(12)->get();
       $reviews = DB::table('tbl_reviews')->where('status', 1)->orderBy('created_at', 'desc')->get();
       return view('clients.error.home', compact('title', 'tours', 'posts', 'galleries', 'reviews'));
    }

    
}
