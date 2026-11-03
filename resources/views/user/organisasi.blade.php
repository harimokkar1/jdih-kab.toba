@extends('layouts.app')

@section('title', 'Struktur Organisasi - JDIH Kabupaten Toba')

@section('content')
<div class="py-4 bg-light border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Struktur Organisasi</li>
            </ol>
        </nav>
        <h2 class="fw-bold mb-0"><i class="bi bi-diagram-3 text-primary me-2"></i> Bagan Struktur Organisasi</h2>
        <p class="text-muted small mb-0 mt-1">Bagian Hukum Sekretariat Daerah Kabupaten Toba</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="row g-4 justify-content-center">
                @forelse($struktur as $leader)
                    <!-- PIMPINAN (Level 1) -->
                    <div class="col-md-5 col-lg-4 text-center">
                        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100 hover-shadow transition">
                            <div class="mb-3 mx-auto">
                                @if($leader->foto)
                                    <img src="{{ asset('storage/' . $leader->foto) }}" class="rounded-circle border p-1 shadow-sm" width="130" height="130" style="object-fit: cover;" alt="{{ $leader->nama }}">
                                @else
                                    <div class="rounded-circle bg-light border mx-auto d-flex align-items-center justify-content-center text-primary fs-1 shadow-sm" style="width: 130px; height: 130px;">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                @endif
                            </div>
                            <h5 class="fw-bold text-dark mb-1">{{ $leader->nama }}</h5>
                            <span class="badge bg-primary rounded-pill px-3 py-1 fs-6 mb-2">{{ $leader->jabatan }}</span>
                        </div>
                    </div>

                    <!-- SUBORDINATE / BAWAHAN (Level 2+) -->
                    @if($leader->children && $leader->children->count() > 0)
                        <div class="col-12 mt-4">
                            <div class="text-center my-3 position-relative">
                                <hr class="border-2 border-primary opacity-25">
                                <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 fw-bold text-primary small text-uppercase">
                                    Sub Bagian / Tim Kerja
                                </span>
                            </div>
                        </div>

                        @foreach($leader->children as $child)
                            <div class="col-md-4 col-sm-6 text-center">
                                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100 hover-shadow transition">
                                    <div class="mb-3 mx-auto">
                                        @if($child->foto)
                                            <img src="{{ asset('storage/' . $child->foto) }}" class="rounded-circle border p-1 shadow-sm" width="100" height="100" style="object-fit: cover;" alt="{{ $child->nama }}">
                                        @else
                                            <div class="rounded-circle bg-light border mx-auto d-flex align-items-center justify-content-center text-secondary fs-2 shadow-sm" style="width: 100px; height: 100px;">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <h6 class="fw-bold text-dark mb-1">{{ $child->nama }}</h6>
                                    <span class="badge bg-light text-primary border rounded-pill px-3 py-1 mb-2">{{ $child->jabatan }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @empty
                    <div class="col-12 text-center py-5 bg-white rounded-4 border text-muted">
                        <i class="bi bi-diagram-3 fs-1 text-secondary mb-2 d-block"></i>
                        <h6 class="fw-bold">Data struktur organisasi belum ditambahkan</h6>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
