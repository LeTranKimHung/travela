<?php
namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $tours = Tour::with('images')->get();
        return view('clients.error.services', [
            'tours' => $tours,
            'title' => 'Dịch Vụ'
        ]);
    }
}