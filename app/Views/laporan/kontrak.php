<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
    $bgCard = $status === 'aktif' ? 'linear-gradient(135deg, #16a34a, #14532d)' : 'linear-gradient(135deg, #475569, #1e293b)';
    $pdfUrl = $status === 'aktif' ? '/laporan/pdf-aktif' : '/laporan/pdf-selesai';
?>
<div class="card p-3 mb-4 border-0 shadow-sm" style="background: <?= $bgCard ?>; color: white;">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h5 class="fw-bold mb-1"><i class="bi bi-file-earmark-text text-warning me-2"></i><?= $title ?></h5>
            <p class="mb-0 text-white-50 small">Filter dan export laporan data kontrak yang berstatus <?= $status ?>.</p>
        </div>
        <div>
            <a href="<?= $pdfUrl ?>" class="btn btn-warning" target="_blank">
                <i class="bi bi-file-earmark-pdf-fill me-1"></i> Export PDF
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>No. Kontrak</th>
                        <th>Debitur</th>
                        <th>NIK KTP</th>
                        <th>Motor</th>
                        <th>Tgl Mulai/Selesai</th>
                        <th class="text-end">Angsuran/Bln</th>
                        <th>Tenor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kontrak as $k): ?>
                    <tr>
                        <td><code><?= $k['no_kontrak'] ?></code></td>
                        <td><div class="fw-bold"><?= esc($k['nama_lengkap']) ?></div></td>
                        <td><?= $k['no_ktp'] ?></td>
                        <td><?= esc($k['merek']) ?> <?= esc($k['tipe']) ?> (<?= $k['tahun'] ?>)</td>
                        <td>
                            <div class="small">M: <?= date('d/m/Y', strtotime($k['tgl_mulai'])) ?></div>
                            <div class="small">S: <?= date('d/m/Y', strtotime($k['tgl_selesai'])) ?></div>
                        </td>
                        <td class="text-end fw-500">Rp <?= number_format($k['angsuran_perbulan'], 0, ',', '.') ?></td>
                        <td><?= $k['tenor'] ?> bulan</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
