<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row g-4">
    <!-- Laporan Debitur -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body text-center p-4">
                <div style="width: 80px; height: 80px; background: #e0e7ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <i class="bi bi-people-fill text-primary" style="font-size: 2rem;"></i>
                </div>
                <h5 class="fw-bold mb-2">Laporan Debitur</h5>
                <p class="text-muted small mb-4">Melihat seluruh data debitur yang terdaftar di sistem beserta data pekerjaan dan penghasilannya.</p>
                <a href="/laporan/debitur" class="btn btn-outline-primary w-100">
                    Lihat Laporan <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Laporan Kontrak Aktif -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body text-center p-4">
                <div style="width: 80px; height: 80px; background: #dcfce7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <i class="bi bi-file-earmark-check-fill text-success" style="font-size: 2rem;"></i>
                </div>
                <h5 class="fw-bold mb-2">Kontrak Aktif</h5>
                <p class="text-muted small mb-4">Laporan daftar debitur yang kredit kendaraannya masih berjalan / masa angsuran.</p>
                <a href="/laporan/kontrak-aktif" class="btn btn-outline-success w-100">
                    Lihat Laporan <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Laporan Kontrak Selesai -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body text-center p-4">
                <div style="width: 80px; height: 80px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <i class="bi bi-file-earmark-lock-fill text-secondary" style="font-size: 2rem;"></i>
                </div>
                <h5 class="fw-bold mb-2">Kontrak Selesai</h5>
                <p class="text-muted small mb-4">Laporan daftar kontrak kredit kendaraan yang sudah lunas atau selesai masa angsurannya.</p>
                <a href="/laporan/kontrak-selesai" class="btn btn-outline-secondary w-100">
                    Lihat Laporan <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
