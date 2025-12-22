<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clients\Tours;

class PackageController extends Controller
{
    private $tours;
    
    public function __construct()
    {
        $this->tours = new Tours();
    }
    
    public function index(Request $request)
    {
        $title = "Tour Packages";
        
        // Lấy các tham số filter từ request
        $filters = [
            'domain' => $request->input('domain'),
            'destination' => $request->input('destination'),
            'time' => $request->input('time'),
            'quantity' => $request->input('quantity'),
            'price_min' => $request->input('price_min'),
            'price_max' => $request->input('price_max'),
            'availability' => $request->input('availability'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ];
        
        // Lọc bỏ các giá trị null
        $filters = array_filter($filters, function($value) {
            return !is_null($value) && $value !== '';
        });
        
        // Lấy danh sách tour đã lọc
        $tours = $this->tours->getAllTours($filters);
        
        // Lấy dữ liệu cho các dropdown
        $domains = $this->tours->getDomains();
        $destinations = $this->tours->getDestinations();
        $timeOptions = $this->tours->getTimeOptions();
        
        return view('clients.error.packages', compact(
            'title', 
            'tours', 
            'filters',
            'domains',
            'destinations',
            'timeOptions'
        ));
    }
}