<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel;
use Illuminate\Support\Facades\File;

class CarouselController extends Controller
{
    public function home()
    {
        $carousels = Carousel::latest()->get();

        $beritas = \App\Models\Berita::latest()->take(3)->get();

        return view('user.home', compact('carousels', 'beritas'));
    }

    public function kontak()
    {
        $carousels = Carousel::all();

        return view('user.kontak', compact('carousels'));
    }


    // tampil halaman
    public function index()
    {
        $carousels = Carousel::all();
        return view('admin.carousel', compact('carousels'));
    }

    // simpan data
    public function store(Request $request)
    {
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('carousel'), $filename);

        Carousel::create([
            'title' => $request->title,
            'image' => $filename
        ]);

        return back();
    }

    // hapus data + file
    public function delete($id)
    {
        $carousel = Carousel::find($id);

        $path = public_path('carousel/' . $carousel->image);
        if (File::exists($path)) {
            File::delete($path);
        }

        $carousel->delete();

        return back();
    }

    // form edit
    public function edit($id)
    {
        $carousel = Carousel::find($id);
        return view('admin.carousel-edit', compact('carousel'));
    }

    // update
    public function update(Request $request, $id)
    {
        $carousel = Carousel::find($id);

        if ($request->hasFile('image')) {

            // hapus gambar lama
            $oldPath = public_path('carousel/' . $carousel->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            // upload baru
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('carousel'), $filename);

            $carousel->image = $filename;
        }

        $carousel->title = $request->title;
        $carousel->save();

        return redirect('/admin/carousel');
    }

    public function sejarah()
    {
        $carousels = Carousel::all();
        return view('user.sejarah', compact('carousels'));
    }
}
