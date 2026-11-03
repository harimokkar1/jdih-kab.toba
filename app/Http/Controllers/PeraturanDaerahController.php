<?php

namespace App\Http\Controllers;

use App\Models\PeraturanDaerah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PeraturanDaerahController extends Controller
{
    /**
     * ============================================================
     * ADMIN - INDEX
     * ============================================================
     */
    public function index(Request $request)
    {
        $query = PeraturanDaerah::query();

        // SEARCH
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('nomor_peraturan', 'like', "%{$search}%")
                    ->orWhere('tahun', 'like', "%{$search}%")
                    ->orWhere('subjek', 'like', "%{$search}%")
                    ->orWhere('teu_badan', 'like', "%{$search}%")
                    ->orWhere('jenis_peraturan', 'like', "%{$search}%");
            });
        }

        $peraturanDaerahs = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.peraturan-daerah',
            compact('peraturanDaerahs')
        );
    }


    /**
     * ============================================================
     * ADMIN - STORE
     * ============================================================
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            // INFORMASI UTAMA
            'tipe_dokumen' => 'nullable|string|max:255',
            'jenis' => 'nullable|string|max:255',
            'judul' => 'required|string',
            'teu_badan' => 'nullable|string|max:255',
            'tanggal_upload' => 'nullable|date',

            // DETAIL
            'nomor_peraturan' => 'required|string|max:255',
            'jenis_peraturan' => 'nullable|string|max:255',
            'singkatan' => 'nullable|string|max:255',
            'tempat_penetapan' => 'nullable|string|max:255',
            'tahun' => 'required|integer|min:1900|max:2100',
            'tanggal_penetapan' => 'nullable|date',
            'tanggal_pengundangan' => 'nullable|date',

            // INFORMASI DOKUMEN
            'sumber' => 'nullable|string',
            'subjek' => 'nullable|string',
            'bahasa' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'bidang_hukum' => 'nullable|string|max:255',
            'abstrak' => 'nullable|string',

            // FILE
            'file_dokumen' => 'required|file|mimes:pdf|max:20480',

            'english_version' =>
                'nullable|file|mimes:pdf|max:20480',

            'braille' =>
                'nullable|file|mimes:pdf|max:20480',

            'alih_suara' =>
                'nullable|file|mimes:mp3,wav,m4a,ogg|max:20480',

            // STATUS
            'status' =>
                'required|in:BERLAKU,TIDAK BERLAKU',
        ]);


        /**
         * ========================================================
         * FOLDER UPLOAD
         * ========================================================
         */
        $basePath = public_path(
            'uploads/peraturan-daerah'
        );

        $folders = [
            $basePath,
            $basePath . '/english',
            $basePath . '/braille',
            $basePath . '/audio',
        ];

        foreach ($folders as $folder) {

            if (!File::exists($folder)) {

                File::makeDirectory(
                    $folder,
                    0755,
                    true
                );
            }
        }


        /**
         * ========================================================
         * FILE DOKUMEN UTAMA
         * ========================================================
         */
        if ($request->hasFile('file_dokumen')) {

            $file = $request->file('file_dokumen');

            $fileName =
                time() . '_' .
                Str::random(10) . '_' .
                Str::slug(
                    pathinfo(
                        $file->getClientOriginalName(),
                        PATHINFO_FILENAME
                    )
                ) .
                '.pdf';

            $file->move(
                $basePath,
                $fileName
            );

            // DATABASE HANYA MENYIMPAN NAMA FILE
            $validated['file_dokumen'] =
                $fileName;
        }


        /**
         * ========================================================
         * ENGLISH VERSION
         * ========================================================
         */
        if ($request->hasFile('english_version')) {

            $file =
                $request->file('english_version');

            $fileName =
                time() . '_' .
                Str::random(10) .
                '_english.pdf';

            $file->move(
                $basePath . '/english',
                $fileName
            );

            // DATABASE HANYA MENYIMPAN NAMA FILE
            $validated['english_version'] =
                $fileName;
        }


        /**
         * ========================================================
         * BRAILLE
         * ========================================================
         */
        if ($request->hasFile('braille')) {

            $file =
                $request->file('braille');

            $fileName =
                time() . '_' .
                Str::random(10) .
                '_braille.pdf';

            $file->move(
                $basePath . '/braille',
                $fileName
            );

            // DATABASE HANYA MENYIMPAN NAMA FILE
            $validated['braille'] =
                $fileName;
        }


        /**
         * ========================================================
         * ALIH SUARA
         * ========================================================
         */
        if ($request->hasFile('alih_suara')) {

            $file =
                $request->file('alih_suara');

            $extension =
                $file->getClientOriginalExtension();

            $fileName =
                time() . '_' .
                Str::random(10) .
                '_alih-suara.' .
                $extension;

            $file->move(
                $basePath . '/audio',
                $fileName
            );

            // DATABASE HANYA MENYIMPAN NAMA FILE
            $validated['alih_suara'] =
                $fileName;
        }


        /**
         * ========================================================
         * TANGGAL UPLOAD
         * ========================================================
         */
        if (empty($validated['tanggal_upload'])) {

            $validated['tanggal_upload'] =
                now()->format('Y-m-d');
        }


        /**
         * ========================================================
         * SIMPAN DATABASE
         * ========================================================
         */
        PeraturanDaerah::create($validated);


        return redirect()
            ->route('admin.peraturan-daerah')
            ->with(
                'success',
                'Peraturan Daerah berhasil ditambahkan.'
            );
    }


    /**
     * ============================================================
     * ADMIN - UPDATE
     * ============================================================
     */
    public function update(Request $request, $id)
    {
        $peraturanDaerah =
            PeraturanDaerah::findOrFail($id);


        $validated = $request->validate([

            // INFORMASI UTAMA
            'tipe_dokumen' => 'nullable|string|max:255',
            'jenis' => 'nullable|string|max:255',
            'judul' => 'required|string',
            'teu_badan' => 'nullable|string|max:255',
            'tanggal_upload' => 'nullable|date',

            // DETAIL
            'nomor_peraturan' => 'required|string|max:255',
            'jenis_peraturan' => 'nullable|string|max:255',
            'singkatan' => 'nullable|string|max:255',
            'tempat_penetapan' => 'nullable|string|max:255',
            'tahun' => 'required|integer|min:1900|max:2100',
            'tanggal_penetapan' => 'nullable|date',
            'tanggal_pengundangan' => 'nullable|date',

            // INFORMASI DOKUMEN
            'sumber' => 'nullable|string',
            'subjek' => 'nullable|string',
            'bahasa' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'bidang_hukum' => 'nullable|string|max:255',
            'abstrak' => 'nullable|string',

            // FILE
            'file_dokumen' =>
                'nullable|file|mimes:pdf|max:20480',

            'english_version' =>
                'nullable|file|mimes:pdf|max:20480',

            'braille' =>
                'nullable|file|mimes:pdf|max:20480',

            'alih_suara' =>
                'nullable|file|mimes:mp3,wav,m4a,ogg|max:20480',

            // STATUS
            'status' =>
                'required|in:BERLAKU,TIDAK BERLAKU',
        ]);


        /**
         * ========================================================
         * FOLDER
         * ========================================================
         */
        $basePath =
            public_path('uploads/peraturan-daerah');

        $folders = [
            $basePath,
            $basePath . '/english',
            $basePath . '/braille',
            $basePath . '/audio',
        ];

        foreach ($folders as $folder) {

            if (!File::exists($folder)) {

                File::makeDirectory(
                    $folder,
                    0755,
                    true
                );
            }
        }


        /**
         * ========================================================
         * FILE DOKUMEN UTAMA
         * ========================================================
         */
        if ($request->hasFile('file_dokumen')) {

            $this->deleteFile(
                $peraturanDaerah->file_dokumen,
                'peraturan-daerah'
            );


            $file =
                $request->file('file_dokumen');

            $fileName =
                time() . '_' .
                Str::random(10) . '_' .
                Str::slug(
                    pathinfo(
                        $file->getClientOriginalName(),
                        PATHINFO_FILENAME
                    )
                ) .
                '.pdf';

            $file->move(
                $basePath,
                $fileName
            );

            $validated['file_dokumen'] =
                $fileName;

        } else {

            unset(
                $validated['file_dokumen']
            );
        }


        /**
         * ========================================================
         * ENGLISH VERSION
         * ========================================================
         */
        if ($request->hasFile('english_version')) {

            $this->deleteFile(
                $peraturanDaerah->english_version,
                'peraturan-daerah/english'
            );


            $file =
                $request->file('english_version');

            $fileName =
                time() . '_' .
                Str::random(10) .
                '_english.pdf';

            $file->move(
                $basePath . '/english',
                $fileName
            );

            $validated['english_version'] =
                $fileName;

        } else {

            unset(
                $validated['english_version']
            );
        }


        /**
         * ========================================================
         * BRAILLE
         * ========================================================
         */
        if ($request->hasFile('braille')) {

            $this->deleteFile(
                $peraturanDaerah->braille,
                'peraturan-daerah/braille'
            );


            $file =
                $request->file('braille');

            $fileName =
                time() . '_' .
                Str::random(10) .
                '_braille.pdf';

            $file->move(
                $basePath . '/braille',
                $fileName
            );

            $validated['braille'] =
                $fileName;

        } else {

            unset(
                $validated['braille']
            );
        }


        /**
         * ========================================================
         * ALIH SUARA
         * ========================================================
         */
        if ($request->hasFile('alih_suara')) {

            $this->deleteFile(
                $peraturanDaerah->alih_suara,
                'peraturan-daerah/audio'
            );


            $file =
                $request->file('alih_suara');

            $extension =
                $file->getClientOriginalExtension();

            $fileName =
                time() . '_' .
                Str::random(10) .
                '_alih-suara.' .
                $extension;

            $file->move(
                $basePath . '/audio',
                $fileName
            );

            $validated['alih_suara'] =
                $fileName;

        } else {

            unset(
                $validated['alih_suara']
            );
        }


        /**
         * ========================================================
         * UPDATE DATABASE
         * ========================================================
         */
        $peraturanDaerah->update(
            $validated
        );


        return redirect()
            ->route('admin.peraturan-daerah')
            ->with(
                'success',
                'Peraturan Daerah berhasil diperbarui.'
            );
    }


    /**
     * ============================================================
     * ADMIN - DESTROY
     * ============================================================
     */
    public function destroy($id)
    {
        $peraturanDaerah =
            PeraturanDaerah::findOrFail($id);


        /**
         * Hapus PDF utama
         */
        $this->deleteFile(
            $peraturanDaerah->file_dokumen,
            'peraturan-daerah'
        );


        /**
         * Hapus English
         */
        $this->deleteFile(
            $peraturanDaerah->english_version,
            'peraturan-daerah/english'
        );


        /**
         * Hapus Braille
         */
        $this->deleteFile(
            $peraturanDaerah->braille,
            'peraturan-daerah/braille'
        );


        /**
         * Hapus Audio
         */
        $this->deleteFile(
            $peraturanDaerah->alih_suara,
            'peraturan-daerah/audio'
        );


        /**
         * Hapus database
         */
        $peraturanDaerah->delete();


        return redirect()
            ->route('admin.peraturan-daerah')
            ->with(
                'success',
                'Peraturan Daerah berhasil dihapus.'
            );
    }


    /**
     * ============================================================
     * USER - INDEX
     * ============================================================
     */
    public function userIndex(Request $request)
    {
        $query =
            PeraturanDaerah::query();


        // SEARCH
        if ($request->filled('search')) {

            $search =
                $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'judul',
                    'like',
                    "%{$search}%"
                )
                    ->orWhere(
                        'nomor_peraturan',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'tahun',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'subjek',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'teu_badan',
                        'like',
                        "%{$search}%"
                    );
            });
        }


        $peraturanDaerahs =
            $query
                ->latest()
                ->paginate(10)
                ->withQueryString();


        return view(
            'user.peraturan-daerah',
            compact('peraturanDaerahs')
        );
    }


    /**
     * ============================================================
     * USER - DETAIL
     * ============================================================
     */
    public function show($id)
    {
        $peraturanDaerah =
            PeraturanDaerah::findOrFail($id);


        return view(
            'user.peraturan-daerah-detail',
            compact('peraturanDaerah')
        );
    }


    /**
     * ============================================================
     * HELPER DELETE FILE
     * ============================================================
     */
    private function deleteFile($fileName, $folder)
    {
        if (empty($fileName)) {
            return;
        }

        /*
        | Jika data lama masih menyimpan:
        | uploads/peraturan-daerah/xxxx.pdf
        |
        | Ambil hanya nama filenya supaya tetap kompatibel.
        */
        $fileName =
            basename($fileName);


        $fullPath =
            public_path(
                'uploads/' .
                $folder .
                '/' .
                $fileName
            );


        if (File::exists($fullPath)) {

            File::delete($fullPath);
        }
    }
}