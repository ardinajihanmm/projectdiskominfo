<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Halaman Timeline Aktivitas
     */
    public function activity()
    {
        return view('staff.profile.activity');
    }

    /**
     * Halaman Edit Profil
     * (Nanti kita isi)
     */
    public function edit()
    {
        return view('staff.profile.edit');
    }

    /**
     * Update Profil
     * (Nanti kita isi)
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Update Password
     * (Nanti kita isi)
     */
    public function password(Request $request)
    {
        //
    }
}