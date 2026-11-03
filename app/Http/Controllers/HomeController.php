<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\PeraturanDaerah;
use App\Models\PeraturanBupati;
use App\Models\KeputusanBupati;

class HomeController extends Controller
{
    public function index()
    {
        // ==============================
        // CAROUSEL
        // ==============================
        $carousels = \App\Models\Carousel::latest()->get();


        // ==============================
        // BERITA TERBARU
        // ==============================
        $beritas = Berita::latest()
            ->take(3)
            ->get();


        // ==============================
        // JUMLAH PRODUK HUKUM
        // ==============================
        $jumlahPeraturanDaerah = PeraturanDaerah::count();

        $jumlahPeraturanBupati = PeraturanBupati::count();

        $jumlahKeputusanBupati = KeputusanBupati::count();


        // ==============================
        // 3 PRODUK HUKUM TERBARU
        // ==============================

        $peraturanDaerahTerbaru = PeraturanDaerah::latest()
            ->take(3)
            ->get()
            ->map(function ($item) {

                $item->kategori_produk = 'Peraturan Daerah';
                $item->url_produk = route(
                    'user.peraturan-daerah.detail',
                    $item->id
                );

                return $item;
            });


        $peraturanBupatiTerbaru = PeraturanBupati::latest()
            ->take(3)
            ->get()
            ->map(function ($item) {

                $item->kategori_produk = 'Peraturan Bupati';
                $item->url_produk = route(
                    'user.peraturan-bupati.detail',
                    $item->id
                );

                return $item;
            });


        $keputusanBupatiTerbaru = KeputusanBupati::latest()
            ->take(3)
            ->get()
            ->map(function ($item) {

                $item->kategori_produk = 'Keputusan Bupati';
                $item->url_produk = route(
                    'user.keputusan-bupati.detail',
                    $item->id
                );

                return $item;
            });


        // Gabungkan ketiga data
        $produkHukumTerbaru = $peraturanDaerahTerbaru
            ->concat($peraturanBupatiTerbaru)
            ->concat($keputusanBupatiTerbaru)
            ->sortByDesc('created_at')
            ->take(4)
            ->values();


        return view('user.home', compact(
            'carousels',
            'beritas',

            'jumlahPeraturanDaerah',
            'jumlahPeraturanBupati',
            'jumlahKeputusanBupati',

            'produkHukumTerbaru'
        ));
    }
}