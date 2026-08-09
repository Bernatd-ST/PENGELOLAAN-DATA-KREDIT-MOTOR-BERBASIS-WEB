<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <div>
            <h6 class="mb-0 fw-bold"><i class="bi bi-bicycle me-2 text-warning"></i>Daftar Motor</h6>
            <small class="text-muted">Total: <?= count($motor) ?> unit motor</small>
        </div>
        <a href="/motor/tambah" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Motor
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Merek & Tipe</th>
                        <th>Tahun</th>
                        <th>Warna</th>
                        <th class="text-end">Harga OTR</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($motor as $m): ?>
                    <tr>
                        <td><span class="badge bg-warning-subtle text-warning-emphasis"><?= $m['id_motor'] ?></span></td>
                        <td>
                            <div class="fw-500"><?= esc($m['merek']) ?></div>
                            <small class="text-muted"><?= esc($m['tipe']) ?></small>
                        </td>
                        <td><?= $m['tahun'] ?></td>
                        <td>
                            <span class="badge bg-secondary-subtle text-secondary"><?= esc($m['warna']) ?></span>
                        </td>
                        <td class="text-end fw-500">Rp <?= number_format($m['harga_otr'], 0, ',', '.') ?></td>
                        <td class="text-center">
                            <a href="/motor/edit/<?= $m['id'] ?>" class="btn btn-warning btn-sm" title="Edit">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <button onclick="konfirmasiHapus('/motor/hapus/<?= $m['id'] ?>', '<?= esc($m['merek']) . ' ' . esc($m['tipe']) ?>')"
                                    class="btn btn-danger btn-sm" title="Hapus">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
