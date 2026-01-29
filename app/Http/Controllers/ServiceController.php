<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Menampilkan daftar layanan
     */
    public function index()
    {
        $services = Service::orderBy('tipe')->orderBy('urutan')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Menampilkan form tambah layanan
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Menyimpan layanan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'icon' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'nullable|string|max:30',
            'tipe' => 'required|in:layanan,paket',
            'is_featured' => 'boolean',
            'urutan' => 'nullable|integer',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['urutan'] = $validated['urutan'] ?? 0;

        Service::create($validated);

        return redirect()->route('services.index')
            ->with('success', 'Layanan berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit layanan
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Mengupdate layanan
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'icon' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'nullable|string|max:30',
            'tipe' => 'required|in:layanan,paket',
            'is_featured' => 'boolean',
            'urutan' => 'nullable|integer',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        $service->update($validated);

        return redirect()->route('services.index')
            ->with('success', 'Layanan berhasil diperbarui!');
    }

    /**
     * Menghapus layanan
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Layanan berhasil dihapus!');
    }
}
