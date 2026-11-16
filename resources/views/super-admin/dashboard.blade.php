@extends('layouts.admin')

@section('title', 'Kelola Akun Administrator')
@section('breadcrumb', 'Manajemen Admin')

@section('content')

<!-- ============================================================
     1. PAGE HEADER (CLEAN & EXECUTIVE)
     ============================================================ -->
<div class="admin-page-header">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
            <h4 class="admin-page-title mb-0">Kelola Akun Administrator</h4>
            <span class="stat-pill stat-pill-slate">
                <span class="pulse-dot-emerald me-1"></span>
                Otorisasi Hak Akses Sistem
            </span>
        </div>
        <p class="admin-page-subtitle">Manajemen hak akses pengguna dan staf administrator portal JDIH Kabupaten Toba</p>
    </div>
    <div class="mt-3 mt-md-0">
        <button type="button" class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#modalTambahAdmin">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Admin Baru</span>
        </button>
    </div>
</div>

<!-- ============================================================
     2. STAT CARDS (3-COLUMN KPI)
     ============================================================ -->
<div class="row g-3 mb-4">
    <!-- TOTAL ADMINISTRATOR -->
    <div class="col-md-4 col-sm-6">
        <div class="admin-stat-card stat-card-blue">
            <div class="stat-card-top">
                <span class="stat-card-label">Total Administrator</span>
                <div class="stat-card-icon">
                    <i class="bi bi-people"></i>
                </div>
            </div>
            <div>
                <div class="stat-card-value">{{ count($admins) }}</div>
                <p class="stat-card-subtext">
                    <i class="bi bi-check2-circle text-primary"></i> Akun pengelola terdaftar di sistem
                </p>
            </div>
        </div>
    </div>

    <!-- SUPER ADMINISTRATOR -->
    <div class="col-md-4 col-sm-6">
        <div class="admin-stat-card stat-card-purple">
            <div class="stat-card-top">
                <span class="stat-card-label">Super Administrator</span>
                <div class="stat-card-icon">
                    <i class="bi bi-shield-check"></i>
                </div>
            </div>
            <div>
                <div class="stat-card-value" style="color: #6b21a8;">{{ $totalSuperAdmin ?? 1 }}</div>
                <p class="stat-card-subtext">
                    <i class="bi bi-key-fill text-purple"></i> Otorisasi penuh &amp; konfigurasi sistem
                </p>
            </div>
        </div>
    </div>

    <!-- STAF ADMINISTRATOR -->
    <div class="col-md-4 col-sm-12">
        <div class="admin-stat-card stat-card-cyan">
            <div class="stat-card-top">
                <span class="stat-card-label">Staf Administrator</span>
                <div class="stat-card-icon">
                    <i class="bi bi-person-badge"></i>
                </div>
            </div>
            <div>
                <div class="stat-card-value">{{ $totalRegularAdmin ?? 0 }}</div>
                <p class="stat-card-subtext">
                    <i class="bi bi-file-earmark-text text-info"></i> Pengelola dokumen peraturan &amp; berita
                </p>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
     3. TABEL DAFTAR ADMINISTRATOR
     ============================================================ -->
