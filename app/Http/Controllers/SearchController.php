<?php

namespace App\Http\Controllers;

use App\Models\JenisPeraturan;
use App\Models\Peraturan;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Pencarian Dokumen Hukum Multi-Parameter (Requirement #1)
     */
    public function search(Request $request)
    {
        $query = Peraturan::with('jenisPeraturan')->latest();

        // 1. Judul
        if ($request->filled('judul')) {
            $query->where('judul', 'like', '%' . $request->judul . '%');
        } elseif ($request->filled('q')) {
            $query->search($request->q);
        }

        // 2. Jenis Dokumen / Peraturan
        if ($request->filled('jenis_peraturan_id')) {
            $query->where('jenis_peraturan_id', $request->jenis_peraturan_id);
        }

        // 3. Nomor Peraturan
        if ($request->filled('nomor_peraturan')) {
            $query->where('nomor_peraturan', 'like', '%' . $request->nomor_peraturan . '%');
        }

        // 4. Tahun
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        // 5. Status (BERLAKU / TIDAK BERLAKU)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 6. Sorting
        $sort = $request->get('sort', 'terbaru');
        if ($sort === 'terlama') {
            $query->oldest();
        } elseif ($sort === 'populer') {
            $query->orderByDesc('view_count')->orderByDesc('download_count');
        } else {
            $query->latest();
        }

        $peraturans = $query->paginate(12)->withQueryString();

        $jenisPeraturans = JenisPeraturan::where('is_active', true)
            ->withCount('peraturans')
            ->orderBy('urutan')
            ->get();

        $totalPeraturans = Peraturan::count();

        $tahunList = Peraturan::whereNotNull('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('user.pencarian', compact(
            'peraturans',
            'jenisPeraturans',
            'tahunList',
            'totalPeraturans',
            'sort'
        ));
    }
}

