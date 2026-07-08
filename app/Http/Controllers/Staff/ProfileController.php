<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Halaman Profil
     */
    public function edit()
    {
        return view('staff.profile');
    }

    /**
     * Update Profil
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'nullable|string|max:20',
            'instansi' => 'nullable|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'instansi' => $request->instansi,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Update Password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}