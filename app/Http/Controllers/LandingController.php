<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Department;

class LandingController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('nama_layanan')->get();
        return view('landing.index', compact('services'));
    }

    public function pelajariLebihLanjut()
    {
        $bidangs = Department::with('services')
            ->where('status', 1)
            ->get()
            ->map(function ($dept) {
                return [
                    'nama'    => $dept->nama_bidang,
                    'layanan' => $dept->services->where('status', 1)->pluck('nama_layanan'),
                ];
            });
        return view('landing.pelajari-lebih-lanjut', compact('bidangs'));
    }
}