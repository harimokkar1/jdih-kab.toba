<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar berita di halaman admin
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $beritas = Berita::query()
            ->when($search, function ($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('isi', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.berita', compact('beritas'));
    }

    /**
     * Menampilkan form tambah berita
     */
    public function create()
    {
        return view('admin.berita-create');
    }


    /**
     * Menyimpan berita baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ], [
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            'judul.required' => 'Judul berita wajib diisi.',
            'isi.required' => 'Isi berita wajib diisi.',
        ]);

        $namaGambar = null;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaGambar = time() . '_' . $file->getClientOriginalName();
            $file->move(
                public_path('uploads/berita'),
                $namaGambar
            );
        }

        Berita::create([
            'gambar' => $namaGambar,
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil ditambahkan.');
    }


    /**
     * Menampilkan form edit berita
     */
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita-edit', compact('berita'));
    }

    /**
     * Mengupdate berita
     */
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ], [
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            'judul.required' => 'Judul berita wajib diisi.',
            'isi.required' => 'Isi berita wajib diisi.',
        ]);

        // Jika upload gambar baru
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama
            if (
                $berita->gambar &&
                File::exists(public_path('uploads/berita/' . $berita->gambar))
            ) {
                File::delete(
                    public_path('uploads/berita/' . $berita->gambar)
                );
            }

            $file = $request->file('gambar');
            $namaGambar = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/berita'),
                $namaGambar
            );
            $berita->gambar = $namaGambar;
        }

        $berita->judul = $request->judul;
        $berita->isi = $request->isi;
        $berita->save();

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil diperbarui.');
    }


    /**
     * Menghapus berita
     */
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus gambar
        if (
            $berita->gambar &&
            File::exists(public_path('uploads/berita/' . $berita->gambar))
        ) {
            File::delete(
                public_path('uploads/berita/' . $berita->gambar)
            );
        }

        $berita->delete();

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil dihapus.');
    }


    /**
     * Menampilkan daftar berita untuk user
     */
    public function userIndex()
    {
        // 6 berita per halaman
        $beritas = Berita::latest()->paginate(6);

        return view('user.berita', compact('beritas'));
    }


    /**
     * Menampilkan detail berita untuk user
     */
    public function show($id)
    {
        $berita = Berita::findOrFail($id);

        return view('user.berita-detail', compact('berita'));
    }
}
