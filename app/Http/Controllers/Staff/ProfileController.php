<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
    'name'      => 'required|string|max:255',
    'email'     => 'required|email|unique:users,email,' . $user->id,
    'no_hp'     => 'nullable|string|max:20',
    'instansi'  => 'nullable|string|max:255',
    'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
],[
    'foto.image' => 'File harus berupa gambar.',
    'foto.mimes' => 'Foto harus berformat JPG, JPEG, atau PNG.',
    'foto.max'   => 'Ukuran foto maksimal 2 MB.',
]);

  if ($request->hasFile('foto')) {

    if ($user->foto && Storage::disk('public')->exists($user->foto)) {
        Storage::disk('public')->delete($user->foto);
    }

    $path = $request->file('foto')->store('staff/profile', 'public');

    $user->foto = $path;
}

    $user->name = $request->name;
    $user->email = $request->email;
    $user->no_hp = $request->no_hp;
    $user->instansi = $request->instansi;

    $user->save();

    return back()->with('success', 'Profil berhasil diperbarui.');
}

    /**
     * Update Password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
}