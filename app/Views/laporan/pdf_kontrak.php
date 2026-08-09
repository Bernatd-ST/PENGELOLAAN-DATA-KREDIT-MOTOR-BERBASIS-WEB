<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kontrak <?= $status ?></title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
        }
        h2 { text-align: center; margin-bottom: 5px; }
        p { text-align: center; margin-top: 0; margin-bottom: 20px; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .footer { margin-top: 30px; text-align: right; }
    </style>
</head>
<body>

    <h2>Laporan Daftar Kontrak (Status: <?= $status ?>)</h2>
    <p>Dicetak pada: <?= date('d/m/Y H:i:s') ?></p>

    <table>
        <thead>
            <tr>
                <th class="text-center" width="5%">No</th>
                <th width="15%">No. Kontrak</th>
                <th width="20%">Nama Debitur</th>
                <th width="20%">Kendaraan</th>
                <th width="15%">Tgl Mulai/Selesai</th>
                <th class="text-right" width="15%">Angsuran/Bln</th>
                <th class="text-center" width="10%">Tenor</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($kontrak as $k): ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= $k['no_kontrak'] ?></td>
                <td><?= $k['nama_lengkap'] ?></td>
                <td><?= $k['merek'] ?> <?= $k['tipe'] ?> (<?= $k['tahun'] ?>)</td>
                <td>
                    <?= date('d/m/Y', strtotime($k['tgl_mulai'])) ?><br>s/d<br><?= date('d/m/Y', strtotime($k['tgl_selesai'])) ?>
                </td>
                <td class="text-right">Rp <?= number_format($k['angsuran_perbulan'], 0, ',', '.') ?></td>
                <td class="text-center"><?= $k['tenor'] ?> Bln</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Finance App Administrator</p>
        <br><br><br>
        <p>_______________________</p>
    </div>

</body>
</html>
