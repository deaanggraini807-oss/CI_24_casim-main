<!-- application/views/pelanggan/index.php -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="font-weight-bold text-dark mb-0">Data Pelanggan</h4>
    <a href="<?= site_url('pelanggan/tambah') ?>" class="btn btn-sm" style="background:#1a7f8e;color:#fff;">
        <i class="fas fa-plus"></i> Tambah Pelanggan
    </a>
</div>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
<?php endif; ?>

<div class="card shadow">
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead style="background:#f8f9fc;">
                <tr><th>No</th><th>Nama</th><th>Alamat</th><th>Telepon</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($pelanggan as $p): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $p->nama ?></td>
                    <td><?= $p->alamat ?></td>
                    <td><?= $p->telepon ?></td>
                    <td>
                        <a href="<?= site_url('pelanggan/edit/'.$p->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?= site_url('pelanggan/hapus/'.$p->id) ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('Hapus pelanggan ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>