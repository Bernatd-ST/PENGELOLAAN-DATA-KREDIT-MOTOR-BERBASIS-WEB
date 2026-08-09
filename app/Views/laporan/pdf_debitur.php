<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Debitur</title>
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

    <h2>Laporan Data Debitur</h2>
    <p>Dicetak pada: <?= date('d/m/Y H:i:s') ?></p>

    <table>
        <thead>
            <tr>
                <th class="text-center" width="5%">No</th>
                <th width="10%">ID Debitur</th>
                <th width="20%">Nama Lengkap</th>
                <th width="15%">No. KTP</th>
                <th width="12%">No. HP</th>
                <th width="20%">Pekerjaan</th>
                <th class="text-right" width="18%">Penghasilan/Bln</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($debitur as $d): ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= $d['id_debitur'] ?></td>
                <td><?= $d['nama_lengkap'] ?></td>
                <td><?= $d['no_ktp'] ?></td>
                <td><?= $d['no_hp'] ?></td>
                <td><?= $d['pekerjaan'] ?></td>
                <td class="text-right">Rp <?= number_format($d['penghasilan'], 0, ',', '.') ?></td>
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
