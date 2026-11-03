<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiMisi;
use App\Models\Carousel;

class VisiMisiController extends Controller
{
    // tampil halaman
    public function index()
    {
        $data = VisiMisi::first(); // ambil cuma 1 data
        return view('admin.visi', compact('data'));
    }

    // simpan / update
    public function save(Request $request)
    {
        VisiMisi::updateOrCreate(
            ['id' => 1], // biar cuma 1 record
            [
                'visi' => $request->visi,
                'misi' => $request->misi
            ]
        );

        return back()->with('success', 'Data berhasil disimpan');
    }

    // tampil ke user (frontend)
    public function show()
    {
        $data = VisiMisi::first();
        $carousels = Carousel::all();

        return view('user.visi', compact('data', 'carousels'));
    }

}
