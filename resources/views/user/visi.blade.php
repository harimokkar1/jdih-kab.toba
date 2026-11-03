@extends('layouts.app')

@section('title', 'Visi & Misi - JDIH Kabupaten Toba')

@section('content')
<div class="py-4 bg-light border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Visi & Misi</li>
            </ol>
        </nav>
        <h2 class="fw-bold mb-0"><i class="bi bi-compass text-primary me-2"></i> Visi & Misi Kabupaten Toba</h2>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center g-4">
        <div class="col-lg-10">
            <!-- VISI -->
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white mb-4 border-start border-4 border-primary">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 text-primary fs-3">
                        <i class="bi bi-eye-fill"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase fw-bold">Pemerintah Kabupaten Toba</span>
                        <h3 class="fw-bold text-dark mb-0">Visi Daerah</h3>
                    </div>
                </div>
                <blockquote class="blockquote p-4 bg-light rounded-3 mb-0" style="font-size: 1.15rem; line-height: 1.8; border-left: 4px solid var(--jdih-accent);">
                    <p class="mb-0 fw-semibold text-primary">
                        "{{ $data->visi ?? 'Terwujudnya Kabupaten Toba yang Unggul, Berkarakter, Maju, dan Berkelanjutan.' }}"
                    </p>
                </blockquote>
            </div>

            <!-- MISI -->
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white border-start border-4 border-warning">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 text-warning fs-3">
                        <i class="bi bi-flag-fill"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase fw-bold">Pemerintah Kabupaten Toba</span>
                        <h3 class="fw-bold text-dark mb-0">Misi Daerah</h3>
                    </div>
                </div>
                <div class="content-text text-muted" style="line-height: 2; font-size: 1.05rem;">
                    {!! nl2br(e($data->misi ?? "1. Mewujudkan tata kelola pemerintahan yang baik, bersih, dan berwibawa.\n2. Meningkatkan pelayanan publik dan kepastian hukum yang berkeadilan.\n3. Mengembangkan potensi sumber daya daerah dan pariwisata berkelanjutan.")) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
