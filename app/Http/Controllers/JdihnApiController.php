<?php

namespace App\Http\Controllers;

use App\Models\Peraturan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JdihnApiController extends Controller
{
    /**
     * Endpoint Integrasi JDIHN BPHN Nasional (Requirement #5)
     */
    public function index(Request $request): JsonResponse
    {
        $query = Peraturan::with('jenisPeraturan')->latest();

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        if ($request->filled('jenis')) {
            $query->whereHas('jenisPeraturan', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->jenis . '%')
                    ->orWhere('singkatan', 'like', '%' . $request->jenis . '%');
            });
        }

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $limit = $request->integer('limit', 50);
        $peraturans = $query->paginate($limit);

        $data = $peraturans->getCollection()->map(function ($item) {
            $filename = basename($item->file_dokumen);
            $urlDownload = str_starts_with($item->file_dokumen, 'http')
                ? $item->file_dokumen
                : url($item->file_dokumen);

            return [
                'idData' => (string)$item->id,
                'tahun_pengundangan' => (string)($item->tahun ?? ($item->tanggal_pengundangan ? $item->tanggal_pengundangan->format('Y') : '')),
                'tanggal_pengundangan' => $item->tanggal_pengundangan ? $item->tanggal_pengundangan->format('Y-m-d') : ($item->tanggal_penetapan ? $item->tanggal_penetapan->format('Y-m-d') : ''),
                'jenis' => (string)($item->jenisPeraturan->nama ?? 'Peraturan Daerah'),
                'noPeraturan' => (string)($item->nomor_peraturan ?? ''),
                'judul' => (string)$item->judul,
                'noPanggil' => '-',
                'singkatanJenis' => (string)($item->jenisPeraturan->singkatan ?? 'PERDA'),
                'tempatTerbit' => (string)($item->tempat_penetapan ?? 'Balige'),
                'penerbit' => 'Pemerintah Kabupaten Toba',
                'deskripsiFisik' => '-',
                'sumber' => (string)($item->sumber ?? '-'),
                'subjek' => (string)($item->subjek ?? '-'),
                'isbn' => '-',
                'status' => $item->status === 'BERLAKU' ? 'Berlaku' : 'Tidak Berlaku',
                'bahasa' => (string)($item->bahasa ?? 'Bahasa Indonesia'),
                'bidangHukum' => (string)($item->bidang_hukum ?? 'Hukum Umum'),
                'teuBadan' => (string)($item->teu_badan ?? 'Indonesia.Pemerintah Kabupaten Toba'),
                'nomorIndukBuku' => '-',
                'fileDownload' => $filename,
                'urlDownload' => $urlDownload,
                'urlDetailPeraturan' => route('user.produk-hukum.detail', $item->id),
                'operasi' => '4',
                'display' => '1',
            ];
        });

        return response()->json([
            'status' => 'success',
            'meta' => [
                'portal' => 'JDIH Kabupaten Toba',
                'standard' => 'JDIHN BPHN Kemenkumham RI',
                'total' => $peraturans->total(),
                'current_page' => $peraturans->currentPage(),
                'last_page' => $peraturans->lastPage(),
                'per_page' => $peraturans->perPage(),
            ],
            'data' => $data,
        ], 200, ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     * Endpoint Single Item JDIHN
     */
    public function show($id): JsonResponse
    {
        $item = Peraturan::with('jenisPeraturan')->findOrFail($id);
        $filename = basename($item->file_dokumen);
        $urlDownload = str_starts_with($item->file_dokumen, 'http')
            ? $item->file_dokumen
            : url($item->file_dokumen);

        $payload = [
            'idData' => (string)$item->id,
            'tahun_pengundangan' => (string)($item->tahun ?? ''),
            'tanggal_pengundangan' => $item->tanggal_pengundangan ? $item->tanggal_pengundangan->format('Y-m-d') : '',
            'jenis' => (string)($item->jenisPeraturan->nama ?? 'Peraturan Daerah'),
            'noPeraturan' => (string)($item->nomor_peraturan ?? ''),
            'judul' => (string)$item->judul,
            'noPanggil' => '-',
            'singkatanJenis' => (string)($item->jenisPeraturan->singkatan ?? 'PERDA'),
            'tempatTerbit' => (string)($item->tempat_penetapan ?? 'Balige'),
            'penerbit' => 'Pemerintah Kabupaten Toba',
            'deskripsiFisik' => '-',
            'sumber' => (string)($item->sumber ?? '-'),
            'subjek' => (string)($item->subjek ?? '-'),
            'isbn' => '-',
            'status' => $item->status === 'BERLAKU' ? 'Berlaku' : 'Tidak Berlaku',
            'bahasa' => (string)($item->bahasa ?? 'Bahasa Indonesia'),
            'bidangHukum' => (string)($item->bidang_hukum ?? '-'),
            'teuBadan' => (string)($item->teu_badan ?? 'Indonesia.Pemerintah Kabupaten Toba'),
            'nomorIndukBuku' => '-',
            'fileDownload' => $filename,
            'urlDownload' => $urlDownload,
            'urlDetailPeraturan' => route('user.produk-hukum.detail', $item->id),
            'operasi' => '4',
            'display' => '1',
        ];

        return response()->json($payload, 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
