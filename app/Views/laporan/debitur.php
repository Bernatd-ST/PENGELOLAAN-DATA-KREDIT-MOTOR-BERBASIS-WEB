<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card p-3 mb-4 border-0 shadow-sm" style="background: linear-gradient(135deg, #1e3a5f, #0f2240); color: white;">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h5 class="fw-bold mb-1"><i class="bi bi-people-fill text-warning me-2"></i><?= $title ?></h5>
            <p class="mb-0 text-white-50 small">Filter dan export laporan data seluruh debitur.</p>
        </div>
        <div>
            <a href="/laporan/pdf-debitur" class="btn btn-warning" target="_blank">
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
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>No. KTP</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th>Pekerjaan</th>
                        <th class="text-end">Penghasilan/Bln</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($debitur as $d): ?>
                    <tr>
                        <td><?= $d['id_debitur'] ?></td>
                        <td><div class="fw-bold"><?= esc($d['nama_lengkap']) ?></div></td>
                        <td><?= $d['no_ktp'] ?></td>
                        <td><?= esc($d['no_hp']) ?></td>
                        <td><?= esc($d['alamat']) ?></td>
                        <td><?= esc($d['pekerjaan']) ?></td>
                        <td class="text-end fw-500">Rp <?= number_format($d['penghasilan'], 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
