<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
        public function index(Request $request)
    {
        $admin = auth()->user();
        $search = $request->search;

        $services = Service::when($admin->isScopedToDepartment(), function ($query) use ($admin) {
                $query->where('department_id', $admin->department_id);
            })
            ->when($search, function ($query) use ($search) {
                $query->where('nama_layanan', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.service.index', compact('services', 'search'));
    }

    public function create()
    {
        $admin = auth()->user();
        $departments = $admin->isScopedToDepartment()
            ? Department::where('id', $admin->department_id)->get()
            : Department::where('status', 1)->get();

        return view('admin.service.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bidang' => 'required|max:255',
            'nama_layanan' => 'required|max:255',
            'deskripsi' => 'required',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'sla' => 'required|integer|min:1',
            'status' => 'required'
        ]);

        $department = $this->resolveDepartment($request->nama_bidang);
        $department = $this->resolveDepartment($request->nama_bidang);

        $admin = auth()->user();
        if ($admin->isScopedToDepartment() && $department->id != $admin->department_id) {
            abort(403, 'Anda hanya bisa menambahkan layanan untuk bidang Anda sendiri.');
        }

        $data = $request->except('icon', 'nama_bidang');
        $data['department_id'] = $department->id;

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('services', 'public');
        }

        Service::create($data);

        return redirect()
            ->route('admin.service.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        $admin = auth()->user();

        if ($admin->isScopedToDepartment() && $service->department_id != $admin->department_id) {
            abort(403, 'Layanan ini bukan bagian dari bidang Anda.');
        }

        $departments = Department::where('status', 1)->get();
        return view('admin.service.edit', compact('service', 'departments'));
    }

    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);
        $admin = auth()->user();

    if ($admin->isScopedToDepartment() && $service->department_id != $admin->department_id) {
        abort(403, 'Layanan ini bukan bagian dari bidang Anda.');
    }
        $request->validate([
            'nama_bidang' => 'required|max:255',
            'nama_layanan' => 'required|max:255',
            'deskripsi' => 'required',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'sla' => 'required|integer|min:1',
            'status' => 'required'
        ]);

        $service = Service::findOrFail($id);

        $department = $this->resolveDepartment($request->nama_bidang);

        $data = $request->except('icon', 'hapus_icon', 'nama_bidang');
        $data['department_id'] = $department->id;

        if ($request->hasFile('icon')) {

            if ($service->icon && Storage::disk('public')->exists($service->icon)) {
                Storage::disk('public')->delete($service->icon);
            }

            $data['icon'] = $request->file('icon')->store('services', 'public');

        } elseif ($request->boolean('hapus_icon')) {

            if ($service->icon && Storage::disk('public')->exists($service->icon)) {
                Storage::disk('public')->delete($service->icon);
            }

            $data['icon'] = null;

        }

        $service->update($data);

        return redirect()
            ->route('admin.service.index')
            ->with('success', 'Layanan berhasil diubah.');
    }

   public function destroy(string $id)
    {
        $service = Service::find($id);

    if (! $service) {
        return redirect()->route('admin.service.index')
            ->with('error', 'Layanan tidak ditemukan, mungkin sudah terhapus sebelumnya.');
    }

    $admin = auth()->user();
    if ($admin->isScopedToDepartment() && $service->department_id != $admin->department_id) {
        abort(403, 'Layanan ini bukan bagian dari bidang Anda.');
    }

        if (! $service) {
            return redirect()
                ->route('admin.service.index')
                ->with('error', 'Layanan tidak ditemukan, mungkin sudah terhapus sebelumnya.');
        }

        if ($service->icon && Storage::disk('public')->exists($service->icon)) {
            Storage::disk('public')->delete($service->icon);
        }

        $service->delete();

        return redirect()
            ->route('admin.service.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
    
    private function resolveDepartment(string $namaBidang): Department
    {
        $namaBidang = trim($namaBidang);

        $existing = Department::whereRaw('LOWER(nama_bidang) = ?', [strtolower($namaBidang)])
            ->first();

        if ($existing) {
            return $existing;
        }

        $agencyId = Department::value('agency_id') ?? 1;

        return Department::create([
            'nama_bidang' => $namaBidang,
            'agency_id' => $agencyId,
            'status' => 1,
        ]);
    }
}