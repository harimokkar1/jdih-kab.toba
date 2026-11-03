<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CarouselController extends Controller
{
    /**
     * Tampilkan Halaman Kontak (Profil)
     */
    public function kontak()
    {
        $carousels = Carousel::latest()->get();
        return view('user.kontak', compact('carousels'));
    }

    /**
     * Tampilkan Halaman Sejarah (Profil)
     */
    public function sejarah()
    {
        $carousels = Carousel::latest()->get();
        return view('user.sejarah', compact('carousels'));
    }

    /**
     * Tampilkan Halaman Admin Carousel
     */
    public function index()
    {
        $carousels = Carousel::latest()->get();
        return view('admin.carousel', compact('carousels'));
    }

    /**
     * Simpan Slider Carousel Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ], [
            'title.required' => 'Judul banner carousel wajib diisi.',
            'image.required' => 'File gambar banner wajib diunggah.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau WEBP.',
            'image.max' => 'Ukuran gambar maksimal 5 MB.',
        ]);

        $folder = public_path('carousel');
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $file = $request->file('image');
        $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move($folder, $filename);

        Carousel::create([
            'title' => $request->title,
            'image' => $filename,
        ]);

        return redirect()->route('admin.carousel')
            ->with('success', 'Banner slider berhasil ditambahkan.');
    }

    /**
     * Update Carousel
     */
    public function update(Request $request, $id)
    {
        $carousel = Carousel::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ], [
            'title.required' => 'Judul banner carousel wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau WEBP.',
            'image.max' => 'Ukuran gambar maksimal 5 MB.',
        ]);

        $folder = public_path('carousel');

        if ($request->hasFile('image')) {
            $oldPath = $folder . '/' . $carousel->image;
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $file = $request->file('image');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($folder, $filename);

            $carousel->image = $filename;
        }

        $carousel->title = $request->title;
        $carousel->save();

        return redirect()->route('admin.carousel')
            ->with('success', 'Banner slider berhasil diperbarui.');
    }

    /**
     * Hapus Carousel
     */
    public function delete($id)
    {
        $carousel = Carousel::findOrFail($id);

        $path = public_path('carousel/' . $carousel->image);
        if (File::exists($path)) {
            File::delete($path);
        }

        $carousel->delete();

        return redirect()->route('admin.carousel')
            ->with('success', 'Banner slider berhasil dihapus.');
    }
}
