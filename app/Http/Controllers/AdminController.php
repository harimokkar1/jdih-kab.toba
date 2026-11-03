<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Carousel;
use App\Models\JenisPeraturan;
use App\Models\Pengumuman;
use App\Models\Peraturan;
use App\Models\StrukturOrganisasi;
use App\Models\User;
use App\Models\Visitor;
use App\Services\VisitorService;
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
        $totalCarousel = Carousel::count();
        $totalAdmin = User::count();

        // Kunjungan
        $visitorStats = $visitorService->getStats();

        // Data Terbaru
        $peraturanTerbaru = Peraturan::with('jenisPeraturan')->latest()->take(5)->get();
        $beritaTerbaru = Berita::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalJenis',
            'totalPeraturan',
            'totalBerita',
            'totalPengumuman',
            'totalStruktur',
            'totalCarousel',
            'totalAdmin',
            'visitorStats',
            'peraturanTerbaru',
            'beritaTerbaru'
        ));
    }

    /**
     * Halaman Kelola Admin (Khusus Super Admin)
     */
    public function superAdmin()
    {
        $admins = User::latest()->get();
        return view('super-admin.dashboard', compact('admins'));
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
