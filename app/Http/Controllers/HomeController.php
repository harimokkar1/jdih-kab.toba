<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Carousel;
use App\Models\JenisPeraturan;
use App\Models\Pengumuman;
use App\Models\Peraturan;

class HomeController extends Controller
{
    public function index()
    {
        $activeTab = request('tab', 'terbaru');

        // 1. CAROUSEL
        $carousels = Carousel::latest()->get();

        // 2. BERITA TERBARU (3 items)
        $beritas = Berita::latest()->take(3)->get();

        // 3. PENGUMUMAN TERBARU (4 items)
        $pengumumans = Pengumuman::latest('tanggal_upload')->take(4)->get();

        // 4. JENIS PRODUK HUKUM DINAMIS DENGAN TOTAL DOKUMEN (Requirement #4)
        $jenisPeraturans = JenisPeraturan::where('is_active', true)
            ->withCount('peraturans')
            ->orderBy('urutan')
            ->get();

        // 5. PRODUK HUKUM TERBARU / TERPOPULER SESUAI TAB PILIHAN
        $docQuery = Peraturan::with('jenisPeraturan');
        if ($activeTab === 'populer') {
            $produkHukumTerbaru = $docQuery->orderByDesc('view_count')->orderByDesc('download_count')->take(6)->get();
        } else {
            $produkHukumTerbaru = $docQuery->latest()->take(6)->get();
        }

        // 6. TOTAL STATISTIK DOKUMEN
        $totalDokumen = Peraturan::count();

        // 7. LIST TAHUN UNTUK FILTER HERO SEARCH BAR (Requirement #1)
        $tahunList = Peraturan::whereNotNull('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('user.home', compact(
            'carousels',
            'beritas',
            'pengumumans',
            'jenisPeraturans',
            'produkHukumTerbaru',
            'totalDokumen',
            'tahunList',
            'activeTab'
        ));
    }
}
