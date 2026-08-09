<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kredit Motor Finance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1e3a5f 0%, #0f2240 50%, #1a1a2e 100%);
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
        }
        .login-card {
            background: #fff;
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
        }
        .brand-logo {
            width: 60px; height: 60px;
            background: linear-gradient(135deg, #2563eb, #1e3a5f);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem; color: #fff; margin: 0 auto 1rem;
        }
        .login-title { font-size: 1.4rem; font-weight: 700; color: #1e293b; }
        .login-subtitle { font-size: .85rem; color: #64748b; }
        .form-control {
            border: 1.5px solid #e2e8f0; border-radius: 10px;
            padding: .7rem 1rem; font-size: .9rem;
            transition: all .2s;
        }
        .form-control:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.1); }
        .form-label { font-size: .85rem; font-weight: 500; color: #374151; }
        .input-group-text { border: 1.5px solid #e2e8f0; border-right: none; background: #f8fafc; border-radius: 10px 0 0 10px; }
        .input-group .form-control { border-left: none; border-radius: 0 10px 10px 0; }
        .btn-login {
            background: linear-gradient(135deg, #2563eb, #1e3a5f);
            border: none; color: #fff; width: 100%;
            padding: .8rem; border-radius: 10px;
            font-weight: 600; font-size: .95rem;
            transition: opacity .2s;
        }
        .btn-login:hover { opacity: .9; color: #fff; }
        .alert { border-radius: 10px; font-size: .85rem; }
        .info-box {
            background: #f0f9ff; border-radius: 10px;
            padding: .75rem 1rem; font-size: .8rem; color: #0369a1;
            border: 1px solid #bae6fd;
        }
    </style>
</head>
<body>
<div class="login-card">
    <div class="text-center mb-4">
        <div class="brand-logo"><i class="bi bi-currency-dollar"></i></div>
        <div class="login-title">Finance App</div>
        <div class="login-subtitle">Sistem Pengelolaan Kredit Motor</div>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger py-2">
            <i class="bi bi-exclamation-triangle-fill me-1"></i>
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="/login" method="POST">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person text-secondary"></i></span>
                <input type="text" class="form-control" id="username" name="username"
                       placeholder="Masukkan username" required autofocus
                       value="<?= old('username') ?>">
            </div>
        </div>
        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock text-secondary"></i></span>
                <input type="password" class="form-control" id="password" name="password"
                       placeholder="Masukkan password" required>
            </div>
        </div>
        <button type="submit" class="btn btn-login">
            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
        </button>
    </form>

    <div class="info-box mt-4">
        <i class="bi bi-info-circle me-1"></i>
        <strong>Demo:</strong> username: <code>admin</code> | password: <code>password</code>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
