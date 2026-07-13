<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile');
    }

   public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->instansi = $request->instansi;

        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($user->foto) {
                Storage::disk('public')->delete('profile/'.$user->foto);
            }

          // Simpan foto baru
            $path = $request->file('foto')->store('profile', 'public');

            // Simpan nama file ke database
            $user->foto = basename($path);
            }

        $user->save();

        return redirect()
                ->back()
                ->with('success', 'Profil berhasil diperbarui.');
    }
    public function password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Cek password lama
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Password lama salah.');
        }

        // Simpan password baru
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
}