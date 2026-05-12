<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - HRIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #2c3e50, #3498db);
        }

        .card {
            width: 100%;
            max-width: 350px;
            margin: 15px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
            backdrop-filter: blur(8px);
        }

        .form-control {
            height: 45px;
        }

        .btn {
            height: 45px;
        }
    </style>
</head>

<body>

<div class="card">
    <div class="card-body p-4">

        <div class="text-center mb-4">
            <h4 class="fw-bold text-primary">HRIS</h4>
            <p class="text-muted small">Sistem Informasi Manajemen SDM</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('login/proses') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control"
                       value="<?= old('username') ?>" placeholder="Masukkan username" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control"
                       placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Masuk
            </button>
        </form>

        <p class="text-center text-muted small mt-3 mb-0">
            Default: admin / password123
        </p>

    </div>
</div>

</body>
</html>