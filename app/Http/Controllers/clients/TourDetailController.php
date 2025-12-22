<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clients\Tours; // Ensure the model path is correct

class TourDetailController extends Controller
{
    private $tours;
    public function __construct()
    {
        $this->tours = new Tours();
    }

    public function index($id = 0)
    {
        $title = "Tour Details" ;
        $tourDetail = $this->tours->getTourDetail($id);
        return view('clients.error.tour-detail', compact('title', 'tourDetail'));
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
