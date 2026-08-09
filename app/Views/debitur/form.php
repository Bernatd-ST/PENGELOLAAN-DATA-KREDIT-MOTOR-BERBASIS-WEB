<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
<div class="col-lg-8">
<div class="card">
    <div class="card-header">
        <h6 class="mb-0 fw-bold">
            <i class="bi bi-person-plus me-2 text-primary"></i><?= $title ?>
        </h6>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                    <li><?= $err ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <?php
            $isEdit  = $data !== null;
            $action  = $isEdit ? '/debitur/update/' . $data['id'] : '/debitur/simpan';
        ?>
        <form action="<?= $action ?>" method="POST">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">ID Debitur</label>
                <input type="text" class="form-control bg-light" name="id_debitur"
                       value="<?= $isEdit ? $data['id_debitur'] : $id_debitur ?>" readonly>
                <div class="form-text">ID dibuat otomatis oleh sistem</div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama_lengkap"
                           value="<?= $isEdit ? esc($data['nama_lengkap']) : old('nama_lengkap') ?>"
                           placeholder="Nama lengkap sesuai KTP" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nomor KTP <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="no_ktp"
                           value="<?= $isEdit ? $data['no_ktp'] : old('no_ktp') ?>"
                           placeholder="16 digit NIK KTP" maxlength="16" required>
                </div>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label">Alamat <span class="text-danger">*</span></label>
                <textarea class="form-control" name="alamat" rows="3"
                          placeholder="Alamat lengkap sesuai KTP" required><?= $isEdit ? esc($data['alamat']) : old('alamat') ?></textarea>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nomor HP <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="no_hp"
                           value="<?= $isEdit ? $data['no_hp'] : old('no_hp') ?>"
                           placeholder="Contoh: 08123456789" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="pekerjaan"
                           value="<?= $isEdit ? esc($data['pekerjaan']) : old('pekerjaan') ?>"
                           placeholder="Contoh: Karyawan Swasta" required>
                </div>
            </div>

            <div class="mb-4 mt-3">
                <label class="form-label">Penghasilan per Bulan (Rp) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="penghasilan"
                       value="<?= $isEdit ? $data['penghasilan'] : old('penghasilan') ?>"
                       placeholder="Contoh: 5000000" min="0" required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> <?= $isEdit ? 'Update Data' : 'Simpan Data' ?>
                </button>
                <a href="/debitur" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
</div>
</div>

<?= $this->endSection() ?>
