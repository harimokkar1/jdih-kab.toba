<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\JenisPeraturan;
use App\Models\Pengumuman;
use App\Models\Peraturan;
use App\Models\StrukturOrganisasi;
use App\Models\User;
use App\Models\Visitor;
use App\Services\VisitorService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Halaman Dasbor Utama Admin
     */
    public function dashboard(VisitorService $visitorService)
    {
        $totalJenis = JenisPeraturan::count();
        $totalPeraturan = Peraturan::count();
        $totalBerita = Berita::count();
        $totalPengumuman = Pengumuman::count();
        $totalStruktur = StrukturOrganisasi::count();
        $totalAdmin = User::count();

        // Kunjungan
        $visitorStats = $visitorService->getStats();

        // Status Peraturan
        $totalBerlaku = Peraturan::where('status', 'BERLAKU')->count();
        $totalTidakBerlaku = Peraturan::where('status', '!=', 'BERLAKU')->count();
        $rasioBerlaku = $totalPeraturan > 0 ? round(($totalBerlaku / $totalPeraturan) * 100) : 100;

        // Salam dinamis waktu Indonesia Barat (WIB / Asia/Jakarta)
        $nowWib = Carbon::now('Asia/Jakarta');
        $hour = (int) $nowWib->format('H');
        if ($hour >= 4 && $hour < 11) {
            $greeting = 'Selamat Pagi';
        } elseif ($hour >= 11 && $hour < 15) {
            $greeting = 'Selamat Siang';
        } elseif ($hour >= 15 && $hour < 18) {
            $greeting = 'Selamat Sore';
        } else {
            $greeting = 'Selamat Malam';
        }
        $formattedTimeWib = $nowWib->format('H:i') . ' WIB';

        // Sebaran Kategori Regulasi Terbanyak
        $jenisDistribution = JenisPeraturan::withCount('peraturans')
            ->orderBy('peraturans_count', 'desc')
            ->take(6)
            ->get();

        // Ringkasan Kategori Teratas Dinamis
        $topJenisSummary = $jenisDistribution->pluck('singkatan')->filter()->take(3)->implode(', ');
        if (!$topJenisSummary) {
            $topJenisSummary = $jenisDistribution->pluck('nama')->take(2)->implode(', ');
        }

        // Data Grafik Kunjungan 7 Hari Terakhir (Real dari Database Visitor)
        $chartDays = [];
        $chartVisitors = [];
        for ($i = 6; $i >= 0; $i--) {
            $d = Carbon::today()->subDays($i);
            $chartDays[] = $d->translatedFormat('d M');
            $chartVisitors[] = Visitor::whereDate('visited_date', $d->toDateString())->count();
        }

        $avgVisitors = count($chartVisitors) > 0 ? round(array_sum($chartVisitors) / count($chartVisitors)) : 0;
        $maxVisitorVal = count($chartVisitors) > 0 ? max($chartVisitors) : 0;
        $maxVisitorDay = $chartDays[array_search($maxVisitorVal, $chartVisitors)] ?? '-';

        // 2. Data Grafik Kunjungan 30 Hari Terakhir
        $chartDays30 = [];
        $chartVisitors30 = [];
        for ($i = 29; $i >= 0; $i--) {
            $d = Carbon::today()->subDays($i);
            $chartDays30[] = $d->translatedFormat('d M');
            $chartVisitors30[] = Visitor::whereDate('visited_date', $d->toDateString())->count();
        }
        $avgVisitors30 = count($chartVisitors30) > 0 ? round(array_sum($chartVisitors30) / count($chartVisitors30)) : 0;
        $maxVisitor30Val = count($chartVisitors30) > 0 ? max($chartVisitors30) : 0;
        $maxVisitor30Day = $chartDays30[array_search($maxVisitor30Val, $chartVisitors30)] ?? '-';

        // 3. Data Grafik Kunjungan Per Bulan (12 Bulan Terakhir)
        $chartMonths = [];
        $chartVisitorsMonth = [];
        for ($i = 11; $i >= 0; $i--) {
            $m = Carbon::today()->subMonths($i);
            $chartMonths[] = $m->translatedFormat('M Y');
            $chartVisitorsMonth[] = Visitor::whereYear('visited_date', $m->year)
                ->whereMonth('visited_date', $m->month)
                ->count();
        }
        $avgVisitorsMonth = count($chartVisitorsMonth) > 0 ? round(array_sum($chartVisitorsMonth) / count($chartVisitorsMonth)) : 0;
        $maxVisitorMonthVal = count($chartVisitorsMonth) > 0 ? max($chartVisitorsMonth) : 0;
        $maxVisitorMonthLabel = $chartMonths[array_search($maxVisitorMonthVal, $chartVisitorsMonth)] ?? '-';
        $visitorsThisMonth = Visitor::whereYear('visited_date', $nowWib->year)
            ->whereMonth('visited_date', $nowWib->month)
            ->count();
        $lastMonthObj = Carbon::today()->subMonth();
        $visitorsLastMonth = Visitor::whereYear('visited_date', $lastMonthObj->year)
            ->whereMonth('visited_date', $lastMonthObj->month)
            ->count();

        // 4. Data Grafik Kunjungan Per Tahun (5 Tahun Terakhir)
        $chartYears = [];
        $chartVisitorsYear = [];
        for ($i = 4; $i >= 0; $i--) {
            $y = $nowWib->year - $i;
            $chartYears[] = (string) $y;
            $chartVisitorsYear[] = Visitor::whereYear('visited_date', $y)->count();
        }
        $avgVisitorsYear = count($chartVisitorsYear) > 0 ? round(array_sum($chartVisitorsYear) / count($chartVisitorsYear)) : 0;
        $maxVisitorYearVal = count($chartVisitorsYear) > 0 ? max($chartVisitorsYear) : 0;
        $maxVisitorYearLabel = $chartYears[array_search($maxVisitorYearVal, $chartVisitorsYear)] ?? '-';
        $visitorsThisYear = Visitor::whereYear('visited_date', $nowWib->year)->count();
        $visitorsLastYear = Visitor::whereYear('visited_date', $nowWib->year - 1)->count();

        // Statistik Kepatuhan & Validasi Berkas Dokumen (Quality Assurance JDIH)
        $currentYear = $nowWib->year;
        $totalTahunIni = Peraturan::where('tahun', $currentYear)->count();
        $totalWithPdf = Peraturan::whereNotNull('file_dokumen')
            ->where('file_dokumen', '!=', '')
            ->count();
        $totalWithoutPdf = max(0, $totalPeraturan - $totalWithPdf);
        $rasioPdf = $totalPeraturan > 0 ? round(($totalWithPdf / $totalPeraturan) * 100) : 100;

        // 6 Regulasi Terakhir Diinput/Diperbarui untuk Feed Operasional
        $recentPeraturans = Peraturan::with('jenisPeraturan')
            ->latest('updated_at')
            ->take(6)
            ->get();

        // 3 Berita & Pengumuman Terkini untuk Feed Publikasi
        $recentBeritas = Berita::latest()->take(3)->get();
        $recentPengumumans = Pengumuman::with('kategori')->latest()->take(3)->get();

        // Statistik Perangkat Pengunjung (Real dari Database Visitor)
        $totalVisitorRecords = Visitor::count();
        $mobileVisitors = Visitor::where(function ($q) {
            $q->where('user_agent', 'LIKE', '%Mobile%')
              ->orWhere('user_agent', 'LIKE', '%Android%')
              ->orWhere('user_agent', 'LIKE', '%iPhone%')
              ->orWhere('user_agent', 'LIKE', '%iPad%');
        })->count();
        $desktopVisitors = max(0, $totalVisitorRecords - $mobileVisitors);
        $mobilePct = $totalVisitorRecords > 0 ? round(($mobileVisitors / $totalVisitorRecords) * 100, 1) : 0;
        $desktopPct = $totalVisitorRecords > 0 ? round(100 - $mobilePct, 1) : 100;

        // Data Grafik Kategori Regulasi
        $chartCatLabels = $jenisDistribution->pluck('nama')->toArray();
        $chartCatCounts = $jenisDistribution->pluck('peraturans_count')->toArray();

        return view('admin.dashboard', compact(
            'greeting',
            'formattedTimeWib',
            'totalJenis',
            'totalPeraturan',
            'totalBerita',
            'totalPengumuman',
            'totalStruktur',
            'totalAdmin',
            'totalBerlaku',
            'totalTidakBerlaku',
            'rasioBerlaku',
            'jenisDistribution',
            'visitorStats',
            'chartDays',
            'chartVisitors',
            'chartDays30',
            'chartVisitors30',
            'avgVisitors',
            'avgVisitors30',
            'maxVisitorVal',
            'maxVisitorDay',
            'maxVisitor30Val',
            'maxVisitor30Day',
            'chartMonths',
            'chartVisitorsMonth',
            'avgVisitorsMonth',
            'maxVisitorMonthVal',
            'maxVisitorMonthLabel',
            'visitorsThisMonth',
            'visitorsLastMonth',
            'chartYears',
            'chartVisitorsYear',
            'avgVisitorsYear',
            'maxVisitorYearVal',
            'maxVisitorYearLabel',
            'visitorsThisYear',
            'visitorsLastYear',
            'chartCatLabels',
            'chartCatCounts',
            'topJenisSummary',
            'totalVisitorRecords',
            'mobileVisitors',
            'desktopVisitors',
            'mobilePct',
            'desktopPct',
            'currentYear',
            'totalTahunIni',
            'totalWithPdf',
            'totalWithoutPdf',
            'rasioPdf',
            'recentPeraturans',
            'recentBeritas',
            'recentPengumumans'
        ));
    }

    /**
     * Halaman Kelola Admin (Khusus Super Admin)
     */
    public function superAdmin()
    {
        $admins = User::latest()->get();
        $totalSuperAdmin = User::where('role', 'super_admin')->count();
        $totalRegularAdmin = User::where('role', '!=', 'super_admin')->count();

        return view('super-admin.dashboard', compact(
            'admins',
            'totalSuperAdmin',
            'totalRegularAdmin'
        ));
    }

    /**
     * Tambah Akun Admin Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'nullable|in:super_admin,admin',
        ], [
            'name.required' => 'Nama admin wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar sebagai admin.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal terdiri dari 6 karakter.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'admin',
        ]);

        return redirect()->route('super-admin')
            ->with('success', 'Akun admin baru berhasil dibuat.');
    }

    /**
     * Hapus Akun Admin
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() === $user->id) {
            return redirect()->route('super-admin')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri saat sedang login!');
        }

        $user->delete();

        return redirect()->route('super-admin')
            ->with('success', "Akun admin {$user->name} berhasil dihapus.");
    }
}
