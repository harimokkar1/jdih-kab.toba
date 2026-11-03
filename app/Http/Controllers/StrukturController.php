<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Carousel;

class StrukturController extends Controller
{
    /**
     * Halaman user
     */
    public function index()
    {
        $struktur = StrukturOrganisasi::whereNull('parent_id')
            ->with('children')
            ->get();

        $carousels = Carousel::latest()->get();

        return view('user.organisasi', compact(
            'struktur',
            'carousels'
        ));
    }

    /**
     * Halaman admin
     */
    public function admin()
    {
        $struktur = StrukturOrganisasi::with('parent')
            ->orderBy('tingkat')
            ->orderBy('urutan')
            ->paginate(10);

        return view('admin.struktur', compact('struktur'));
    }

    /**
     * Form tambah
     */
    public function create()
    {
        $parent = StrukturOrganisasi::orderBy('tingkat')
            ->orderBy('urutan')
            ->get();

        return view('admin.struktur-create', compact('parent'));
    }

    /**
     * Simpan data
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tingkat' => 'required|integer|min:1',
            'parent_id' => 'nullable|exists:struktur_organisasis,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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
            $data['foto'] = $request->file('foto')
                ->store('struktur', 'public');
        }

        StrukturOrganisasi::create($data);

        return redirect()
            ->route('admin.struktur')
            ->with('success', 'Struktur organisasi berhasil ditambahkan.');
    }

    /**
     * Form edit
     */
    public function edit($id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);

        $parent = StrukturOrganisasi::where('id', '!=', $id)
            ->orderBy('tingkat')
            ->orderBy('urutan')
            ->get();

        return view('admin.struktur-edit', compact(
            'struktur',
            'parent'
        ));
    }

    /**
     * Update
     */
    public function update(Request $request, $id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tingkat' => 'required|integer|min:1',
            'parent_id' => 'nullable|exists:struktur_organisasis,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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

            $data['foto'] = $request->file('foto')
                ->store('struktur', 'public');
        }

        $struktur->update($data);

        return redirect()
            ->route('admin.struktur')
            ->with('success', 'Struktur organisasi berhasil diperbarui.');
    }

    /**
     * Hapus
     */
    public function destroy($id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);

        if ($struktur->foto) {
            Storage::disk('public')->delete($struktur->foto);
        }

        $struktur->delete();

        return redirect()
            ->route('admin.struktur')
            ->with('success', 'Struktur organisasi berhasil dihapus.');
    }
}
