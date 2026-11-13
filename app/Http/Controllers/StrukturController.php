<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturController extends Controller
{
    /**
     * Halaman Publik Struktur Organisasi
     */
    public function index()
    {
        $allStruktur = StrukturOrganisasi::orderBy('tingkat')
            ->orderBy('urutan')
            ->get();

        $struktur = StrukturOrganisasi::whereNull('parent_id')
            ->with('children')
            ->orderBy('urutan')
            ->get();

        return view('user.organisasi', compact('struktur', 'allStruktur'));
    }

    /**
     * Halaman Admin Struktur Organisasi
     */
    public function admin()
    {
        $struktur = StrukturOrganisasi::with('parent')
            ->orderBy('tingkat')
            ->orderBy('urutan')
            ->paginate(15);

        $allParents = StrukturOrganisasi::orderBy('tingkat')->orderBy('urutan')->get();

        return view('admin.struktur', compact('struktur', 'allParents'));
    }

    /**
     * Simpan Data Struktur Organisasi
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tingkat' => 'required|integer|min:1',
            'parent_id' => 'nullable|exists:struktur_organisasis,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'urutan' => 'nullable|integer|min:0',
        ], [
            'nama.required' => 'Nama pejabat/staf wajib diisi.',
            'jabatan.required' => 'Nama jabatan wajib diisi.',
            'tingkat.required' => 'Level hierarki wajib diisi.',
            'foto.image' => 'File foto harus berupa gambar.',
        ]);

        $data = $request->only([
            'nama',
            'jabatan',
            'tingkat',
            'parent_id',
            'urutan',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('struktur', 'public');
        }

        StrukturOrganisasi::create($data);

        return redirect()->route('admin.struktur')
            ->with('success', 'Struktur organisasi berhasil ditambahkan.');
    }

    /**
     * Update Data Struktur Organisasi
     */
    public function update(Request $request, $id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tingkat' => 'required|integer|min:1',
            'parent_id' => 'nullable|exists:struktur_organisasis,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $data = $request->only([
            'nama',
            'jabatan',
            'tingkat',
            'parent_id',
            'urutan',
        ]);

        if ($request->hasFile('foto')) {
            if ($struktur->foto) {
                Storage::disk('public')->delete($struktur->foto);
            }

            $data['foto'] = $request->file('foto')->store('struktur', 'public');
        }

        $struktur->update($data);

        return redirect()->route('admin.struktur')
            ->with('success', 'Struktur organisasi berhasil diperbarui.');
    }

    /**
     * Hapus Data Struktur Organisasi
     */
    public function destroy($id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);

        if ($struktur->foto) {
            Storage::disk('public')->delete($struktur->foto);
        }

        $struktur->delete();

        return redirect()->route('admin.struktur')
            ->with('success', 'Struktur organisasi berhasil dihapus.');
    }
}
