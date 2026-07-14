<?php

namespace App\Http\Controllers;

use App\Models\Service;

class LandingController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return view('landing.index', compact('services'));
    }
}