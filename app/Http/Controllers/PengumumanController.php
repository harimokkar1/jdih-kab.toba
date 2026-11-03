<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PengumumanController extends Controller
{
    // ==============================
    // ADMIN - INDEX
    // ==============================
    public function index(Request $request)
    {
        $query = Pengumuman::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('isi', 'like', '%' . $search . '%');
            });
        }

        $pengumumans = $query
            ->orderBy('tanggal_upload', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.pengumuman', compact('pengumumans'));
    }

    // ==============================
    // ADMIN - STORE
    // ==============================
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal_upload' => 'required|date',
            'file_pdf' => 'nullable|mimes:pdf|max:10240',
        ]);

        $fileName = null;

        if ($request->hasFile('file_pdf')) {

            $file = $request->file('file_pdf');

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/pengumuman'),
                $fileName
            );
        }

        Pengumuman::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal_upload' => $request->tanggal_upload,
            'file_pdf' => $fileName,
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }


    // ==============================
    // ADMIN - UPDATE
    // ==============================
    public function update(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal_upload' => 'required|date',
            'file_pdf' => 'nullable|mimes:pdf|max:10240',
        ]);

        $fileName = $pengumuman->file_pdf;

        if ($request->hasFile('file_pdf')) {

            if (
                $fileName &&
                File::exists(public_path('uploads/pengumuman/' . $fileName))
            ) {
                File::delete(
                    public_path('uploads/pengumuman/' . $fileName)
                );
            }

            $file = $request->file('file_pdf');

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/pengumuman'),
                $fileName
            );
        }

        $pengumuman->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal_upload' => $request->tanggal_upload,
            'file_pdf' => $fileName,
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }


    // ==============================
    // ADMIN - DELETE
    // ==============================
    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        if (
            $pengumuman->file_pdf &&
            File::exists(
                public_path('uploads/pengumuman/' . $pengumuman->file_pdf)
            )
        ) {
            File::delete(
                public_path('uploads/pengumuman/' . $pengumuman->file_pdf)
            );
        }

        $pengumuman->delete();

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }


    // ==============================
    // USER - INDEX
    // ==============================
    public function userIndex()
    {   
        $pengumumans = Pengumuman::orderBy('tanggal_upload', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('user.pengumuman', compact('pengumumans'));
    }


    // ==============================
    // USER - DETAIL
    // ==============================
    public function show($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        return view(
            'user.pengumuman-detail',
            compact('pengumuman')
        );
    }
}
