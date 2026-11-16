@extends('layouts.admin')

@section('title', 'Kelola Visi & Misi')
@section('breadcrumb', 'Visi & Misi')
@section('page-title', 'Pengaturan Visi & Misi')

@section('content')

<!-- ============================================================
     1. PAGE HEADER (CLEAN & EXECUTIVE)
     ============================================================ -->
<div class="admin-page-header">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
            <h4 class="admin-page-title mb-0">Visi &amp; Misi Pemerintah Kabupaten Toba</h4>
            <span class="stat-pill stat-pill-slate">
                <span class="pulse-dot-emerald me-1"></span>
                Pedoman RPJMD Daerah
            </span>
        </div>
        <p class="admin-page-subtitle">Pernyataan visi pembangunan hukum dan butir-butir misi strategis yang dipublikasikan pada portal publik JDIH</p>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
        <a href="{{ route('visi') }}" target="_blank" class="btn btn-sm btn-outline-secondary px-3 py-2 fw-semibold rounded-3 d-flex align-items-center gap-2" style="height: 38px;">
            <i class="bi bi-box-arrow-up-right text-primary"></i>
            <span>Pratinjau Publik</span>
        </a>
    </div>
</div>

<!-- ============================================================
     2. SPLIT INTERFACE: EDITOR & LIVE PORTAL PREVIEW
     ============================================================ -->
