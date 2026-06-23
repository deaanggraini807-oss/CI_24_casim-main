<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sales Order System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fc; }
        #wrapper { display: flex; }
        #sidebar-wrapper {
            min-height: 100vh;
            width: 250px;
            min-width: 250px;
            background: linear-gradient(180deg, #1a7f8e 0%, #0d5c6b 100%);
        }
        .sidebar-brand {
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(255,255,255,.15);
            text-decoration: none;
        }
        .sidebar-brand:hover { color: #fff; text-decoration: none; }
        .nav-item .nav-link {
            color: rgba(255,255,255,.8);
            padding: 12px 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .nav-item .nav-link:hover,
        .nav-item .nav-link.active { color: #fff; background: rgba(255,255,255,.1); }
        .sidebar-heading {
            color: rgba(255,255,255,.5);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 10px 20px 4px;
        }
        .sidebar-divider { border-top: 1px solid rgba(255,255,255,.15); margin: 8px 0; }

        #content-wrapper { flex: 1; min-height: 100vh; }
        #topbar {
            height: 70px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,.08);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 24px;
            gap: 16px;
        }
        .topbar-user { font-size: 14px; color: #555; }
        .topbar-user strong { color: #1a7f8e; }
        .badge-role {
            font-size: 11px;
            padding: 3px 10px;
            border-radius: 20px;
            text-transform: capitalize;
        }
        .badge-admin   { background: #e8f4f8; color: #1a7f8e; }
        .badge-sales   { background: #e8f8ee; color: #1a8e4a; }
        .badge-manager { background: #f8f0e8; color: #8e5a1a; }
        #page-content { padding: 28px 24px; }
    </style>
</head>
<body>
<div id="wrapper">

    <!-- ══ SIDEBAR ══ -->
    <div id="sidebar-wrapper">
        <a class="sidebar-brand" href="<?= site_url('dashboard') ?>">
            🛒 SALES ORDER
        </a>
        <nav>
            <?php $role = $user['role']; ?>

            <!-- Dashboard: admin -->
            <?php if ($role === 'admin'): ?>
            <div class="sidebar-heading">Utama</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= ($this->uri->segment(1) === 'dashboard') ? 'active' : '' ?>"
                       href="<?= site_url('dashboard') ?>">
                        <i class="fas fa-fw fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
            </ul>
            <?php endif; ?>

            <!-- Master Data: admin only -->
            <?php if ($role === 'admin'): ?>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Master Data</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= ($this->uri->segment(1) === 'produk') ? 'active' : '' ?>"
                       href="<?= site_url('produk') ?>">
                        <i class="fas fa-fw fa-box"></i> Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($this->uri->segment(1) === 'pelanggan') ? 'active' : '' ?>"
                       href="<?= site_url('pelanggan') ?>">
                        <i class="fas fa-fw fa-users"></i> Pelanggan
                    </a>
                </li>
            </ul>
            <?php endif; ?>

            <!-- Sales Order: admin & sales -->
            <?php if (in_array($role, ['admin', 'sales'])): ?>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Transaksi</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= ($this->uri->segment(1) === 'sales_order') ? 'active' : '' ?>"
                       href="<?= site_url('sales_order') ?>">
                        <i class="fas fa-fw fa-file-alt"></i> Sales Order
                    </a>
                </li>
            </ul>
            <?php endif; ?>

            <!-- Laporan: admin & manager -->
            <?php if (in_array($role, ['admin', 'manager'])): ?>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Laporan</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= ($this->uri->segment(1) === 'laporan') ? 'active' : '' ?>"
                       href="<?= site_url('laporan') ?>">
                        <i class="fas fa-fw fa-chart-bar"></i> Laporan Penjualan
                    </a>
                </li>
            </ul>
            <?php endif; ?>

            <hr class="sidebar-divider">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('auth/logout') ?>">
                        <i class="fas fa-fw fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- ══ END SIDEBAR ══ -->

    <!-- ══ CONTENT ══ -->
    <div id="content-wrapper">
        <div id="topbar">
            <span class="topbar-user">
                Halo, <strong><?= $user['nama'] ?></strong>
            </span>
            <span class="badge badge-role badge-<?= $user['role'] ?>">
                <?= ucfirst($user['role']) ?>
            </span>
        </div>
        <div id="page-content">
            <?= $this->load->view($content_view, $this->load->get_vars(), TRUE) ?>
        </div>
    </div>
    <!-- ══ END CONTENT ══ -->

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>