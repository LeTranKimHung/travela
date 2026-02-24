<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clients\Tours;

class TourController extends Controller
{
    private $tours;

    public function __construct()
    {
        $this->tours = new Tours();
    }

    // Route: GET /tours
    public function index(Request $request)
    {
        $filters = $request->all();
        $title  = "Danh sách Tour";
        $tours  = $this->tours->getAllTours($filters);
        return view('clients.error.tour', compact('title', 'tours', 'filters'));
    }

    // Route: GET /filter-tours
    public function filterTours(Request $request)
    {
        $filters = [
            'domain'       => $request->input('domain'),
            'destination'  => $request->input('destination'),
            'time'         => $request->input('time'),
            'quantity'     => $request->input('quantity'),
            'price_min'    => $request->input('price_min'),
            'price_max'    => $request->input('price_max'),
            'availability' => $request->input('availability'),
            'start_date'   => $request->input('start_date'),
            'end_date'     => $request->input('end_date'),
        ];

        // Loại bỏ các filter null/rỗng
        $filters = array_filter($filters, function ($value) {
            return !is_null($value) && $value !== '';
        });

        $title = "Kết quả lọc Tour";
        $tours = $this->tours->getAllTours($filters);

        return view('clients.error.tour', compact('title', 'tours', 'filters'));
    }
}
