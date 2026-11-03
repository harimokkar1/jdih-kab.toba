<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    /**
     * Tampilkan Halaman Admin Visi & Misi
     */
    public function index()
    {
        $data = VisiMisi::first();
        return view('admin.visi', compact('data'));
    }

    /**
     * Simpan / Update Visi & Misi
     */
    public function save(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ], [
            'visi.required' => 'Teks Visi wajib diisi.',
            'misi.required' => 'Teks Misi wajib diisi.',
        ]);

        VisiMisi::updateOrCreate(
            ['id' => 1],
            [
                'visi' => $request->visi,
                'misi' => $request->misi,
            ]
        );

        return redirect()->route('admin.visi')
            ->with('success', 'Visi & Misi Pemerintah Kabupaten Toba berhasil disimpan.');
    }

    /**
     * Tampilkan Halaman Visi & Misi Publik
     */
    public function show()
    {
        $data = VisiMisi::first();
        $carousels = Carousel::latest()->get();

        return view('user.visi', compact('data', 'carousels'));
    }
}