<div class="row g-4">
    <!-- KOLOM KIRI: FORMULIR EDITOR INTERAKTIF -->
    <div class="col-lg-7">
        <div class="admin-card">
            <div class="admin-card-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="modal-header-icon-squircle icon-squircle-blue">
                        <i class="bi bi-compass"></i>
                    </div>
                    <div>
                        <h6 class="admin-card-title mb-0">Formulir Pernyataan Resmi</h6>
                        <span class="text-muted" style="font-size: 0.72rem;">Naskah visi dan butir-butir misi RPJMD Kabupaten Toba</span>
                    </div>
                </div>
            </div>

            <div class="p-4">
                <form action="{{ route('admin.visi.save') }}" method="POST" id="formVisiMisi">
                    @csrf

                    <!-- 1. INPUT VISI DAERAH -->
                    <div class="mb-4 pb-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">
                            <label class="form-label small fw-semibold text-dark mb-0 d-flex align-items-center gap-2">
                                <span class="pill-type-badge pill-type-perda px-2 py-0" style="font-size: 0.68rem;">VISI</span>
                                <span>Visi Pembangunan Daerah</span>
                                <span class="text-danger">*</span>
                            </label>
                            <span id="visiStatCounter" class="stat-pill stat-pill-slate py-0 px-2" style="font-size: 0.7rem;">
                                0 Kata &bull; 0 Karakter
                            </span>
                        </div>
                        
                        <div class="visi-editor-box mb-2">
                            <textarea name="visi" id="inputVisi" class="visi-editor-textarea @error('visi') is-invalid @enderror" placeholder="Tuliskan pernyataan Visi resmi Pemerintah Kabupaten Toba..." rows="2" required>{{ old('visi', $data->visi ?? 'Terwujudnya Kabupaten Toba yang Unggul, Berkarakter, Maju, dan Berkelanjutan.') }}</textarea>
                        </div>
                        
                        <small class="text-muted d-flex align-items-center gap-1" style="font-size: 0.725rem;">
                            <i class="bi bi-info-circle text-primary"></i> Pernyataan arah filosofis jangka panjang RPJMD Pemerintah Kabupaten Toba.
                        </small>
                        @error('visi') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- 2. INPUT MISI STRATEGIS (INTERACTIVE BUILDER) -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                            <div>
                                <label class="form-label small fw-semibold text-dark mb-0 d-flex align-items-center gap-2">
                                    <span class="pill-type-badge pill-type-kepbup px-2 py-0" style="font-size: 0.68rem;">MISI</span>
                                    <span>Misi Pembangunan Strategis</span>
                                    <span class="text-danger">*</span>
                                </label>
                                <span class="text-muted d-block" style="font-size: 0.71rem;">Kelola butir-butir langkah strategis secara terstruktur dan dinamis</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span id="misiCounterBadge" class="badge bg-light text-primary border border-primary-subtle px-2 py-1" style="font-size: 0.7rem; font-weight: 700;">
                                    0 Butir Misi
                                </span>
                                <div class="misi-mode-toggle">
                                    <button type="button" class="misi-mode-btn active" id="btnModeCards" title="Mode kartu butir interaktif">
                                        <i class="bi bi-ui-checks me-1"></i> Mode Kartu
                                    </button>
                                    <button type="button" class="misi-mode-btn" id="btnModeRaw" title="Mode teks bebas / salin-tempel">
                                        <i class="bi bi-card-text me-1"></i> Teks Bebas
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden Form Textarea for Backend Submission & Two-Way Sync -->
                        <textarea name="misi" id="inputMisi" class="d-none @error('misi') is-invalid @enderror">{{ old('misi', $data->misi ?? '') }}</textarea>

                        <!-- MODE 1: KARTU BUTIR INTERAKTIF -->
                        <div id="containerMisiCards">
                            <div class="misi-builder-list mb-3" id="misiCardsList">
                                <!-- Populated dynamically by JavaScript -->
                            </div>

                            <button type="button" class="btn-add-misi-dashed" id="btnAddMisiRow">
                                <i class="bi bi-plus-circle-fill"></i>
                                <span>Tambah Butir Misi Baru</span>
                            </button>
                        </div>

                        <!-- MODE 2: TEKS BEBAS (RAW TEXTAREA) -->
                        <div id="containerMisiRaw" class="d-none">
                            <div class="misi-raw-wrapper mb-2">
                                <div class="misi-raw-toolbar">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-white text-dark border px-2 py-1 fw-semibold d-inline-flex align-items-center gap-1" style="font-size: 0.7rem;">
                                            <i class="bi bi-list-ol text-primary"></i> 1 Baris = 1 Butir Misi
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <button type="button" class="btn-tool" id="btnAutoFormatRaw" title="Bersihkan dan format ulang penomoran 1, 2, 3...">
                                            <i class="bi bi-magic text-primary"></i>
                                            <span>Format Nomor</span>
                                        </button>
                                        <button type="button" class="btn-tool" id="btnCopyRaw" title="Salin seluruh naskah misi ke clipboard">
                                            <i class="bi bi-clipboard text-primary"></i>
                                            <span id="copyRawLabel">Salin</span>
                                        </button>
                                        <button type="button" class="btn-tool btn-tool-danger" id="btnClearRaw" title="Kosongkan teks misi">
                                            <i class="bi bi-trash3 text-danger"></i>
                                            <span>Kosongkan</span>
                                        </button>
                                    </div>
                                </div>
                                <textarea id="rawMisiEditor" class="misi-raw-textarea" placeholder="1. Mewujudkan tata kelola...&#10;2. Meningkatkan pelayanan publik..."></textarea>
                                <div class="misi-raw-footer">
                                    <span class="d-flex align-items-center gap-1">
                                        <i class="bi bi-info-circle text-primary"></i> Tekan <strong>Enter</strong> untuk butir baru. Otomatis disinkronkan ke Mode Kartu &amp; Portal Publik.
                                    </span>
                                    <span id="rawMisiStats" class="badge bg-white text-muted border px-2 py-1">0 Butir &bull; 0 Kata</span>
                                </div>
                            </div>
                        </div>

                        @error('misi') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                    </div>

                    <!-- FOOTER ACTIONS -->
                    <div class="d-flex justify-content-end align-items-center border-top pt-3 mt-4">
                        <button type="submit" class="btn btn-admin-primary px-4 fw-semibold d-inline-flex align-items-center gap-2" id="btnSubmitVisiMisi">
                            <i class="bi bi-check2-circle"></i>
                            <span>Simpan Visi &amp; Misi</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- KOLOM KANAN: SIMULASI TAMPILAN PORTAL PUBLIK -->
    <div class="col-lg-5">
        <div class="admin-card">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="modal-header-icon-squircle icon-squircle-indigo">
                        <i class="bi bi-display"></i>
                    </div>
                    <div>
                        <h6 class="admin-card-title mb-0">Simulasi Tampilan Publik</h6>
                        <span class="text-muted" style="font-size: 0.72rem;">Pratinjau otomatis sinkron secara instan</span>
                    </div>
                </div>
            </div>

            <div class="p-4">
                <!-- PREVIEW KOP DAERAH -->
                <div class="text-center mb-4 pb-3 border-bottom">
                    <img src="{{ asset('logo.png') }}" alt="Logo Toba" style="height: 48px;" class="mb-2">
                    <h6 class="fw-semibold text-dark mb-0" style="font-size: 0.875rem;">PEMERINTAH KABUPATEN TOBA</h6>
                    <span class="text-muted" style="font-size: 0.72rem;">Dokumen Perencanaan Pembangunan Hukum Daerah</span>
                </div>

                <!-- PREVIEW VISI -->
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="pill-type-badge pill-type-perda">VISI</span>
                        <span class="small fw-semibold text-dark">Cita-Cita Bersama</span>
                    </div>
                    <div class="p-3 bg-light rounded-3 border position-relative" style="background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 100%);">
                        <i class="bi bi-quote text-primary opacity-25 position-absolute top-0 end-0 me-3 mt-1" style="font-size: 2.2rem;"></i>
                        <p class="text-dark fw-semibold mb-0" id="previewVisiText" style="font-size: 0.84rem; line-height: 1.6; font-style: italic; overflow-wrap: anywhere; word-break: break-word;">
                            {{ $data->visi ?? 'Pernyataan visi daerah akan muncul di sini...' }}
                        </p>
                    </div>
                </div>

                <!-- PREVIEW MISI -->
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <span class="pill-type-badge pill-type-kepbup">MISI</span>
                            <span class="small fw-bold text-dark">Arah Langkah Strategis</span>
                        </div>
                        <span class="badge bg-light text-muted border" id="previewMisiCount" style="font-size: 0.68rem;">0 Butir</span>
                    </div>

                    <div class="misi-preview-card" id="previewMisiContainer">
                        <!-- Populated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputVisi = document.getElementById('inputVisi');
        const inputMisi = document.getElementById('inputMisi');
        const visiStatCounter = document.getElementById('visiStatCounter');
        
        const previewVisiText = document.getElementById('previewVisiText');
        const previewMisiContainer = document.getElementById('previewMisiContainer');
        const previewMisiCount = document.getElementById('previewMisiCount');
        const misiCounterBadge = document.getElementById('misiCounterBadge');

        const containerMisiCards = document.getElementById('containerMisiCards');
        const containerMisiRaw = document.getElementById('containerMisiRaw');
        const misiCardsList = document.getElementById('misiCardsList');
        const rawMisiEditor = document.getElementById('rawMisiEditor');
        const btnAddMisiRow = document.getElementById('btnAddMisiRow');
        const btnModeCards = document.getElementById('btnModeCards');
        const btnModeRaw = document.getElementById('btnModeRaw');

        const btnAutoFormatRaw = document.getElementById('btnAutoFormatRaw');
        const btnCopyRaw = document.getElementById('btnCopyRaw');
        const copyRawLabel = document.getElementById('copyRawLabel');
        const btnClearRaw = document.getElementById('btnClearRaw');
        const rawMisiStats = document.getElementById('rawMisiStats');

        // State mission items
        let missionItems = [];

        // Parse initial mission string from DB
        function parseInitialMisi() {
            const raw = (inputMisi ? inputMisi.value : '') || '';
            const lines = raw.split(/\r\n|\r|\n/)
                .map(l => l.trim())
                .filter(l => l.length > 0);

            if (lines.length > 0) {
                missionItems = lines.map(line => line.replace(/^[\d]+[\.\-\)\s\u00A0]+/, '').replace(/^[\-\*\•\–]\s*/, '').trim());
            } else {
                missionItems = [
                    'Mewujudkan tata kelola pemerintahan yang baik, bersih, transparan, akuntabel, dan berwibawa berbasis teknologi informasi (SPBE).',
                    'Meningkatkan pelayanan publik prima serta kepastian hukum yang berkeadilan, inklusif, dan humanis bagi seluruh lapisan masyarakat.',
                    'Mengembangkan perekonomian daerah berbasis pertanian, pariwisata bertaraf internasional di kawasan Danau Toba, dan penguatan UMKM lokal.'
                ];
            }
        }

        // Auto-resize textarea height
        function autoResizeTextarea(el) {
            if (!el) return;
            el.style.height = 'auto';
            const minH = el === rawMisiEditor ? 220 : 36;
            el.style.height = Math.max(minH, el.scrollHeight + 4) + 'px';
        }

        function updateRawStats() {
            if (!rawMisiEditor || !rawMisiStats) return;
            const text = rawMisiEditor.value.trim();
            const lines = text ? text.split(/\r\n|\r|\n/).map(l => l.trim()).filter(l => l.length > 0) : [];
            const words = text ? text.split(/\s+/).filter(Boolean).length : 0;
            rawMisiStats.textContent = `${lines.length} Butir \u2022 ${words} Kata`;
        }

        // Escape HTML to prevent XSS and layout glitches
        function escapeHtml(str) {
            if (!str) return '';
            const div = document.createElement('div');
            div.textContent = str;
            return div.innerHTML;
        }

        // Render Cards Mode
        function renderCards() {
            if (!misiCardsList) return;
            misiCardsList.innerHTML = '';

            missionItems.forEach((itemText, index) => {
                const row = document.createElement('div');
                row.className = 'misi-builder-row';
                row.dataset.index = index;

                const displayNum = String(index + 1).padStart(2, '0');

                row.innerHTML = `
                    <div class="misi-builder-num">${displayNum}</div>
                    <textarea class="misi-builder-textarea" placeholder="Tuliskan butir misi strategis...">${itemText}</textarea>
                    <div class="misi-builder-actions">
                        <button type="button" class="misi-action-btn btn-move-up" title="Pindah ke atas" ${index === 0 ? 'disabled style="opacity:0.3;cursor:not-allowed;"' : ''}>
                            <i class="bi bi-chevron-up"></i>
                        </button>
                        <button type="button" class="misi-action-btn btn-move-down" title="Pindah ke bawah" ${index === missionItems.length - 1 ? 'disabled style="opacity:0.3;cursor:not-allowed;"' : ''}>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <button type="button" class="misi-action-btn btn-delete" title="Hapus butir ini">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </div>
                `;

                const textarea = row.querySelector('.misi-builder-textarea');

                // Enter key adds a new card row instead of creating an internal newline
                textarea.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        if (btnAddMisiRow) btnAddMisiRow.click();
                    }
                });

                textarea.addEventListener('input', function () {
                    // Strip newlines from card text to keep 1 card = 1 mission item
                    if (this.value.includes('\n') || this.value.includes('\r')) {
                        this.value = this.value.replace(/\r?\n+/g, ' ');
                    }
                    missionItems[index] = this.value;
                    autoResizeTextarea(this);
                    syncToBackendAndPreview();
                });

                // Move up
                row.querySelector('.btn-move-up')?.addEventListener('click', function () {
                    if (index > 0) {
                        const temp = missionItems[index];
                        missionItems[index] = missionItems[index - 1];
                        missionItems[index - 1] = temp;
                        renderCards();
                        syncToBackendAndPreview();
                    }
                });

                // Move down
                row.querySelector('.btn-move-down')?.addEventListener('click', function () {
                    if (index < missionItems.length - 1) {
                        const temp = missionItems[index];
                        missionItems[index] = missionItems[index + 1];
                        missionItems[index + 1] = temp;
                        renderCards();
                        syncToBackendAndPreview();
                    }
                });

                // Delete
                row.querySelector('.btn-delete')?.addEventListener('click', function () {
                    if (missionItems.length <= 1) {
                        missionItems[0] = '';
                    } else {
                        missionItems.splice(index, 1);
                    }
                    renderCards();
                    syncToBackendAndPreview();
                });

                misiCardsList.appendChild(row);
                setTimeout(() => autoResizeTextarea(textarea), 10);
            });
        }

        // Sync items array to hidden form input and live preview
        function syncToBackendAndPreview() {
            // Clean items: 1 line = 1 item with standard ASCII spaces for database submission
            const formattedLines = missionItems
                .map((text, idx) => {
                    const cleanText = text.replace(/\r?\n+/g, ' ').replace(/\u00A0/g, ' ').trim();
                    return `${idx + 1}. ${cleanText}`;
                })
                .filter(l => l.replace(/^[\d]+\.\s*/, '').length > 0);

            const rawValue = formattedLines.join('\n');
            if (inputMisi) inputMisi.value = rawValue;

            // Sync to raw textarea with non-breaking space (\u00A0) so the number never wraps alone
            if (rawMisiEditor && document.activeElement !== rawMisiEditor) {
                rawMisiEditor.value = missionItems
                    .map((t, i) => {
                        const clean = t.replace(/\r?\n+/g, ' ').trim();
                        return `${i + 1}.\u00A0${clean}`;
                    })
                    .join('\n');
                autoResizeTextarea(rawMisiEditor);
                updateRawStats();
            }

            const count = missionItems.filter(t => t.trim().length > 0).length;
            if (misiCounterBadge) misiCounterBadge.textContent = `${count} Butir Misi`;
            if (previewMisiCount) previewMisiCount.textContent = `${count} Butir`;

            // Update live preview list
            if (previewMisiContainer) {
                if (count === 0) {
                    previewMisiContainer.innerHTML = '<div class="text-muted small text-center py-3"><i class="bi bi-card-list me-1"></i>Belum ada butir misi yang dimasukkan.</div>';
                    return;
                }

                let html = '';
                missionItems.forEach((item, idx) => {
                    const clean = item.replace(/\r?\n+/g, ' ').trim();
                    if (!clean) return;
                    const displayNum = String(idx + 1).padStart(2, '0');
                    html += `
                        <div class="misi-preview-item">
                            <span class="misi-num-badge">${displayNum}</span>
                            <div class="misi-preview-text">${escapeHtml(clean)}</div>
                        </div>
                    `;
                });
                previewMisiContainer.innerHTML = html;
            }
        }

        // Add new mission row
        if (btnAddMisiRow) {
            btnAddMisiRow.addEventListener('click', function () {
                missionItems.push('');
                renderCards();
                syncToBackendAndPreview();
                const lastRow = misiCardsList.lastElementChild;
                const lastTextarea = lastRow?.querySelector('.misi-builder-textarea');
                if (lastTextarea) lastTextarea.focus();
            });
        }

        // Mode switch: Cards vs Raw
        if (btnModeCards && btnModeRaw) {
            btnModeCards.addEventListener('click', function () {
                btnModeCards.classList.add('active');
                btnModeRaw.classList.remove('active');
                containerMisiCards.classList.remove('d-none');
                containerMisiRaw.classList.add('d-none');
                renderCards();
            });

            btnModeRaw.addEventListener('click', function () {
                btnModeRaw.classList.add('active');
                btnModeCards.classList.remove('active');
                containerMisiCards.classList.add('d-none');
                containerMisiRaw.classList.remove('d-none');
                if (rawMisiEditor) {
                    // Use non-breaking space \u00A0 between number and text so browser never wraps number alone
                    const formatted = missionItems
                        .map((t, i) => {
                            const clean = t.replace(/\r?\n+/g, ' ').trim();
                            return `${i + 1}.\u00A0${clean}`;
                        })
                        .join('\n');
                    rawMisiEditor.value = formatted;
                    autoResizeTextarea(rawMisiEditor);
                    updateRawStats();
                    // Always show from line 1 (no scroll jump!)
                    rawMisiEditor.scrollTop = 0;
                    rawMisiEditor.setSelectionRange(0, 0);
                    rawMisiEditor.focus();
                }
            });
        }

        // Raw Editor live input handler
        if (rawMisiEditor) {
            rawMisiEditor.addEventListener('input', function () {
                autoResizeTextarea(this);
                updateRawStats();
                const lines = this.value.split(/\r\n|\r|\n/)
                    .map(l => l.trim())
                    .filter(l => l.length > 0);
                
                missionItems = lines.map(line => line.replace(/^[\d]+[\.\-\)\s\u00A0]+/, '').replace(/^[\-\*\•\–]\s*/, '').trim());
                if (missionItems.length === 0) missionItems = [''];
                
                // Sync to hidden input and live preview
                const formattedLines = missionItems
                    .map((text, idx) => `${idx + 1}. ${text.replace(/\u00A0/g, ' ').trim()}`)
                    .filter(l => l.replace(/^[\d]+\.\s*/, '').length > 0);
                if (inputMisi) inputMisi.value = formattedLines.join('\n');

                const count = missionItems.filter(t => t.trim().length > 0).length;
                if (misiCounterBadge) misiCounterBadge.textContent = `${count} Butir Misi`;
                if (previewMisiCount) previewMisiCount.textContent = `${count} Butir`;

                if (previewMisiContainer) {
                    if (count === 0) {
                        previewMisiContainer.innerHTML = '<div class="text-muted small text-center py-3"><i class="bi bi-card-list me-1"></i>Belum ada butir misi yang dimasukkan.</div>';
                        return;
                    }
                    let html = '';
                    missionItems.forEach((item, idx) => {
                        const clean = item.trim();
                        if (!clean) return;
                        const displayNum = String(idx + 1).padStart(2, '0');
                        html += `
                            <div class="misi-preview-item">
                                <span class="misi-num-badge">${displayNum}</span>
                                <div class="misi-preview-text">${escapeHtml(clean)}</div>
                            </div>
                        `;
                    });
                    previewMisiContainer.innerHTML = html;
                }
            });
        }

        // Format Nomor Otomatis Button
        if (btnAutoFormatRaw && rawMisiEditor) {
            btnAutoFormatRaw.addEventListener('click', function () {
                const lines = rawMisiEditor.value.split(/\r\n|\r|\n/)
                    .map(l => l.trim())
                    .filter(l => l.length > 0);
                
                const cleaned = lines.map((l, idx) => {
                    const noNum = l.replace(/^[\d]+[\.\-\)\s\u00A0]+/, '').replace(/^[\-\*\•\–]\s*/, '').trim();
                    return `${idx + 1}.\u00A0${noNum}`;
                });
                
                rawMisiEditor.value = cleaned.join('\n');
                missionItems = cleaned.map(l => l.replace(/^[\d]+\.\u00A0*/, '').trim());
                autoResizeTextarea(rawMisiEditor);
                updateRawStats();
                syncToBackendAndPreview();
            });
        }

        // Copy Text Button
        if (btnCopyRaw && rawMisiEditor) {
            btnCopyRaw.addEventListener('click', function () {
                // Normalize non-breaking spaces back to regular spaces for clipboard
                const textToCopy = rawMisiEditor.value.replace(/\u00A0/g, ' ');
                navigator.clipboard.writeText(textToCopy).then(() => {
                    if (copyRawLabel) copyRawLabel.textContent = 'Tersalin!';
                    setTimeout(() => {
                        if (copyRawLabel) copyRawLabel.textContent = 'Salin';
                    }, 2000);
                });
            });
        }

        // Clear Text Button
        if (btnClearRaw && rawMisiEditor) {
            btnClearRaw.addEventListener('click', function () {
                if (confirm('Kosongkan seluruh teks butir misi?')) {
                    rawMisiEditor.value = '';
                    missionItems = [''];
                    autoResizeTextarea(rawMisiEditor);
                    updateRawStats();
                    syncToBackendAndPreview();
                }
            });
        }

        // Visi Counter & Preview
        function updateVisi() {
            if (!inputVisi) return;
            const text = inputVisi.value.trim();
            autoResizeTextarea(inputVisi);

            if (previewVisiText) {
                previewVisiText.textContent = text || 'Pernyataan visi daerah akan muncul di sini...';
            }

            if (visiStatCounter) {
                const words = text ? text.split(/\s+/).filter(Boolean).length : 0;
                const chars = text.length;
                visiStatCounter.textContent = `${words} Kata • ${chars} Karakter`;
            }
        }

        if (inputVisi) {
            inputVisi.addEventListener('input', updateVisi);
            setTimeout(updateVisi, 20);
        }

        // Keyboard shortcut: Ctrl+S to save
        document.addEventListener('keydown', function (e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                const activeForm = document.getElementById('formVisiMisi');
                if (activeForm && document.activeElement && activeForm.contains(document.activeElement)) {
                    e.preventDefault();
                    activeForm.submit();
                }
            }
        });

        // Initialize state
        parseInitialMisi();
        renderCards();
        syncToBackendAndPreview();
        updateVisi();
    });
</script>
@endpush
