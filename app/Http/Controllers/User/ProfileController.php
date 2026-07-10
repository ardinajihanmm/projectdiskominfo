<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function index()
{
    $user = Auth::user();

    return view('user.profile', compact('user'));
}

public function update(Request $request)
{
    $request->validate([
        'name'      => 'required|max:255',
        'email'     => 'required|email|unique:users,email,' . Auth::id(),
        'no_hp'     => 'required|max:20',
        'instansi'  => 'required|max:255',
        'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = Auth::user();

    // Upload foto baru
    if ($request->hasFile('foto')) {

        // Hapus foto lama jika ada
        if ($user->foto && Storage::disk('public')->exists($user->foto)) {

            Storage::disk('public')->delete($user->foto);

        }

        // Simpan foto baru
        $path = $request->file('foto')->store('profile', 'public');

    } else {

        $path = $user->foto;

    }

    $user->update([
        'name'      => $request->name,
        'email'     => $request->email,
        'no_hp'     => $request->no_hp,
        'instansi'  => $request->instansi,
        'foto'      => $path,
    ]);

    return redirect()
        ->route('user.profile')
        ->with('success', 'Profil berhasil diperbarui.');
}

public function password(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {

        return back()->withErrors([
            'current_password' => 'Password lama tidak sesuai.'
        ]);

    }

    $user->update([
        'password' => Hash::make($request->password)
    ]);

    return back()->with('success_password', 'Password berhasil diubah.');
}
}