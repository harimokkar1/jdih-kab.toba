<?php

namespace App\Http\Controllers;

use App\Models\KeputusanBupati;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class KeputusanBupatiController extends Controller
{
    /**
     * ============================================================
     * ADMIN - INDEX
     * ============================================================
     */
    public function index(Request $request)
    {
        $query = KeputusanBupati::query();

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

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

        $keputusanBupatis = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.keputusan-bupati',
            compact('keputusanBupatis')
        );
    }


    /**
     * ============================================================
     * ADMIN - STORE
     * ============================================================
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            // INFORMASI UTAMA
            'tipe_dokumen' => 'nullable|string|max:255',
            'jenis' => 'nullable|string|max:255',
            'judul' => 'required|string',
            'teu_badan' => 'nullable|string|max:255',

            // TANGGAL UPLOAD
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
            'english_version' =>
            'nullable|file|mimes:pdf|max:20480',

            'braille' =>
            'nullable|file|mimes:pdf|max:20480',

            'alih_suara' =>
            'nullable|file|mimes:mp3,wav,m4a,ogg|max:20480',

            'file_dokumen' =>
            'required|file|mimes:pdf|max:20480',

            // STATUS
            'status' =>
            'nullable|in:BERLAKU,TIDAK BERLAKU',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Folder Upload
        |--------------------------------------------------------------------------
        */

        $basePath =
            public_path('uploads/keputusan-bupati');

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


        /*
        |--------------------------------------------------------------------------
        | FILE DOKUMEN UTAMA
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('file_dokumen')) {

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
                'uploads/keputusan-bupati/' . $fileName;
        }


        /*
        |--------------------------------------------------------------------------
        | ENGLISH VERSION
        |--------------------------------------------------------------------------
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

            $validated['english_version'] =
                'uploads/keputusan-bupati/english/' . $fileName;
        }


        /*
        |--------------------------------------------------------------------------
        | BRAILLE
        |--------------------------------------------------------------------------
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

            $validated['braille'] =
                'uploads/keputusan-bupati/braille/' . $fileName;
        }


        /*
        |--------------------------------------------------------------------------
        | ALIH SUARA
        |--------------------------------------------------------------------------
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

            $validated['alih_suara'] =
                'uploads/keputusan-bupati/audio/' . $fileName;
        }


        /*
        |--------------------------------------------------------------------------
        | TANGGAL UPLOAD
        |--------------------------------------------------------------------------
        */

        if (empty($validated['tanggal_upload'])) {

            $validated['tanggal_upload'] =
                now()->format('Y-m-d');
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATABASE
        |--------------------------------------------------------------------------
        */

        KeputusanBupati::create($validated);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.keputusan-bupati')
            ->with(
                'success',
                'Keputusan Bupati berhasil ditambahkan.'
            );
    }


    /**
     * ============================================================
     * ADMIN - UPDATE
     * ============================================================
     */
    public function update(Request $request, $id)
    {
        $keputusanBupati =
            KeputusanBupati::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            // INFORMASI UTAMA
            'tipe_dokumen' => 'nullable|string|max:255',
            'jenis' => 'nullable|string|max:255',
            'judul' => 'required|string',
            'teu_badan' => 'nullable|string|max:255',

            // TANGGAL UPLOAD
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
            'english_version' =>
            'nullable|file|mimes:pdf|max:20480',

            'braille' =>
            'nullable|file|mimes:pdf|max:20480',

            'alih_suara' =>
            'nullable|file|mimes:mp3,wav,m4a,ogg|max:20480',

            'file_dokumen' =>
            'nullable|file|mimes:pdf|max:20480',

            // STATUS
            'status' =>
            'nullable|in:BERLAKU,TIDAK BERLAKU',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Folder Upload
        |--------------------------------------------------------------------------
        */

        $basePath =
            public_path('uploads/keputusan-bupati');

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


        /*
        |--------------------------------------------------------------------------
        | FILE DOKUMEN UTAMA
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('file_dokumen')) {

            // Hapus file lama
            $this->deleteFile(
                $keputusanBupati->file_dokumen
            );


            // Upload file baru
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
                'uploads/keputusan-bupati/' . $fileName;
        } else {

            // Jangan ubah file lama
            unset(
                $validated['file_dokumen']
            );
        }


        /*
        |--------------------------------------------------------------------------
        | ENGLISH VERSION
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('english_version')) {

            // Hapus file lama
            $this->deleteFile(
                $keputusanBupati->english_version
            );


            // Upload file baru
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
                'uploads/keputusan-bupati/english/' . $fileName;
        } else {

            unset(
                $validated['english_version']
            );
        }


        /*
        |--------------------------------------------------------------------------
        | BRAILLE
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('braille')) {

            // Hapus file lama
            $this->deleteFile(
                $keputusanBupati->braille
            );


            // Upload file baru
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
                'uploads/keputusan-bupati/braille/' . $fileName;
        } else {

            unset(
                $validated['braille']
            );
        }


        /*
        |--------------------------------------------------------------------------
        | ALIH SUARA
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('alih_suara')) {

            // Hapus file lama
            $this->deleteFile(
                $keputusanBupati->alih_suara
            );


            // Upload file baru
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
                'uploads/keputusan-bupati/audio/' . $fileName;
        } else {

            unset(
                $validated['alih_suara']
            );
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $keputusanBupati->update(
            $validated
        );


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.keputusan-bupati')
            ->with(
                'success',
                'Keputusan Bupati berhasil diperbarui.'
            );
    }


    /**
     * ============================================================
     * ADMIN - DESTROY
     * ============================================================
     */
    public function destroy($id)
    {
        $keputusanBupati =
            KeputusanBupati::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | Hapus semua file
        |--------------------------------------------------------------------------
        */

        $this->deleteFile(
            $keputusanBupati->file_dokumen
        );

        $this->deleteFile(
            $keputusanBupati->english_version
        );

        $this->deleteFile(
            $keputusanBupati->braille
        );

        $this->deleteFile(
            $keputusanBupati->alih_suara
        );


        /*
        |--------------------------------------------------------------------------
        | Hapus Database
        |--------------------------------------------------------------------------
        */

        $keputusanBupati->delete();


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.keputusan-bupati')
            ->with(
                'success',
                'Keputusan Bupati berhasil dihapus.'
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
            KeputusanBupati::query();


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $keputusanBupatis =
            $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        return view(
            'user.keputusan-bupati',
            compact(
                'keputusanBupatis'
            )
        );
    }


    /**
     * ============================================================
     * USER - DETAIL
     * ============================================================
     */
    public function show($id)
    {
        $keputusanBupati =
            KeputusanBupati::findOrFail($id);


        return view(
            'user.keputusan-bupati-detail',
            compact(
                'keputusanBupati'
            )
        );
    }


    /**
     * ============================================================
     * HELPER - DELETE FILE
     * ============================================================
     */
    private function deleteFile($path)
    {
        if (
            empty($path)
        ) {
            return;
        }

        $fullPath =
            public_path($path);

        if (
            File::exists($fullPath)
        ) {
            File::delete($fullPath);
        }
    }
}
