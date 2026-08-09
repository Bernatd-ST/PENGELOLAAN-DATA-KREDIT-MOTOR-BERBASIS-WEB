<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <div>
            <h6 class="mb-0 fw-bold"><i class="bi bi-people me-2 text-primary"></i>Daftar Debitur</h6>
            <small class="text-muted">Total: <?= count($debitur) ?> debitur</small>
        </div>
        <a href="/debitur/tambah" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Debitur
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>No. KTP</th>
                        <th>No. HP</th>
                        <th>Pekerjaan</th>
                        <th class="text-end">Penghasilan/Bln</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($debitur as $d): ?>
                    <tr>
                        <td><span class="badge bg-primary-subtle text-primary"><?= $d['id_debitur'] ?></span></td>
                        <td>
                            <div class="fw-500"><?= esc($d['nama_lengkap']) ?></div>
                            <small class="text-muted"><?= esc($d['alamat']) ?></small>
                        </td>
                        <td><code><?= $d['no_ktp'] ?></code></td>
                        <td><?= esc($d['no_hp']) ?></td>
                        <td><?= esc($d['pekerjaan']) ?></td>
                        <td class="text-end">Rp <?= number_format($d['penghasilan'], 0, ',', '.') ?></td>
                        <td class="text-center">
                            <a href="/debitur/edit/<?= $d['id'] ?>" class="btn btn-warning btn-sm" title="Edit">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <button onclick="konfirmasiHapus('/debitur/hapus/<?= $d['id'] ?>', '<?= esc($d['nama_lengkap']) ?>')"
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
