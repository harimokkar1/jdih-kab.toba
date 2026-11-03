@extends('layouts.admin')

@section('title', 'Kelola Admin Sistem')
@section('page-title', 'Kelola Akun Administrator (Super Admin)')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted small mb-0">Manajemen hak akses pengguna dan staf administrator portal JDIH Kabupaten Toba</p>
    </div>
    <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahAdmin">
        <i class="bi bi-person-plus-fill me-1"></i> Tambah Admin Baru
    </button>
</div>

<!-- TABEL DAFTAR ADMIN -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-muted small text-uppercase">
                <tr>
                    <th class="ps-4" style="width: 60px;">No</th>
                    <th>Nama Administrator</th>
                    <th>Email</th>
                    <th>Peran (Role)</th>
                    <th>Terdaftar Sejak</th>
                    <th class="text-end pe-4" style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $index => $adm)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">{{ $index + 1 }}</td>
                        <td>
                            <strong class="text-dark">{{ $adm->name }}</strong>
                            @if(auth()->id() === $adm->id)
                                <span class="badge bg-light text-primary border ms-2">Akun Anda</span>
                            @endif
                        </td>
                        <td><span class="text-muted">{{ $adm->email }}</span></td>
                        <td>
                            <span class="badge {{ $adm->role === 'super_admin' ? 'bg-danger' : 'bg-primary' }} rounded-pill px-3 py-1">
                                {{ $adm->role === 'super_admin' ? 'Super Admin' : 'Admin' }}
                            </span>
                        </td>
                        <td><small class="text-muted">{{ $adm->created_at ? $adm->created_at->format('d/m/Y H:i') : '-' }}</small></td>
                        <td class="text-end pe-4">
                            @if(auth()->id() !== $adm->id)
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $adm->id }}" title="Hapus Admin">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            @else
                                <span class="badge bg-light text-muted border">Aktif</span>
                            @endif
                        </td>
                    </tr>

                    <!-- MODAL HAPUS -->
                    @if(auth()->id() !== $adm->id)
                        <div class="modal fade" id="modalHapus{{ $adm->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-4 border-0 shadow">
                                    <form action="{{ route('admin.delete', $adm->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-header border-bottom">
                                            <h5 class="modal-title fw-bold text-danger">Konfirmasi Hapus Admin</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-4 text-center">
                                            <i class="bi bi-exclamation-triangle text-danger display-4 mb-3 d-block"></i>
                                            <p class="mb-1">Apakah Anda yakin ingin menghapus akses administrator untuk:</p>
                                            <h6 class="fw-bold">{{ $adm->name }} ({{ $adm->email }})?</h6>
                                        </div>
                                        <div class="modal-footer border-top">
                                            <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger rounded-pill px-4">Ya, Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Belum ada akun admin terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH ADMIN -->
<div class="modal fade" id="modalTambahAdmin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="{{ route('admin.store') }}" method="POST">
                @csrf
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold">Tambah Akun Administrator Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Nama staf / admin..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Alamat Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="admin@jdih.tobakab.go.id" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Kata Sandi (Password) <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter..." minlength="6" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Peran (Role Akses)</label>
                        <select name="role" class="form-select">
                            <option value="admin">Admin Standar (Kelola Dokumen & Berita)</option>
                            <option value="super_admin">Super Admin (Hak Penuh & Kelola Admin)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Buat Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
