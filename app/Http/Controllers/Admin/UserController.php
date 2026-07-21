<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Department; 
use App\Http\Controllers\Controller;   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index(Request $request)
    {
    $admin = auth()->user();
    $search = $request->search;

    $users = User::when($admin->isScopedToDepartment(), function ($query) use ($admin) {
            $query->where(function ($q) use ($admin) {
                $q->where('role', '!=', 'staff')
                  ->orWhere('department_id', $admin->department_id);
            });
        })
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('instansi', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->paginate(10);

    return view('admin.user.index', compact('users', 'search'));
    }
    public function create()
    {
    $departments = Department::orderBy('nama_bidang')->get();
    return view('admin.user.create', compact('departments'));
    }

    public function store(Request $request)
    {
    $admin = auth()->user();
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required|in:admin,staff,user',
        'department_id' => 'nullable|exists:departments,id',
    ]);

    User::create([
    'name' => $request->name,
    'email' => $request->email,
    'no_hp' => $request->no_hp,
    'instansi' => $request->instansi,
    'password' => Hash::make($request->password),
    'role' => $request->role,
    'department_id' => in_array($request->role, ['staff', 'admin'])
        ? ($admin->isScopedToDepartment() ? $admin->department_id : $request->department_id)
        : null,
    ]);

    return redirect()->route('admin.user.index')
        ->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
    $admin = auth()->user();

    if ($admin->isScopedToDepartment() && $user->role === 'staff' && $user->department_id != $admin->department_id) {
        abort(403, 'Staff ini bukan bagian dari bidang Anda.');
    }

    $departments = Department::orderBy('nama_bidang')->get();
    return view('admin.user.edit', compact('user', 'departments'));
    }

    public function update(Request $request, User $user)
    {
    $admin = auth()->user();

    if ($admin->isScopedToDepartment() && $user->role === 'staff' && $user->department_id != $admin->department_id) {
        abort(403, 'Staff ini bukan bagian dari bidang Anda.');
    }
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|in:admin,staff,user',
        'department_id' => 'nullable|exists:departments,id',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'no_hp' => $request->no_hp,
        'instansi' => $request->instansi,
        'role' => $request->role,
        'department_id' => in_array($request->role, ['staff', 'admin']) ? $request->department_id : null,
    ]);

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil dihapus');
    }
}