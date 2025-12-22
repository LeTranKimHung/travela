<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clients\Home; // Ensure this path is correct
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
       return view('clients.error.home', compact('title', 'tours'));
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
