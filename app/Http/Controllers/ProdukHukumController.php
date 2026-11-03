<?php

namespace App\Http\Controllers;

use App\Models\JenisPeraturan;
use App\Models\Peraturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProdukHukumController extends Controller
{
    /**
     * ============================================================
     * USER AREA
     * ============================================================
     */

    /**
     * Halaman Produk Hukum Global (Requirement #4)
     * Menampilkan semua jenis produk hukum beserta jumlah peraturannya
     */
    public function globalIndex(Request $request)
    {
        $jenisPeraturans = JenisPeraturan::where('is_active', true)
            ->withCount('peraturans')
            ->orderBy('urutan')
            ->get();

        $query = Peraturan::with('jenisPeraturan')->latest();

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('jenis_id')) {
            $query->where('jenis_peraturan_id', $request->jenis_id);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $peraturans = $query->paginate(12)->withQueryString();

        $tahunList = Peraturan::whereNotNull('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('user.produk-hukum-global', compact(
            'jenisPeraturans',
            'peraturans',
            'tahunList'
        ));
    }

    /**
     * Halaman Daftar Dokumen berdasarkan Jenis Peraturan (Requirement #4)
     */
    public function listByJenis($slug, Request $request)
    {
        $jenis = JenisPeraturan::where('slug', $slug)->firstOrFail();

        $query = Peraturan::where('jenis_peraturan_id', $jenis->id)->latest();

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $peraturans = $query->paginate(10)->withQueryString();

        $tahunList = Peraturan::where('jenis_peraturan_id', $jenis->id)
            ->whereNotNull('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('user.produk-hukum-list', compact('jenis', 'peraturans', 'tahunList'));
    }

    /**
     * Detail Dokumen Peraturan (Requirement #4)
     */
    public function detail($id)
    {
        $peraturan = Peraturan::with('jenisPeraturan')->findOrFail($id);

        // Increment view count
        $peraturan->increment('view_count');

        // Rekomendasi / Peraturan Terkait
        $terkait = Peraturan::where('jenis_peraturan_id', $peraturan->jenis_peraturan_id)
            ->where('id', '!=', $peraturan->id)
            ->latest()
            ->take(4)
            ->get();

        return view('user.produk-hukum-detail', compact('peraturan', 'terkait'));
    }

    /**
     * Download Dokumen dan Increment Download Count
     */
    public function download($id, $type = 'dokumen')
    {
        $peraturan = Peraturan::findOrFail($id);

        $field = match ($type) {
            'english' => 'english_version',
            'braille' => 'braille',
            'audio' => 'alih_suara',
            default => 'file_dokumen',
        };

        $file = $peraturan->$field;

        if (empty($file)) {
            return back()->with('error', 'File lampiran tidak tersedia.');
        }

        $peraturan->increment('download_count');

        $fullPath = public_path($file);
        if (!File::exists($fullPath)) {
            // Coba cari di subfolder uploads/produk-hukum
            $altPath = public_path('uploads/produk-hukum/' . basename($file));
            if (File::exists($altPath)) {
                $fullPath = $altPath;
            }
        }

        if (File::exists($fullPath)) {
            return response()->download($fullPath);
        }

        return back()->with('error', 'File tidak ditemukan di server.');
    }

    /**
     * ============================================================
     * ADMIN AREA (Submenu 2: Isi Peraturan)
     * ============================================================
     */

    /**
     * Tampilkan Tabel Peraturan di Admin
     */
    public function adminIndex(Request $request)
    {
        $query = Peraturan::with('jenisPeraturan')->latest();

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('jenis_id')) {
            $query->where('jenis_peraturan_id', $request->jenis_id);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $peraturans = $query->paginate(15)->withQueryString();
        $jenisList = JenisPeraturan::orderBy('urutan')->get();

        return view('admin.peraturan-index', compact('peraturans', 'jenisList'));
    }

    /**
     * Form Tambah Peraturan
     */
    public function create()
    {
        $jenisList = JenisPeraturan::where('is_active', true)->orderBy('urutan')->get();
        return view('admin.peraturan-create', compact('jenisList'));
    }

    /**
     * Simpan Peraturan Baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_peraturan_id' => 'required|exists:jenis_peraturans,id',
            'tipe_dokumen' => 'nullable|string|max:255',
            'judul' => 'required|string',
            'nomor_peraturan' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:2100',
            'singkatan' => 'nullable|string|max:255',
            'teu_badan' => 'nullable|string|max:255',
            'tempat_penetapan' => 'nullable|string|max:255',
            'tanggal_penetapan' => 'nullable|date',
            'tanggal_pengundangan' => 'nullable|date',
            'tanggal_upload' => 'nullable|date',
            'sumber' => 'nullable|string',
            'subjek' => 'nullable|string',
            'bahasa' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'bidang_hukum' => 'nullable|string|max:255',
            'abstrak' => 'nullable|string',
            'status' => 'required|in:BERLAKU,TIDAK BERLAKU',
            'file_dokumen' => 'required|file|mimes:pdf|max:30720',
            'english_version' => 'nullable|file|mimes:pdf|max:30720',
            'braille' => 'nullable|file|mimes:pdf|max:30720',
            'alih_suara' => 'nullable|file|mimes:mp3,wav,m4a,ogg|max:30720',
        ], [
            'jenis_peraturan_id.required' => 'Jenis peraturan wajib dipilih.',
            'judul.required' => 'Judul peraturan wajib diisi.',
            'nomor_peraturan.required' => 'Nomor peraturan wajib diisi.',
            'tahun.required' => 'Tahun peraturan wajib diisi.',
            'file_dokumen.required' => 'File dokumen PDF utama wajib diunggah.',
            'file_dokumen.mimes' => 'File dokumen utama harus berformat PDF.',
            'file_dokumen.max' => 'Ukuran file dokumen utama maksimal 30 MB.',
        ]);

        $baseFolder = public_path('uploads/produk-hukum');
        if (!File::exists($baseFolder)) {
            File::makeDirectory($baseFolder, 0755, true);
        }

        // Upload File Utama
        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $cleanName = time() . '_' . Str::random(8) . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.pdf';
            $file->move($baseFolder, $cleanName);
            $validated['file_dokumen'] = 'uploads/produk-hukum/' . $cleanName;
        }

        // Upload English Version
        if ($request->hasFile('english_version')) {
            $file = $request->file('english_version');
            $cleanName = time() . '_en_' . Str::random(8) . '.pdf';
            $file->move($baseFolder, $cleanName);
            $validated['english_version'] = 'uploads/produk-hukum/' . $cleanName;
        }

        // Upload Braille
        if ($request->hasFile('braille')) {
            $file = $request->file('braille');
            $cleanName = time() . '_braille_' . Str::random(8) . '.pdf';
            $file->move($baseFolder, $cleanName);
            $validated['braille'] = 'uploads/produk-hukum/' . $cleanName;
        }

        // Upload Alih Suara
        if ($request->hasFile('alih_suara')) {
            $file = $request->file('alih_suara');
            $cleanName = time() . '_audio_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($baseFolder, $cleanName);
            $validated['alih_suara'] = 'uploads/produk-hukum/' . $cleanName;
        }

        if (empty($validated['tanggal_upload'])) {
            $validated['tanggal_upload'] = now()->format('Y-m-d');
        }

        Peraturan::create($validated);

        return redirect()->route('admin.peraturan.index')
            ->with('success', 'Dokumen peraturan hukum berhasil ditambahkan.');
    }

    /**
     * Form Edit Peraturan
     */
    public function edit($id)
    {
        $peraturan = Peraturan::findOrFail($id);
        $jenisList = JenisPeraturan::where('is_active', true)->orderBy('urutan')->get();

        return view('admin.peraturan-edit', compact('peraturan', 'jenisList'));
    }

    /**
     * Update Peraturan
     */
    public function update(Request $request, $id)
    {
        $peraturan = Peraturan::findOrFail($id);

        $validated = $request->validate([
            'jenis_peraturan_id' => 'required|exists:jenis_peraturans,id',
            'tipe_dokumen' => 'nullable|string|max:255',
            'judul' => 'required|string',
            'nomor_peraturan' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:2100',
            'singkatan' => 'nullable|string|max:255',
            'teu_badan' => 'nullable|string|max:255',
            'tempat_penetapan' => 'nullable|string|max:255',
            'tanggal_penetapan' => 'nullable|date',
            'tanggal_pengundangan' => 'nullable|date',
            'tanggal_upload' => 'nullable|date',
            'sumber' => 'nullable|string',
            'subjek' => 'nullable|string',
            'bahasa' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'bidang_hukum' => 'nullable|string|max:255',
            'abstrak' => 'nullable|string',
            'status' => 'required|in:BERLAKU,TIDAK BERLAKU',
            'file_dokumen' => 'nullable|file|mimes:pdf|max:30720',
            'english_version' => 'nullable|file|mimes:pdf|max:30720',
            'braille' => 'nullable|file|mimes:pdf|max:30720',
            'alih_suara' => 'nullable|file|mimes:mp3,wav,m4a,ogg|max:30720',
        ]);

        $baseFolder = public_path('uploads/produk-hukum');
        if (!File::exists($baseFolder)) {
            File::makeDirectory($baseFolder, 0755, true);
        }

        // Handle Dokumen Utama
        if ($request->hasFile('file_dokumen')) {
            $this->safeDeleteFile($peraturan->file_dokumen);
            $file = $request->file('file_dokumen');
            $cleanName = time() . '_' . Str::random(8) . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.pdf';
            $file->move($baseFolder, $cleanName);
            $validated['file_dokumen'] = 'uploads/produk-hukum/' . $cleanName;
        } else {
            unset($validated['file_dokumen']);
        }

        // Handle English
        if ($request->hasFile('english_version')) {
            $this->safeDeleteFile($peraturan->english_version);
            $file = $request->file('english_version');
            $cleanName = time() . '_en_' . Str::random(8) . '.pdf';
            $file->move($baseFolder, $cleanName);
            $validated['english_version'] = 'uploads/produk-hukum/' . $cleanName;
        } else {
            unset($validated['english_version']);
        }

        // Handle Braille
        if ($request->hasFile('braille')) {
            $this->safeDeleteFile($peraturan->braille);
            $file = $request->file('braille');
            $cleanName = time() . '_braille_' . Str::random(8) . '.pdf';
            $file->move($baseFolder, $cleanName);
            $validated['braille'] = 'uploads/produk-hukum/' . $cleanName;
        } else {
            unset($validated['braille']);
        }

        // Handle Audio
        if ($request->hasFile('alih_suara')) {
            $this->safeDeleteFile($peraturan->alih_suara);
            $file = $request->file('alih_suara');
            $cleanName = time() . '_audio_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($baseFolder, $cleanName);
            $validated['alih_suara'] = 'uploads/produk-hukum/' . $cleanName;
        } else {
            unset($validated['alih_suara']);
        }

        $peraturan->update($validated);

        return redirect()->route('admin.peraturan.index')
            ->with('success', 'Dokumen peraturan hukum berhasil diperbarui.');
    }

    /**
     * Hapus Dokumen Peraturan
     */
    public function destroy($id)
    {
        $peraturan = Peraturan::findOrFail($id);

        $this->safeDeleteFile($peraturan->file_dokumen);
        $this->safeDeleteFile($peraturan->english_version);
        $this->safeDeleteFile($peraturan->braille);
        $this->safeDeleteFile($peraturan->alih_suara);

        $peraturan->delete();

        return redirect()->route('admin.peraturan.index')
            ->with('success', 'Dokumen peraturan hukum berhasil dihapus.');
    }

    /**
     * Helper Hapus File Fisik
     */
    private function safeDeleteFile(?string $relativePath): void
    {
        if (empty($relativePath)) {
            return;
        }

        $fullPath = public_path($relativePath);
        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }
}
