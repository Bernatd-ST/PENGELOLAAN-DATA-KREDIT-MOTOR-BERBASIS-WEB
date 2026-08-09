<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <div>
            <h6 class="mb-0 fw-bold"><i class="bi bi-file-earmark-text me-2 text-primary"></i>Daftar Kontrak Kredit</h6>
            <small class="text-muted">Total: <?= count($kontrak) ?> kontrak</small>
        </div>
        <a href="/kontrak/tambah" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Buat Kontrak
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>No. Kontrak</th>
                        <th>Debitur</th>
                        <th>Kendaraan</th>
                        <th>Detail Pinjaman</th>
                        <th>Tgl Mulai/Selesai</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kontrak as $k): ?>
                    <tr>
                        <td><code><?= $k['no_kontrak'] ?></code></td>
                        <td>
                            <div class="fw-500"><?= esc($k['nama_lengkap']) ?></div>
                            <small class="text-muted">NIK: <?= $k['no_ktp'] ?></small>
                        </td>
                        <td>
                            <div><?= esc($k['merek']) ?> <?= esc($k['tipe']) ?></div>
                            <small class="text-muted">Thn: <?= $k['tahun'] ?></small>
                        </td>
                        <td>
                            <div class="small">DP: Rp <?= number_format($k['dp'], 0, ',', '.') ?></div>
                            <div class="small fw-bold text-danger">Cicilan: Rp <?= number_format($k['angsuran_perbulan'], 0, ',', '.') ?>/bln</div>
                            <small class="text-muted">Tenor: <?= $k['tenor'] ?>x</small>
                        </td>
                        <td>
                            <div class="small text-success">Mulai: <?= date('d/m/Y', strtotime($k['tgl_mulai'])) ?></div>
                            <div class="small text-danger">Akhir: <?= date('d/m/Y', strtotime($k['tgl_selesai'])) ?></div>
                        </td>
                        <td>
                            <?php if ($k['status'] === 'aktif'): ?>
                                <span class="badge bg-success">Aktif</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Selesai</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="/kontrak/edit/<?= $k['id'] ?>" class="btn btn-warning btn-sm" title="Edit">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <button onclick="konfirmasiHapus('/kontrak/hapus/<?= $k['id'] ?>', 'Kontrak <?= $k['no_kontrak'] ?>')"
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
