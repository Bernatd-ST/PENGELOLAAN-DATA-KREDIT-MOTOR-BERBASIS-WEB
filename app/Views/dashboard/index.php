<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3 col-6">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#dbeafe;">
                    <i class="bi bi-people-fill" style="color:#2563eb;"></i>
                </div>
                <div>
                    <div class="stat-value" style="color:#2563eb;"><?= $total_debitur ?></div>
                    <div class="stat-label">Total Debitur</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#fef3c7;">
                    <i class="bi bi-bicycle" style="color:#f59e0b;"></i>
                </div>
                <div>
                    <div class="stat-value" style="color:#f59e0b;"><?= $total_motor ?></div>
                    <div class="stat-label">Total Motor</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#dcfce7;">
                    <i class="bi bi-file-earmark-check-fill" style="color:#16a34a;"></i>
                </div>
                <div>
                    <div class="stat-value" style="color:#16a34a;"><?= $total_aktif ?></div>
                    <div class="stat-label">Kontrak Aktif</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#f1f5f9;">
                    <i class="bi bi-file-earmark-x-fill" style="color:#64748b;"></i>
                </div>
                <div>
                    <div class="stat-value" style="color:#64748b;"><?= $total_selesai ?></div>
                    <div class="stat-label">Kontrak Selesai</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Kontrak Terbaru -->
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <div>
            <h6 class="mb-0 fw-bold"><i class="bi bi-clock-history me-2 text-primary"></i>Kontrak Terbaru</h6>
            <small class="text-muted">Daftar semua kontrak kredit</small>
        </div>
        <a href="/kontrak/tambah" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Buat Kontrak
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 datatable">
                <thead>
                    <tr>
                        <th>No. Kontrak</th>
                        <th>Debitur</th>
                        <th>Motor</th>
                        <th>Tenor</th>
                        <th class="text-end">Angsuran/Bln</th>
                        <th>Tgl Mulai</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kontrak_terbaru as $k): ?>
                    <tr>
                        <td><code><?= $k['no_kontrak'] ?></code></td>
                        <td><?= esc($k['nama_lengkap']) ?></td>
                        <td><?= $k['merek'] . ' ' . $k['tipe'] ?></td>
                        <td><?= $k['tenor'] ?> bln</td>
                        <td class="text-end fw-500">
                            Rp <?= number_format($k['angsuran_perbulan'], 0, ',', '.') ?>
                        </td>
                        <td><?= date('d/m/Y', strtotime($k['tgl_mulai'])) ?></td>
                        <td>
                            <?php if ($k['status'] === 'aktif'): ?>
                                <span class="badge bg-success">Aktif</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Selesai</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
