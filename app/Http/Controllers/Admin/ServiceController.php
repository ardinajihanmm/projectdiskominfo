<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Department;
use Illuminate\Http\Request;

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
            'sla' => 'required|integer|min:1',
            'status' => 'required'
        ]);

        Service::create($request->all());

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
            'sla' => 'required|integer|min:1',
            'status' => 'required'
        ]);

        $service = Service::findOrFail($id);
        $service->update($request->all());

        return redirect()
            ->route('admin.service.index')
            ->with('success', 'Layanan berhasil diubah.');
    }

    public function destroy(string $id)
    {
        Service::findOrFail($id)->delete();

        return redirect()
            ->route('admin.service.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}