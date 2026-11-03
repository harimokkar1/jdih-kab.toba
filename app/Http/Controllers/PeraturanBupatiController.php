<?php

namespace App\Http\Controllers;

use App\Models\PeraturanBupati;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PeraturanBupatiController extends Controller
{
    /**
     * ============================================================
     * ADMIN
     * Daftar Peraturan Bupati
     * ============================================================
     */
    public function index(Request $request)
    {
        $query = PeraturanBupati::query();

        // SEARCH
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('nomor_peraturan', 'like', '%' . $search . '%')
                    ->orWhere('tahun', 'like', '%' . $search . '%')
                    ->orWhere('teu_badan', 'like', '%' . $search . '%');
            });
        }

        $peraturanBupatis = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.peraturan-bupati',
            compact('peraturanBupatis')
        );
    }


    /**
     * ============================================================
     * ADMIN
     * Tambah Peraturan Bupati
     * ============================================================
     */
    public function store(Request $request)
    {
        $request->validate([

            // INFORMASI UTAMA
            'tipe_dokumen' => 'nullable|string|max:255',
            'jenis' => 'nullable|string|max:255',
            'judul' => 'required|string',
            'teu_badan' => 'nullable|string|max:255',
            'tanggal_upload' => 'nullable|date',
            'nomor_peraturan' => 'nullable|string|max:255',

            // DETAIL
            'jenis_peraturan' => 'nullable|string|max:255',
            'singkatan' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer|min:1900|max:2100',
            'tempat_penetapan' => 'nullable|string|max:255',
            'tanggal_penetapan' => 'nullable|date',
            'tanggal_pengundangan' => 'nullable|date',

            // INFORMASI DOKUMEN
            'sumber' => 'nullable|string',
            'subjek' => 'nullable|string',
            'bahasa' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'bidang_hukum' => 'nullable|string|max:255',
            'abstrak' => 'nullable|string',

            // STATUS
            'status' => 'required|in:BERLAKU,TIDAK BERLAKU',

            // FILE
            'file_dokumen' => 'required|mimes:pdf|max:20480',

            'english_version' =>
                'nullable|mimes:pdf|max:20480',

            'braille' =>
                'nullable|mimes:pdf|max:20480',

            'alih_suara' =>
                'nullable|mimes:mp3,wav,m4a,ogg|max:20480',
        ]);


        /**
         * ========================================================
         * DATA NON FILE
         * ========================================================
         */
        $data = $request->except([
            'file_dokumen',
            'english_version',
            'braille',
            'alih_suara'
        ]);


        /**
         * ========================================================
         * FOLDER UTAMA
         * ========================================================
         */
        $folder = public_path(
            'uploads/peraturan-bupati'
        );


        if (!File::exists($folder)) {

            File::makeDirectory(
                $folder,
                0755,
                true
            );
        }


        /**
         * ========================================================
         * FILE DOKUMEN UTAMA
         * ========================================================
         */
        if ($request->hasFile('file_dokumen')) {

            $file = $request->file('file_dokumen');

            $namaFile =
                time() . '_' .
                $file->getClientOriginalName();

            $file->move(
                $folder,
                $namaFile
            );

            $data['file_dokumen'] = $namaFile;
        }


        /**
         * ========================================================
         * ENGLISH VERSION
         * ========================================================
         */
        if ($request->hasFile('english_version')) {

            $file =
                $request->file('english_version');

            $namaFile =
                time() . '_english_' .
                $file->getClientOriginalName();

            $file->move(
                $folder,
                $namaFile
            );

            $data['english_version'] =
                $namaFile;
        }


        /**
         * ========================================================
         * BRAILLE
         * ========================================================
         */
        if ($request->hasFile('braille')) {

            $file =
                $request->file('braille');

            $namaFile =
                time() . '_braille_' .
                $file->getClientOriginalName();

            $file->move(
                $folder,
                $namaFile
            );

            $data['braille'] =
                $namaFile;
        }


        /**
         * ========================================================
         * ALIH SUARA
         * ========================================================
         */
        if ($request->hasFile('alih_suara')) {

            $file =
                $request->file('alih_suara');

            $namaFile =
                time() . '_audio_' .
                $file->getClientOriginalName();

            $file->move(
                $folder,
                $namaFile
            );

            $data['alih_suara'] =
                $namaFile;
        }


        /**
         * ========================================================
         * SIMPAN DATABASE
         * ========================================================
         */
        PeraturanBupati::create($data);


        return redirect()
            ->route('admin.peraturan-bupati.index')
            ->with(
                'success',
                'Peraturan Bupati berhasil ditambahkan.'
            );
    }


    /**
     * ============================================================
     * ADMIN
     * Update Peraturan Bupati
     * ============================================================
     */
    public function update(
        Request $request,
        $id
    ) {

        $peraturanBupati =
            PeraturanBupati::findOrFail($id);


        $request->validate([

            // INFORMASI UTAMA
            'tipe_dokumen' => 'nullable|string|max:255',
            'jenis' => 'nullable|string|max:255',
            'judul' => 'required|string',
            'teu_badan' => 'nullable|string|max:255',
            'tanggal_upload' => 'nullable|date',
            'nomor_peraturan' => 'nullable|string|max:255',

            // DETAIL
            'jenis_peraturan' => 'nullable|string|max:255',
            'singkatan' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer|min:1900|max:2100',
            'tempat_penetapan' => 'nullable|string|max:255',
            'tanggal_penetapan' => 'nullable|date',
            'tanggal_pengundangan' => 'nullable|date',

            // INFORMASI DOKUMEN
            'sumber' => 'nullable|string',
            'subjek' => 'nullable|string',
            'bahasa' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'bidang_hukum' => 'nullable|string|max:255',
            'abstrak' => 'nullable|string',

            // STATUS
            'status' =>
                'required|in:BERLAKU,TIDAK BERLAKU',

            // FILE
            'file_dokumen' =>
                'nullable|mimes:pdf|max:20480',

            'english_version' =>
                'nullable|mimes:pdf|max:20480',

            'braille' =>
                'nullable|mimes:pdf|max:20480',

            'alih_suara' =>
                'nullable|mimes:mp3,wav,m4a,ogg|max:20480',
        ]);


        /**
         * ========================================================
         * DATA NON FILE
         * ========================================================
         */
        $data = $request->except([
            'file_dokumen',
            'english_version',
            'braille',
            'alih_suara'
        ]);


        /**
         * ========================================================
         * FOLDER
         * ========================================================
         */
        $folder = public_path(
            'uploads/peraturan-bupati'
        );


        if (!File::exists($folder)) {

            File::makeDirectory(
                $folder,
                0755,
                true
            );
        }


        /**
         * ========================================================
         * FILE PDF UTAMA
         * ========================================================
         */
        if ($request->hasFile('file_dokumen')) {

            // Hapus file lama
            if (
                $peraturanBupati->file_dokumen &&
                File::exists(
                    $folder . '/' .
                    $peraturanBupati->file_dokumen
                )
            ) {

                File::delete(
                    $folder . '/' .
                    $peraturanBupati->file_dokumen
                );
            }


            // Upload baru
            $file =
                $request->file('file_dokumen');

            $namaFile =
                time() . '_' .
                $file->getClientOriginalName();

            $file->move(
                $folder,
                $namaFile
            );

            $data['file_dokumen'] =
                $namaFile;
        }


        /**
         * ========================================================
         * ENGLISH VERSION
         * ========================================================
         */
        if ($request->hasFile('english_version')) {

            if (
                $peraturanBupati->english_version &&
                File::exists(
                    $folder . '/' .
                    $peraturanBupati->english_version
                )
            ) {

                File::delete(
                    $folder . '/' .
                    $peraturanBupati->english_version
                );
            }


            $file =
                $request->file('english_version');

            $namaFile =
                time() . '_english_' .
                $file->getClientOriginalName();

            $file->move(
                $folder,
                $namaFile
            );

            $data['english_version'] =
                $namaFile;
        }


        /**
         * ========================================================
         * BRAILLE
         * ========================================================
         */
        if ($request->hasFile('braille')) {

            if (
                $peraturanBupati->braille &&
                File::exists(
                    $folder . '/' .
                    $peraturanBupati->braille
                )
            ) {

                File::delete(
                    $folder . '/' .
                    $peraturanBupati->braille
                );
            }


            $file =
                $request->file('braille');

            $namaFile =
                time() . '_braille_' .
                $file->getClientOriginalName();

            $file->move(
                $folder,
                $namaFile
            );

            $data['braille'] =
                $namaFile;
        }


        /**
         * ========================================================
         * ALIH SUARA
         * ========================================================
         */
        if ($request->hasFile('alih_suara')) {

            if (
                $peraturanBupati->alih_suara &&
                File::exists(
                    $folder . '/' .
                    $peraturanBupati->alih_suara
                )
            ) {

                File::delete(
                    $folder . '/' .
                    $peraturanBupati->alih_suara
                );
            }


            $file =
                $request->file('alih_suara');

            $namaFile =
                time() . '_audio_' .
                $file->getClientOriginalName();

            $file->move(
                $folder,
                $namaFile
            );

            $data['alih_suara'] =
                $namaFile;
        }


        /**
         * ========================================================
         * UPDATE DATABASE
         * ========================================================
         */
        $peraturanBupati->update($data);


        return redirect()
            ->route('admin.peraturan-bupati.index')
            ->with(
                'success',
                'Peraturan Bupati berhasil diperbarui.'
            );
    }


    /**
     * ============================================================
     * ADMIN
     * Hapus Peraturan Bupati
     * ============================================================
     */
    public function destroy($id)
    {
        $peraturanBupati =
            PeraturanBupati::findOrFail($id);


        $folder = public_path(
            'uploads/peraturan-bupati'
        );


        /**
         * Hapus PDF utama
         */
        if (
            $peraturanBupati->file_dokumen &&
            File::exists(
                $folder . '/' .
                $peraturanBupati->file_dokumen
            )
        ) {

            File::delete(
                $folder . '/' .
                $peraturanBupati->file_dokumen
            );
        }


        /**
         * Hapus English Version
         */
        if (
            $peraturanBupati->english_version &&
            File::exists(
                $folder . '/' .
                $peraturanBupati->english_version
            )
        ) {

            File::delete(
                $folder . '/' .
                $peraturanBupati->english_version
            );
        }


        /**
         * Hapus Braille
         */
        if (
            $peraturanBupati->braille &&
            File::exists(
                $folder . '/' .
                $peraturanBupati->braille
            )
        ) {

            File::delete(
                $folder . '/' .
                $peraturanBupati->braille
            );
        }


        /**
         * Hapus Alih Suara
         */
        if (
            $peraturanBupati->alih_suara &&
            File::exists(
                $folder . '/' .
                $peraturanBupati->alih_suara
            )
        ) {

            File::delete(
                $folder . '/' .
                $peraturanBupati->alih_suara
            );
        }


        /**
         * Hapus database
         */
        $peraturanBupati->delete();


        return redirect()
            ->route('admin.peraturan-bupati.index')
            ->with(
                'success',
                'Peraturan Bupati berhasil dihapus.'
            );
    }


    /**
     * ============================================================
     * USER
     * Daftar Peraturan Bupati
     * ============================================================
     */
    public function userIndex(Request $request)
    {
        $query =
            PeraturanBupati::query();


        // SEARCH
        if ($request->filled('search')) {

            $search =
                $request->search;


            $query->where(function ($q) use ($search) {

                $q->where(
                    'judul',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'nomor_peraturan',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'tahun',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'teu_badan',
                    'like',
                    '%' . $search . '%'
                );
            });
        }


        $peraturanBupatis =
            $query
                ->latest()
                ->paginate(10)
                ->withQueryString();


        return view(
            'user.peraturan-bupati',
            compact('peraturanBupatis')
        );
    }


    /**
     * ============================================================
     * USER
     * Detail Peraturan Bupati
     * ============================================================
     */
    public function userDetail($id)
    {
        $peraturanBupati =
            PeraturanBupati::findOrFail($id);


        return view(
            'user.peraturan-bupati-detail',
            compact('peraturanBupati')
        );
    }
}