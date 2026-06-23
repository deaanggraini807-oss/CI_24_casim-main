<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sales Order</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
    <style>
        body {
            background: #1a7f8e;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,.25);
            width: 100%;
            max-width: 400px;
        }
        .card-header {
            background: #1a7f8e;
            color: #fff;
            border-radius: 12px 12px 0 0 !important;
            text-align: center;
            padding: 28px 20px 20px;
        }
        .card-header h4 { margin: 0; font-weight: bold; letter-spacing: 1px; }
        .card-header small { opacity: .85; }
        .btn-login {
            background: #1a7f8e;
            color: #fff;
            width: 100%;
            font-weight: bold;
            padding: 10px;
        }
        .btn-login:hover { background: #156874; color: #fff; }
        label { font-weight: 600; font-size: 14px; }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <h4>🛒 SALES ORDER</h4>
        <small>Masuk dengan nama dan password Anda</small>
    </div>
    <div class="card-body p-4">

        <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger py-2">
            <?= $this->session->flashdata('error') ?>
        </div>
        <?php endif; ?>

        <form method="post" action="<?= site_url('auth/login') ?>">

            <div class="form-group">
                <label>Nama</label>
                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    placeholder="Masukkan nama Anda"
                    value="<?= set_value('nama') ?>"
                    required
                    autofocus>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    required>
            </div>

            <button type="submit" class="btn btn-login mt-1">
                Login
            </button>

        </form>

    </div>
</div>

</body>
</html>