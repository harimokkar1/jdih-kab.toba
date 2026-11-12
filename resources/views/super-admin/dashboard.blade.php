@extends('layouts.admin')

@section('title', 'Kelola Akun Administrator')
@section('breadcrumb', 'Manajemen Admin')

@section('content')

<!-- ============================================================
     PAGE HEADER (CLEAN & NON-REDUNDANT)
     ============================================================ -->
<div class="admin-page-header">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
            <h4 class="admin-page-title mb-0">Kelola Akun Administrator</h4>
            <span class="admin-header-badge">
                <span class="badge-dot"></span>
                Otorisasi Hak Akses Sistem
            </span>
        </div>
        <p class="admin-page-subtitle">Manajemen hak akses pengguna dan staf administrator portal JDIH Kabupaten Toba</p>
    </div>
    <div class="mt-3 mt-md-0">
        <button type="button" class="btn-admin-primary" data-bs-toggle="modal" data-bs-target="#modalTambahAdmin">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Admin Baru</span>
        </button>
    </div>
</div>

<!-- ============================================================
     STAT CARDS (CLEAN, MINIMALIST & HARMONIOUS)
     ============================================================ -->
<div class="row g-3 mb-4">
    <!-- TOTAL ADMINISTRATOR -->
    <div class="col-xl-3 col-sm-6">
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
    <div class="col-xl-3 col-sm-6">
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
    <div class="col-xl-3 col-sm-6">
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

    <!-- KEAMANAN SISTEM -->
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card stat-card-emerald">
            <div class="stat-card-top">
                <span class="stat-card-label">Status Akses</span>
                <div class="stat-card-icon">
                    <i class="bi bi-lock"></i>
                </div>
            </div>
            <div>
                <div class="stat-card-value text-success">Aktif</div>
                <div class="stat-card-subtext">
                    <span class="badge-status-pill status-active">
                        <span class="status-dot status-dot-emerald"></span>
                        Enkripsi Bcrypt &amp; RBAC
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
     TABEL ADMINISTRATOR
     ============================================================ -->
<div class="admin-card">
    <div class="admin-card-header">
        <div class="d-flex align-items-center gap-2">
            <h6 class="admin-card-title mb-0">Daftar Administrator</h6>
            <span class="badge bg-light text-dark border px-2">{{ count($admins) }} Akun</span>
        </div>
        <div class="position-relative">
            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted small"></i>
            <input type="text" id="adminSearchInput" class="table-search-input" placeholder="Cari nama atau email...">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table admin-table align-middle mb-0" id="tableAdminList">
            <thead>
                <tr>
                    <th class="ps-4 text-center" style="width: 50px;">No</th>
                    <th>Administrator</th>
                    <th>Alamat Email</th>
                    <th>Peran (Role)</th>
                    <th>Terdaftar Sejak</th>
                    <th>Status</th>
                    <th class="text-end pe-4" style="width: 140px;">Aksi</th>
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
                            <div class="d-flex align-items-center gap-2">
                                @if($adm->role === 'super_admin')
                                    <div class="table-avatar-initial" style="background: linear-gradient(135deg, #1e1b4b 0%, #4338ca 100%);">
                                        {{ $initials }}
                                    </div>
                                @else
                                    <div class="table-avatar-initial initial-admin">
                                        {{ $initials }}
                                    </div>
                                @endif
                                <div>
                                    <strong class="text-dark d-block">{{ $adm->name }}</strong>
                                    @if(auth()->id() === $adm->id)
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill py-0 px-2 small">
                                            Akun Anda
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-muted">{{ $adm->email }}</span>
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
                            <span class="text-dark small d-block"><i class="bi bi-calendar3 me-1 text-muted"></i>{{ $adm->created_at ? $adm->created_at->format('d/m/Y') : '-' }}</span>
                            <small class="text-muted"><i class="bi bi-clock me-1"></i>{{ $adm->created_at ? $adm->created_at->format('H:i') : '' }} WIB</small>
                        </td>
                        <td>
                            <span class="badge-status-pill status-active">
                                <span class="status-dot status-dot-emerald"></span>
                                Aktif
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            @if(auth()->id() !== $adm->id)
                                <button type="button" class="btn-table-action-delete" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $adm->id }}" title="Hapus Administrator">
                                    <i class="bi bi-trash3"></i>
                                    <span>Hapus</span>
                                </button>
                            @else
                                <span class="badge bg-light text-muted border px-2 py-1">
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
                                            <h6 class="modal-title fw-bold text-danger mb-0">
                                                <i class="bi bi-exclamation-triangle me-1"></i> Konfirmasi Hapus Admin
                                            </h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-4 text-center">
                                            <p class="text-muted small mb-2">Apakah Anda yakin ingin menghapus akses administrator berikut?</p>
                                            <div class="p-3 bg-light rounded-3 border my-3">
                                                <strong class="text-dark d-block">{{ $adm->name }}</strong>
                                                <span class="text-muted small">{{ $adm->email }}</span>
                                            </div>
                                            <p class="text-danger small mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                                        </div>
                                        <div class="modal-footer border-top py-2">
                                            <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-sm btn-danger px-3">Hapus Akun</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted small">
                            Belum ada akun administrator terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ============================================================
     MODAL TAMBAH ADMIN BARU
     ============================================================ -->
<div class="modal fade" id="modalTambahAdmin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
        <div class="modal-content rounded-3 border-0 shadow">
            <form action="{{ route('admin.store') }}" method="POST">
                @csrf
                <div class="modal-header border-bottom py-3">
                    <h6 class="modal-title fw-bold text-dark mb-0">Tambah Akun Administrator</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark mb-1">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control form-control-sm" placeholder="Nama staf / pejabat..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark mb-1">Alamat Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control form-control-sm" placeholder="nama@jdih.tobakab.go.id" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark mb-1">Kata Sandi (Password) <span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm">
                            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Minimal 6 karakter..." minlength="6" required>
                            <button class="btn btn-outline-secondary" type="button" id="btnTogglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <small class="text-muted">Minimal 6 karakter.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark mb-1">Peran Akses (Role)</label>
                        <select name="role" class="form-select form-select-sm">
                            <option value="admin" selected>Admin Standar (Kelola Dokumen &amp; Berita)</option>
                            <option value="super_admin">Super Admin (Hak Penuh &amp; Kelola Akun)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top py-2">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-primary px-3">Buat Akun</button>
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
