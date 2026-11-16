<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengumuman;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PengumumanController extends Controller
{
    // ==============================
    // ADMIN - INDEX
    // ==============================
    public function index(Request $request)
    {
        $query = Pengumuman::with('kategori');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('isi', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $pengumumans = $query
            ->orderBy('tanggal_upload', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $kategoriList = KategoriPengumuman::withCount('pengumumans')
            ->orderBy('urutan')
            ->orderBy('nama')
            ->get();

        $totalPengumuman = Pengumuman::count();
        $totalWithPdf = Pengumuman::whereNotNull('file_pdf')->where('file_pdf', '!=', '')->count();

        return view('admin.pengumuman', compact('pengumumans', 'kategoriList', 'totalPengumuman', 'totalWithPdf'));
    }

    // ==============================
    // ADMIN - STORE
    // ==============================
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'nullable|exists:kategori_pengumumen,id',
            'isi' => 'required|string',
            'tanggal_upload' => 'required|date',
            'file_pdf' => 'nullable|mimes:pdf|max:10240',
        ], [
            'judul.required' => 'Judul pengumuman wajib diisi.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            'isi.required' => 'Isi uraian pengumuman wajib diisi.',
            'tanggal_upload.required' => 'Tanggal publikasi wajib diisi.',
            'file_pdf.mimes' => 'Berkas lampiran harus berformat PDF.',
            'file_pdf.max' => 'Ukuran berkas PDF maksimal 10 MB.',
        ]);

        $fileName = null;

        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');
            $fileName = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pengumuman'), $fileName);
        }

        Pengumuman::create([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'isi' => $request->isi,
            'tanggal_upload' => $request->tanggal_upload,
            'file_pdf' => $fileName,
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    // ==============================
    // ADMIN - UPDATE
    // ==============================
    public function update(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'nullable|exists:kategori_pengumumen,id',
            'isi' => 'required|string',
            'tanggal_upload' => 'required|date',
            'file_pdf' => 'nullable|mimes:pdf|max:10240',
        ], [
            'judul.required' => 'Judul pengumuman wajib diisi.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            'isi.required' => 'Isi uraian pengumuman wajib diisi.',
            'tanggal_upload.required' => 'Tanggal publikasi wajib diisi.',
            'file_pdf.mimes' => 'Berkas lampiran harus berformat PDF.',
            'file_pdf.max' => 'Ukuran berkas PDF maksimal 10 MB.',
        ]);

        $fileName = $pengumuman->file_pdf;

        if ($request->hasFile('file_pdf')) {
            if ($fileName && File::exists(public_path('uploads/pengumuman/' . $fileName))) {
                File::delete(public_path('uploads/pengumuman/' . $fileName));
            }

            $file = $request->file('file_pdf');
            $fileName = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pengumuman'), $fileName);
        }

        $pengumuman->update([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'isi' => $request->isi,
            'tanggal_upload' => $request->tanggal_upload,
            'file_pdf' => $fileName,
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    // ==============================
    // ADMIN - DELETE
    // ==============================
    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        if ($pengumuman->file_pdf && File::exists(public_path('uploads/pengumuman/' . $pengumuman->file_pdf))) {
            File::delete(public_path('uploads/pengumuman/' . $pengumuman->file_pdf));
        }

        $pengumuman->delete();

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }

    // ==============================
    // ADMIN - KATEGORI PENGUMUMAN CRUD
    // ==============================
    public function storeKategori(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:kategori_pengumumen,nama',
        ], [
            'nama.required' => 'Nama kategori pengumuman wajib diisi.',
            'nama.unique' => 'Nama kategori ini sudah terdaftar.',
        ]);

        KategoriPengumuman::create([
            'nama' => trim($request->nama),
            'slug' => Str::slug($request->nama),
            'urutan' => (KategoriPengumuman::max('urutan') ?? 0) + 1,
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Kategori pengumuman baru berhasil ditambahkan.');
    }

    public function updateKategori(Request $request, $id)
    {
        $kategori = KategoriPengumuman::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100|unique:kategori_pengumumen,nama,' . $id,
        ], [
            'nama.required' => 'Nama kategori pengumuman wajib diisi.',
            'nama.unique' => 'Nama kategori ini sudah terdaftar.',
        ]);

        $kategori->update([
            'nama' => trim($request->nama),
            'slug' => Str::slug($request->nama),
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Kategori pengumuman berhasil diperbarui.');
    }

    public function destroyKategori($id)
    {
        $kategori = KategoriPengumuman::findOrFail($id);
        $kategori->delete();

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Kategori pengumuman berhasil dihapus.');
    }

    // ==============================
    // USER - INDEX (PORTAL PUBLIK)
    // ==============================
    public function userIndex(Request $request)
    {
        $query = Pengumuman::with('kategori');

        // 1. Pencarian Kata Kunci
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('isi', 'like', '%' . $search . '%');
            });
        }

        // 2. Filter Kategori Dinamis
        $kategoriSlug = $request->get('kategori');
        if ($kategoriSlug) {
            $query->whereHas('kategori', function ($q) use ($kategoriSlug) {
                $q->where('slug', $kategoriSlug);
            });
        }

        // 3. Pengurutan Hasil
        $sort = $request->get('sort', 'terbaru');
        if ($sort === 'terlama') {
            $query->orderBy('tanggal_upload', 'asc')->orderBy('created_at', 'asc');
        } elseif ($sort === 'judul_asc') {
            $query->orderBy('judul', 'asc');
        } elseif ($sort === 'judul_desc') {
            $query->orderBy('judul', 'desc');
        } else {
            $query->orderBy('tanggal_upload', 'desc')->orderBy('created_at', 'desc');
        }

        $pengumumans = $query
            ->paginate(8)
            ->withQueryString();

        // Data Kategori Dinamis dengan Counter Relasi
        $kategoriList = KategoriPengumuman::withCount('pengumumans')
            ->orderBy('urutan')
            ->orderBy('nama')
            ->get();

        $totalAll = Pengumuman::count();

        // Kategori aktif saat ini jika ada
        $activeKategori = $kategoriSlug ? KategoriPengumuman::where('slug', $kategoriSlug)->first() : null;

        return view('user.pengumuman', compact(
            'pengumumans',
            'sort',
            'kategoriSlug',
            'kategoriList',
            'totalAll',
            'activeKategori'
        ));
    }

    // ==============================
    // USER - DETAIL
    // ==============================
    public function show($id)
    {
        $pengumuman = Pengumuman::with('kategori')->findOrFail($id);

        return view('user.pengumuman-detail', compact('pengumuman'));
    }
}
