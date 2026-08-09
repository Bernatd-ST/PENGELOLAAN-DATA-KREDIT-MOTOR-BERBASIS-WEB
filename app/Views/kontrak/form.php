<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
<div class="col-lg-10">
<div class="card">
    <div class="card-header">
        <h6 class="mb-0 fw-bold">
            <i class="bi bi-file-earmark-plus me-2 text-primary"></i><?= $title ?>
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
            $action  = $isEdit ? '/kontrak/update/' . $data['id'] : '/kontrak/simpan';
        ?>
        <form action="<?= $action ?>" method="POST" id="formKontrak">
            <?= csrf_field() ?>

            <div class="row g-4">
                <!-- Kolom Kiri -->
                <div class="col-md-6 border-end">
                    <h6 class="fw-bold mb-3">Informasi Utama</h6>

                    <div class="mb-3">
                        <label class="form-label">Nomor Kontrak</label>
                        <input type="text" class="form-control bg-light" name="no_kontrak"
                               value="<?= $isEdit ? $data['no_kontrak'] : $no_kontrak ?>" readonly>
                    </div>

                    <?php if (!$isEdit): ?>
                    <div class="mb-3">
                        <label class="form-label">Pilih Debitur <span class="text-danger">*</span></label>
                        <select name="debitur_id" class="form-select" required>
                            <option value="">-- Pilih Debitur --</option>
                            <?php foreach ($debitur as $d): ?>
                                <option value="<?= $d['id'] ?>" <?= (old('debitur_id') == $d['id']) ? 'selected' : '' ?>>
                                    <?= esc($d['nama_lengkap']) ?> - NIK: <?= $d['no_ktp'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php else: ?>
                    <div class="mb-3">
                        <label class="form-label">Debitur</label>
                        <input type="text" class="form-control bg-light" value="<?= esc($data['nama_lengkap']) . ' - NIK: ' . $data['no_ktp'] ?>" readonly>
                        <input type="hidden" name="debitur_id" value="<?= $data['debitur_id'] ?>">
                    </div>
                    <?php endif; ?>

                    <?php if (!$isEdit): ?>
                    <div class="mb-3">
                        <label class="form-label">Pilih Kendaraan (Motor) <span class="text-danger">*</span></label>
                        <select name="motor_id" id="motor_id" class="form-select" required>
                            <option value="" data-harga="0">-- Pilih Motor --</option>
                            <?php foreach ($motor as $m): ?>
                                <option value="<?= $m['id'] ?>" data-harga="<?= $m['harga_otr'] ?>" <?= (old('motor_id') == $m['id']) ? 'selected' : '' ?>>
                                    Merek: <?= esc($m['merek']) ?> <?= esc($m['tipe']) ?> - Rp <?= number_format($m['harga_otr'], 0, ',', '.') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="hidden" id="harga_motor" value="0">
                    </div>
                    <?php else: ?>
                    <div class="mb-3">
                        <label class="form-label">Kendaraan</label>
                        <input type="text" class="form-control bg-light" value="<?= esc($data['merek']) . ' ' . esc($data['tipe']) . ' - Rp ' . number_format($data['harga_otr'], 0, ',', '.') ?>" readonly>
                        <input type="hidden" name="motor_id" id="motor_id" value="<?= $data['motor_id'] ?>">
                        <input type="hidden" id="harga_motor" value="<?= $data['harga_otr'] ?>">
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($isEdit): ?>
                    <div class="mb-3">
                        <label class="form-label">Status Kontrak <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="aktif" <?= ($data['status'] == 'aktif') ? 'selected' : '' ?>>Aktif</option>
                            <option value="selesai" <?= ($data['status'] == 'selesai') ? 'selected' : '' ?>>Selesai / Lunas</option>
                        </select>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <h6 class="fw-bold mb-3">Detail Kredit</h6>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label">Uang Muka (DP) Rp <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="dp" id="dp"
                                   value="<?= $isEdit ? $data['dp'] : old('dp') ?>"
                                   placeholder="Contoh: 5000000" min="0" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Tenor (Bulan) <span class="text-danger">*</span></label>
                            <select name="tenor" id="tenor" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                <?php
                                    $tenors = [12, 18, 24, 30, 36];
                                    $currentTenor = $isEdit ? $data['tenor'] : old('tenor');
                                    foreach ($tenors as $t) {
                                        $sel = ($t == $currentTenor) ? 'selected' : '';
                                        echo "<option value=\"$t\" $sel>$t Bulan</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label">Bunga per Tahun (%) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" name="bunga_pertahun" id="bunga"
                                   value="<?= $isEdit ? $data['bunga_pertahun'] : old('bunga_pertahun') ?>"
                                   placeholder="Contoh: 10" min="0" max="100" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tgl_mulai"
                                   value="<?= $isEdit ? $data['tgl_mulai'] : (old('tgl_mulai') ?? date('Y-m-d')) ?>" required>
                        </div>
                    </div>

                    <!-- Kalkulasi Box -->
                    <div class="bg-light p-3 rounded border mt-4">
                        <h6 class="fw-bold text-primary mb-3 text-center">Estimasi Angsuran</h6>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Harga Motor</span>
                            <span class="fw-bold" id="lbl_harga">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Uang Muka (DP)</span>
                            <span class="fw-bold text-danger" id="lbl_dp">- Rp 0</span>
                        </div>
                        <hr class="my-2">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Pokok Pinjaman</span>
                            <span class="fw-bold" id="lbl_pinjaman">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center bg-white p-2 rounded border border-success">
                            <span class="fw-bold text-success">Angsuran per Bulan</span>
                            <h4 class="mb-0 fw-bold text-success" id="lbl_angsuran">Rp 0</h4>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="d-flex justify-content-end gap-2">
                <a href="/kontrak" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i> <?= $isEdit ? 'Update Kontrak' : 'Simpan Kontrak' ?>
                </button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function hitungKeuangan() {
        // Ambil harga dari dropdown motor atau element hidden
        let harga = 0;
        if($('#motor_id').is('select')) {
            harga = parseFloat($('#motor_id option:selected').data('harga')) || 0;
        } else {
            harga = parseFloat($('#harga_motor').val()) || 0;
        }
        
        // Ambil input lainnya
        let dp = parseFloat($('#dp').val()) || 0;
        let tenor = parseInt($('#tenor').val()) || 0;
        let bunga = parseFloat($('#bunga').val()) || 0;

        // Validasi agar DP tidak lebih dari harga
        if (dp > harga && harga > 0) {
            dp = harga;
            $('#dp').val(dp);
            Swal.fire('Peringatan', 'DP tidak boleh lebih besar dari harga kendaraan.', 'warning');
        }

        // Kalkulasi
        let pinjaman = harga - dp;
        let angsuran = 0;

        if (tenor > 0) {
            // Rumus: (Pinjaman + (Pinjaman * Bunga/100)) / Tenor
            let totalBunga = pinjaman * (bunga / 100);
            angsuran = (pinjaman + totalBunga) / tenor;
        }

        // Tampilkan ke UI
        $('#lbl_harga').text(formatRupiah(harga));
        $('#lbl_dp').text('- ' + formatRupiah(dp));
        $('#lbl_pinjaman').text(formatRupiah(pinjaman));
        $('#lbl_angsuran').text(formatRupiah(angsuran));
    }

    $(document).ready(function() {
        // Panggil saat pertama load
        hitungKeuangan();

        // Panggil saat ada perubahan input
        $('#motor_id, #dp, #tenor, #bunga').on('change keyup', function() {
            hitungKeuangan();
        });
    });
</script>
<?= $this->endSection() ?>
