<!-- application/views/sales_order/index.php -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="font-weight-bold text-dark mb-0">Sales Order</h4>
    <a href="<?= site_url('Sales_order/tambah') ?>" class="btn btn-sm" style="background:#1a7f8e;color:#fff;">
        <i class="fas fa-plus"></i> Buat SO Baru
    </a>
</div>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
<div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
<?php endif; ?>

<div class="card shadow">
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead style="background:#f8f9fc;">
                <tr>
                    <th>No</th><th>Kode SO</th><th>Pelanggan</th>
                    <th>Sales</th><th>Total</th><th>Status</th><th>Tanggal</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($orders as $o): ?>
                <?php
                $badge = ['draft'=>'secondary','dikirim'=>'primary','selesai'=>'success','dibatalkan'=>'danger'];
                $b = $badge[$o->status] ?? 'secondary';
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $o->kode_so ?></td>
                    <td><?= $o->nama_pelanggan ?></td>
                    <td><?= $o->nama_sales ?></td>
                    <td>Rp <?= number_format($o->total, 0, ',', '.') ?></td>
                    <td><span class="badge badge-<?= $b ?>"><?= ucfirst($o->status) ?></span></td>
                    <td><?= $o->tanggal_order ?></td>
                    <td>
                        <a href="<?= site_url('Sales_order/detail/'.$o->id) ?>"
                           class="btn btn-sm btn-info">Detail</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>