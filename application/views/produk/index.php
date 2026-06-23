<!-- application/views/produk/index.php -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="font-weight-bold text-dark mb-0">Data Produk</h4>
    <a href="<?= site_url('produk/tambah') ?>" class="btn btn-sm" style="background:#1a7f8e;color:#fff;">
        <i class="fas fa-plus"></i> Tambah Produk
    </a>
</div>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
<?php endif; ?>

<div class="card shadow">
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead style="background:#f8f9fc;">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($produk as $p): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $p->kode_produk ?></td>
                    <td><?= $p->nama_produk ?></td>
                    <td>Rp <?= number_format($p->harga, 0, ',', '.') ?></td>
                    <td><?= $p->stok ?></td>
                    <td>
                        <a href="<?= site_url('produk/edit/'.$p->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?= site_url('produk/hapus/'.$p->id) ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('Hapus produk ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>