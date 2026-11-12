<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PengumumanController extends Controller
{
    // ==============================
    // ADMIN - INDEX
    // ==============================
    public function index(Request $request)
    {
        $query = Pengumuman::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('isi', 'like', '%' . $search . '%');
            });
        }

        $pengumumans = $query
            ->orderBy('tanggal_upload', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.pengumuman', compact('pengumumans'));
    }

    // ==============================
    // ADMIN - STORE
    // ==============================
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal_upload' => 'required|date',
            'file_pdf' => 'nullable|mimes:pdf|max:10240',
        ]);

        $fileName = null;

        if ($request->hasFile('file_pdf')) {

            $file = $request->file('file_pdf');

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/pengumuman'),
                $fileName
            );
        }

        Pengumuman::create([
            'judul' => $request->judul,
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
            'isi' => 'required|string',
            'tanggal_upload' => 'required|date',
            'file_pdf' => 'nullable|mimes:pdf|max:10240',
        ]);

        $fileName = $pengumuman->file_pdf;

        if ($request->hasFile('file_pdf')) {

            if (
                $fileName &&
                File::exists(public_path('uploads/pengumuman/' . $fileName))
            ) {
                File::delete(
                    public_path('uploads/pengumuman/' . $fileName)
                );
            }

            $file = $request->file('file_pdf');

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/pengumuman'),
                $fileName
            );
        }

        $pengumuman->update([
            'judul' => $request->judul,
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

        if (
            $pengumuman->file_pdf &&
            File::exists(
                public_path('uploads/pengumuman/' . $pengumuman->file_pdf)
            )
        ) {
            File::delete(
                public_path('uploads/pengumuman/' . $pengumuman->file_pdf)
            );
        }

        $pengumuman->delete();

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }


    // ==============================
    // USER - INDEX
    // ==============================
    public function userIndex(Request $request)
    {   
        $query = Pengumuman::query();

        // 1. Pencarian Kata Kunci
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('isi', 'like', '%' . $search . '%');
            });
        }

        // 2. Filter Tahun
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_upload', $request->tahun);
        }

        // 3. Filter Kategori Cepat
        $kategori = $request->get('kategori');
        if ($kategori === 'uji-publik') {
            $query->where(function($q) {
                $q->where('judul', 'like', '%uji publik%')
                  ->orWhere('judul', 'like', '%konsultasi publik%');
            });
        } elseif ($kategori === 'jadwal-pelayanan') {
            $query->where(function($q) {
                $q->where('judul', 'like', '%jadwal%')
                  ->orWhere('judul', 'like', '%pelayanan%')
                  ->orWhere('judul', 'like', '%fasilitasi%')
                  ->orWhere('judul', 'like', '%verifikasi%');
            });
        } elseif ($kategori === 'maklumat-edaran') {
            $query->where(function($q) {
                $q->where('judul', 'like', '%maklumat%')
                  ->orWhere('judul', 'like', '%edaran%')
                  ->orWhere('judul', 'like', '%pemeliharaan%')
                  ->orWhere('judul', 'like', '%pemberitahuan%');
            });
        } elseif ($kategori === 'sosialisasi') {
            $query->where(function($q) {
                $q->where('judul', 'like', '%sosialisasi%')
                  ->orWhere('judul', 'like', '%bimtek%')
                  ->orWhere('judul', 'like', '%penerapan%');
            });
        }

        // 4. Filter Lampiran PDF
        if ($request->get('pdf') === '1') {
            $query->whereNotNull('file_pdf')->where('file_pdf', '!=', '');
        }

        // 5. Pengurutan Hasil
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

        // Hitung Counter untuk Sidebar Filter
        $allPengumumans = Pengumuman::all();
        $totalAll = $allPengumumans->count();

        $countUjiPublik = $allPengumumans->filter(function($item) {
            $j = strtolower($item->judul);
            return str_contains($j, 'uji publik') || str_contains($j, 'konsultasi publik');
        })->count();

        $countJadwal = $allPengumumans->filter(function($item) {
            $j = strtolower($item->judul);
            return str_contains($j, 'jadwal') || str_contains($j, 'pelayanan') || str_contains($j, 'fasilitasi') || str_contains($j, 'verifikasi');
        })->count();

        $countMaklumat = $allPengumumans->filter(function($item) {
            $j = strtolower($item->judul);
            return str_contains($j, 'maklumat') || str_contains($j, 'edaran') || str_contains($j, 'pemeliharaan') || str_contains($j, 'pemberitahuan');
        })->count();

        $countSosialisasi = $allPengumumans->filter(function($item) {
            $j = strtolower($item->judul);
            return str_contains($j, 'sosialisasi') || str_contains($j, 'bimtek') || str_contains($j, 'penerapan');
        })->count();

        $countWithPdf = $allPengumumans->filter(function($item) {
            return !empty($item->file_pdf);
        })->count();

        $availableYears = $allPengumumans->filter(function($item) {
            return !empty($item->tanggal_upload);
        })->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->tanggal_upload)->format('Y');
        })->map(function($group) {
            return $group->count();
        })->sortKeysDesc();

        return view('user.pengumuman', compact(
            'pengumumans',
            'sort',
            'kategori',
            'totalAll',
            'countUjiPublik',
            'countJadwal',
            'countMaklumat',
            'countSosialisasi',
            'countWithPdf',
            'availableYears'
        ));
    }


    // ==============================
    // USER - DETAIL
    // ==============================
    public function show($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        return view(
            'user.pengumuman-detail',
            compact('pengumuman')
        );
    }
}