<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <h6 class="admin-card-title mb-0">Daftar Administrator</h6>
            <span class="badge bg-light text-dark border px-2">{{ count($admins) }} Akun</span>
        </div>
        <div class="position-relative" style="max-width: 260px;">
            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted small"></i>
            <input type="text" id="adminSearchInput" class="form-control form-control-sm ps-5" placeholder="Cari nama atau email..." style="border-radius: 8px;">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table admin-table-registry align-middle mb-0" id="tableAdminList">
            <thead>
                <tr>
                    <th class="ps-4 text-center" style="width: 60px;">No</th>
                    <th>Nama Administrator &amp; Akun</th>
                    <th>Alamat Email</th>
                    <th style="width: 170px;">Peran (Role)</th>
                    <th style="width: 160px;">Terdaftar Sejak</th>
                    <th class="text-center" style="width: 120px;">Status</th>
                    <th class="text-end pe-4" style="width: 130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $index => $adm)
                    @php
                        $initials = strtoupper(substr($adm->name, 0, 1));
                    @endphp
                    <tr>
                        <td class="ps-4 text-center">
                            <span class="table-rank-chip">{{ $index + 1 }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @if($adm->role === 'super_admin')
                                    <div class="admin-avatar-initial-circle" style="background: linear-gradient(135deg, #4338ca 0%, #1e1b4b 100%);">
                                        {{ $initials }}
                                    </div>
                                @else
                                    <div class="admin-avatar-initial-circle level-2">
                                        {{ $initials }}
                                    </div>
                                @endif
                                <div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="d-block fw-semibold text-dark" style="font-size: 0.875rem;">{{ $adm->name }}</span>
                                        @if(auth()->id() === $adm->id)
                                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill py-1 px-2" style="font-size: 0.68rem;">
                                                Akun Anda
                                            </span>
                                        @endif
                                    </div>
                                    <span class="text-muted" style="font-size: 0.72rem;">ID Pengguna: #{{ $adm->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-muted small"><i class="bi bi-envelope me-1 text-secondary"></i>{{ $adm->email }}</span>
                        </td>
                        <td>
                            @if($adm->role === 'super_admin')
                                <span class="badge-role-super">
                                    <i class="bi bi-shield-fill-check"></i> Super Admin
                                </span>
                            @else
                                <span class="badge-role-admin">
                                    <i class="bi bi-person-badge"></i> Admin Staf
                                </span>
                            @endif
                        </td>
                        <td>
                            <span class="text-dark small d-block">
                                <i class="bi bi-calendar3 me-1 text-muted"></i>{{ $adm->created_at ? $adm->created_at->format('d/m/Y') : '-' }}
                            </span>
                            <span class="text-muted" style="font-size: 0.72rem;">
                                <i class="bi bi-clock me-1"></i>{{ $adm->created_at ? $adm->created_at->format('H:i') : '' }} WIB
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="badge-status-pill-active">
                                <span class="pulse-dot-emerald me-1"></span>
                                Aktif
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            @if(auth()->id() !== $adm->id)
                                <button type="button" class="btn-action-icon btn-action-delete" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $adm->id }}" title="Hapus Administrator">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            @else
                                <span class="badge bg-light text-muted border px-3 py-1" style="font-size: 0.72rem;">
                                    <i class="bi bi-person-check-fill text-success me-1"></i> Sesi Aktif
                                </span>
                            @endif
                        </td>
                    </tr>

                    <!-- MODAL HAPUS ADMIN -->
                    @if(auth()->id() !== $adm->id)
                        <div class="modal fade" id="modalHapus{{ $adm->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
                                <div class="modal-content rounded-3 border-0 shadow">
                                    <form action="{{ route('admin.delete', $adm->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-header border-bottom py-3">
                                            <h6 class="modal-title fw-bold text-danger mb-0 d-flex align-items-center gap-2">
                                                <i class="bi bi-exclamation-triangle-fill"></i>
                                                <span>Konfirmasi Hapus Akun</span>
                                            </h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-4 text-center">
                                            <p class="text-muted small mb-2">Apakah Anda yakin ingin menghapus akses administrator berikut?</p>
                                            <div class="p-3 bg-light rounded-3 border my-3 text-start">
                                                <strong class="text-dark d-block">{{ $adm->name }}</strong>
                                                <span class="text-muted small">{{ $adm->email }}</span>
                                            </div>
                                            <p class="text-danger small mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                                        </div>
                                        <div class="modal-footer border-top p-3">
                                            <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-sm btn-danger px-3 fw-semibold">Hapus Akun</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted small">
                            Belum ada akun administrator terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ============================================================
     4. MODAL TAMBAH ADMIN BARU
     ============================================================ -->
<div class="modal fade" id="modalTambahAdmin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-modern-md">
        <div class="modal-content rounded-3 border-0 shadow">
            <form action="{{ route('admin.store') }}" method="POST">
                @csrf
                <div class="modal-header d-flex align-items-center justify-content-between py-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="modal-header-icon-squircle icon-squircle-blue">
                            <i class="bi bi-person-gear"></i>
                        </div>
                        <div>
                            <h6 class="modal-title fw-semibold text-dark mb-0">Tambah Akun Administrator</h6>
                            <span class="text-muted" style="font-size: 0.72rem;">Daftarkan aparatur pengelola sistem dan atur hak akses</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-dark mb-1">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Nama staf / pejabat..." required>
                            </div>
                            <div class="mb-0">
                                <label class="form-label small fw-semibold text-dark mb-1">Alamat Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" placeholder="nama@jdih.tobakab.go.id" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-dark mb-1">Kata Sandi (Password) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Minimal 6 karakter..." minlength="6" required>
                                    <button class="btn btn-outline-secondary" type="button" id="btnTogglePassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Minimal 6 karakter alfanumerik</small>
                            </div>
                            <div class="mb-0">
                                <label class="form-label small fw-semibold text-dark mb-1">Peran Akses (Role)</label>
                                <select name="role" class="form-select">
                                    <option value="admin" selected>Admin Standar (Kelola Dokumen &amp; Berita)</option>
                                    <option value="super_admin">Super Admin (Hak Penuh &amp; Kelola Akun)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top p-3">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-admin-primary px-3 fw-semibold">Buat Akun Administrator</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Table Filter Search
        const searchInput = document.getElementById('adminSearchInput');
        const tableBody = document.querySelector('#tableAdminList tbody');

        if (searchInput && tableBody) {
            searchInput.addEventListener('keyup', function () {
                const query = searchInput.value.toLowerCase().trim();
                const rows = tableBody.querySelectorAll('tr');

                rows.forEach(function (row) {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(query) ? '' : 'none';
                });
            });
        }

        // Toggle Password Visibility
        const btnTogglePassword = document.getElementById('btnTogglePassword');
        const inputPassword = document.getElementById('inputPassword');

        if (btnTogglePassword && inputPassword) {
            btnTogglePassword.addEventListener('click', function () {
                const isPassword = inputPassword.getAttribute('type') === 'password';
                inputPassword.setAttribute('type', isPassword ? 'text' : 'password');
                btnTogglePassword.innerHTML = isPassword ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>';
            });
        }
    });
</script>
@endpush
