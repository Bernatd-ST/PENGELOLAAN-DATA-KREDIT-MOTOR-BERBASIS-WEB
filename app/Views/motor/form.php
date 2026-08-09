<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
<div class="col-lg-8">
<div class="card">
    <div class="card-header">
        <h6 class="mb-0 fw-bold">
            <i class="bi bi-bicycle me-2 text-primary"></i><?= $title ?>
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
            $action  = $isEdit ? '/motor/update/' . $data['id'] : '/motor/simpan';
        ?>
        <form action="<?= $action ?>" method="POST">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">ID Motor</label>
                <input type="text" class="form-control bg-light" name="id_motor"
                       value="<?= $isEdit ? $data['id_motor'] : $id_motor ?>" readonly>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Merek <span class="text-danger">*</span></label>
                    <select name="merek" class="form-select" required>
                        <option value="">-- Pilih Merek --</option>
                        <?php
                            $mereks = ['Honda', 'Yamaha', 'Suzuki', 'Kawasaki'];
                            $currentMerek = $isEdit ? $data['merek'] : old('merek');
                            foreach ($mereks as $m) {
                                $sel = ($m == $currentMerek) ? 'selected' : '';
                                echo "<option value=\"$m\" $sel>$m</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tipe/Model <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="tipe"
                           value="<?= $isEdit ? esc($data['tipe']) : old('tipe') ?>"
                           placeholder="Contoh: Beat, NMAX, Aerox" required>
                </div>
            </div>

            <div class="row g-3 mt-1">
                <div class="col-md-6">
                    <label class="form-label">Tahun Pembuatan <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="tahun"
                           value="<?= $isEdit ? $data['tahun'] : old('tahun') ?>"
                           placeholder="Contoh: 2023" min="2000" max="<?= date('Y') + 1 ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Warna <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="warna"
                           value="<?= $isEdit ? esc($data['warna']) : old('warna') ?>"
                           placeholder="Contoh: Merah Hitam" required>
                </div>
            </div>

            <div class="mb-4 mt-3">
                <label class="form-label">Harga OTR (On The Road) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="harga_otr"
                       value="<?= $isEdit ? $data['harga_otr'] : old('harga_otr') ?>"
                       placeholder="Contoh: 18500000" min="0" required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> <?= $isEdit ? 'Update Data' : 'Simpan Data' ?>
                </button>
                <a href="/motor" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
</div>
</div>

<?= $this->endSection() ?>
