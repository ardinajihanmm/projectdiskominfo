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
    $search = $request->search;

    $services = Service::when($search, function ($query) use ($search) {
        $query->where('nama_layanan', 'like', "%{$search}%")
              ->orWhere('deskripsi', 'like', "%{$search}%");
    })
    ->latest()
    ->paginate(10);

    return view('admin.service.index', compact('services', 'search'));
    }

    public function create()
    {
        $departments = Department::where('status', 1)->get();

        return view('admin.service.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'nama_layanan' => 'required|max:255',
            'deskripsi' => 'required',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'sla' => 'required|integer|min:1',
            'status' => 'required'
        ]);

        $data = $request->except('icon');

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
        //
    }

    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        $departments = Department::where('status', 1)->get();

        return view('admin.service.edit', compact('service', 'departments'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'nama_layanan' => 'required|max:255',
            'deskripsi' => 'required',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'sla' => 'required|integer|min:1',
            'status' => 'required'
        ]);

        $service = Service::findOrFail($id);
        $data = $request->except('icon', 'hapus_icon');

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
        $service = Service::findOrFail($id);

        if ($service->icon && Storage::disk('public')->exists($service->icon)) {
            Storage::disk('public')->delete($service->icon);
        }

        $service->delete();

        return redirect()
            ->route('admin.service.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}