<?php

namespace App\Http\Controllers;

use App\Models\JenisPeraturan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JenisPeraturanController extends Controller
{
    /**
     * Tampilkan daftar Jenis Peraturan di Admin (Submenu 1)
     */
    public function index()
    {
        $jenisPeraturans = JenisPeraturan::withCount('peraturans')
            ->orderBy('urutan')
            ->get();

        return view('admin.jenis-peraturan', compact('jenisPeraturans'));
    }

    /**
     * Simpan Jenis Peraturan Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:jenis_peraturans,nama',
            'singkatan' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0',
        ], [
            'nama.required' => 'Nama jenis peraturan wajib diisi.',
            'nama.unique' => 'Nama jenis peraturan sudah ada.',
        ]);

        JenisPeraturan::create([
            'nama' => $request->nama,
            'singkatan' => strtoupper($request->singkatan ?? Str::slug($request->nama)),
            'slug' => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi,
            'urutan' => $request->urutan ?? 0,
            'is_active' => true,
        ]);

        return redirect()->route('admin.jenis-peraturan.index')
            ->with('success', 'Jenis Peraturan berhasil ditambahkan.');
    }

    /**
     * Update Jenis Peraturan
     */
    public function update(Request $request, $id)
    {
        $jenis = JenisPeraturan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255|unique:jenis_peraturans,nama,' . $id,
            'singkatan' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $jenis->update([
            'nama' => $request->nama,
            'singkatan' => strtoupper($request->singkatan ?? $jenis->singkatan),
            'slug' => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi,
            'urutan' => $request->urutan ?? $jenis->urutan,
            'is_active' => $request->has('is_active') ? (bool)$request->is_active : true,
        ]);

        return redirect()->route('admin.jenis-peraturan.index')
            ->with('success', 'Jenis Peraturan berhasil diperbarui.');
    }

    /**
     * Hapus Jenis Peraturan
     */
    public function destroy($id)
    {
        $jenis = JenisPeraturan::withCount('peraturans')->findOrFail($id);

        if ($jenis->peraturans_count > 0) {
            return redirect()->route('admin.jenis-peraturan.index')
                ->with('error', "Jenis peraturan '{$jenis->nama}' tidak dapat dihapus karena masih memiliki {$jenis->peraturans_count} dokumen peraturan!");
        }

        $jenis->delete();

        return redirect()->route('admin.jenis-peraturan.index')
            ->with('success', 'Jenis Peraturan berhasil dihapus.');
    }
}

