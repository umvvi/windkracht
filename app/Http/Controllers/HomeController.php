<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show public homepage
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show packages
     */
    public function packages()
    {
        $packages = \App\Models\Package::all();
        return view('packages', compact('packages'));
    }

    /**
     * Show locations
     */
    public function locations()
    {
        $locations = \App\Models\Location::all();
        return view('locations', compact('locations'));
    }

    /**
     * Show about page
     */
    public function about()
    {
        return view('about');
    }
}
