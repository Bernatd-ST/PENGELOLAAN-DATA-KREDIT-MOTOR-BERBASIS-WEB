<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Finance App' ?> - Kredit Motor</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #1e3a5f;
            --primary-light: #2563eb;
            --accent: #f59e0b;
            --bg: #f0f4f8;
        }
        body { font-family: 'Inter', sans-serif; background: var(--bg); }

        /* Sidebar */
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: linear-gradient(180deg, #1e3a5f 0%, #0f2240 100%);
            position: fixed;
            top: 0; left: 0;
            z-index: 1000;
            transition: transform .3s ease;
            box-shadow: 4px 0 20px rgba(0,0,0,0.15);
        }
        .sidebar-brand {
            padding: 1.5rem 1.2rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-brand h5 { color: #fff; font-weight: 700; font-size: 1rem; margin: 0; }
        .sidebar-brand small { color: rgba(255,255,255,0.5); font-size: .72rem; }
        .sidebar-brand .brand-icon {
            width: 40px; height: 40px;
            background: var(--accent);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; color: #fff; margin-bottom: .5rem;
        }
        .nav-section-label {
            padding: .5rem 1.2rem .25rem;
            font-size: .68rem; font-weight: 600;
            text-transform: uppercase; letter-spacing: .08em;
            color: rgba(255,255,255,0.35);
        }
        #sidebar .nav-link {
            padding: .6rem 1.2rem;
            color: rgba(255,255,255,0.7);
            font-size: .875rem;
            border-radius: 0;
            display: flex; align-items: center; gap: .7rem;
            transition: all .2s;
        }
        #sidebar .nav-link:hover, #sidebar .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,0.1);
            border-left: 3px solid var(--accent);
            padding-left: calc(1.2rem - 3px);
        }
        #sidebar .nav-link i { font-size: 1rem; width: 18px; }

        /* Main content */
        #main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin .3s;
        }
        .topbar {
            background: #fff;
            padding: .9rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 500;
            box-shadow: 0 1px 8px rgba(0,0,0,0.05);
        }
        .page-content { padding: 1.5rem; }

        /* Cards */
        .stat-card {
            border: none; border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            transition: transform .2s, box-shadow .2s;
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,0.12); }
        .stat-card .card-body { padding: 1.4rem; }
        .stat-icon {
            width: 50px; height: 50px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
        }
        .stat-value { font-size: 1.8rem; font-weight: 700; line-height: 1; }
        .stat-label { font-size: .8rem; color: #64748b; margin-top: .25rem; }

        /* Table */
        .card { border: none; border-radius: 14px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
        .card-header { background: #fff; border-bottom: 1px solid #e2e8f0; border-radius: 14px 14px 0 0 !important; padding: 1rem 1.25rem; }
        .table thead th { background: #f8fafc; font-size: .8rem; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; color: #475569; border-color: #e2e8f0; }
        .table td { font-size: .875rem; vertical-align: middle; border-color: #f1f5f9; }
        .badge { font-size: .72rem; font-weight: 500; }

        /* Alerts */
        .alert { border: none; border-radius: 10px; font-size: .875rem; }

        /* Breadcrumb */
        .breadcrumb { font-size: .8rem; margin: 0; }
        .page-title { font-size: 1.15rem; font-weight: 700; color: #1e293b; }

        /* Buttons */
        .btn { border-radius: 8px; font-size: .875rem; font-weight: 500; }
        .btn-primary { background: var(--primary-light); border-color: var(--primary-light); }

        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-currency-dollar"></i></div>
        <h5>Finance App</h5>
        <small>Kredit Motor System</small>
    </div>
    <nav class="mt-2">
        <div class="nav-section-label">Menu Utama</div>
        <a href="/dashboard" class="nav-link <?= (current_url() == base_url('dashboard')) ? 'active' : '' ?>">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="nav-section-label mt-2">Master Data</div>
        <a href="/debitur" class="nav-link <?= (strpos(current_url(), '/debitur') !== false) ? 'active' : '' ?>">
            <i class="bi bi-people"></i> Data Debitur
        </a>
        <a href="/motor" class="nav-link <?= (strpos(current_url(), '/motor') !== false) ? 'active' : '' ?>">
            <i class="bi bi-bicycle"></i> Data Motor
        </a>

        <div class="nav-section-label mt-2">Transaksi</div>
        <a href="/kontrak" class="nav-link <?= (strpos(current_url(), '/kontrak') !== false) ? 'active' : '' ?>">
            <i class="bi bi-file-earmark-text"></i> Data Kontrak
        </a>

        <div class="nav-section-label mt-2">Laporan</div>
        <a href="/laporan" class="nav-link <?= (strpos(current_url(), '/laporan') !== false) ? 'active' : '' ?>">
            <i class="bi bi-bar-chart-line"></i> Laporan
        </a>

        <div class="nav-section-label mt-2">Akun</div>
        <a href="/logout" class="nav-link text-danger"
           onclick="return confirm('Yakin ingin logout?')">
            <i class="bi bi-box-arrow-left"></i> Logout
        </a>
    </nav>
</div>

<!-- Main Content -->
<div id="main-content">
    <!-- Topbar -->
    <div class="topbar">
        <div>
            <div class="page-title"><?= $title ?? '' ?></div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <?php if (isset($title) && $title !== 'Dashboard'): ?>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                    <?php endif; ?>
                </ol>
            </nav>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="text-end">
                <div style="font-size:.8rem;font-weight:600;color:#1e293b;"><?= session()->get('nama') ?></div>
                <div style="font-size:.72rem;color:#94a3b8;">Administrator</div>
            </div>
            <div style="width:38px;height:38px;background:#1e3a5f;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-person-fill text-white"></i>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="page-content">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i><?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <ul class="mb-0 mt-1">
                    <?php foreach (session()->getFlashdata('errors') as $err): ?>
                        <li><?= $err ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Auto-init DataTables
$(document).ready(function () {
    if ($('.datatable').length) {
        $('.datatable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
            },
            responsive: true,
            pageLength: 10
        });
    }
});

// Konfirmasi hapus dengan SweetAlert
function konfirmasiHapus(url, nama) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: nama + ' akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

// Format angka ke Rupiah
function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency', currency: 'IDR', minimumFractionDigits: 0
    }).format(angka);
}
</script>

<?= $this->renderSection('scripts') ?>
</body>
</html>
