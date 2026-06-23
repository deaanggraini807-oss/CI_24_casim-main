<!-- application/views/sales_order/detail.php -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="font-weight-bold text-dark mb-0">Detail Sales Order</h4>
    <a href="<?= site_url('Sales_order') ?>" class="btn btn-sm btn-secondary">← Kembali</a>
</div>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
<?php endif; ?>

<div class="row">
    <div class="col-md-5">
        <div class="card shadow mb-4">
            <div class="card-header font-weight-bold">Informasi SO</div>
            <div class="card-body">
                <table class="table table-sm table-borderless mb-0">
                    <tr><td width="130">Kode SO</td><td>: <strong><?= $so->kode_so ?></strong></td></tr>
                    <tr><td>Pelanggan</td><td>: <?= $so->nama_pelanggan ?></td></tr>
                    <tr><td>Sales</td><td>: <?= $so->nama_Sales ?></td></tr>
                    <tr><td>Tanggal</td><td>: <?= $so->tanggal_order ?></td></tr>
                    <tr><td>Catatan</td><td>: <?= $so->catatan ?: '-' ?></td></tr>
                    <tr>
                        <td>Status</td>
                        <td>:
                        <?php $badge=['draft'=>'secondary','dikirim'=>'primary','selesai'=>'success','dibatalkan'=>'danger']; ?>
                        <span class="badge badge-<?= $badge[$so->status] ?? 'secondary' ?>">
                            <?= ucfirst($so->status) ?>
                        </span>
                        </td>
                    </tr>
                </table>

                <!-- Update status: hanya admin -->
                <?php if ($this->session->userdata('role') === 'admin'): ?>
                <hr>
                <form method="post" action="<?= site_url('Sales_order/update_status/'.$so->id) ?>" class="d-flex gap-2">
                    <select name="status" class="form-control form-control-sm mr-2">
                        <?php foreach(['draft','dikirim','selesai','dibatalkan'] as $s): ?>
                        <option value="<?= $s ?>" <?= $so->status===$s?'selected':'' ?>><?= ucfirst($s) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-sm" style="background:#1a7f8e;color:#fff;">Update</button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-header font-weight-bold">Detail Produk</div>
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead style="background:#f8f9fc;">
                <tr><th>No</th><th>Produk</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($detail as $d): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d->nama_produk ?></td>
                    <td>Rp <?= number_format($d->harga, 0, ',', '.') ?></td>
                    <td><?= $d->qty ?></td>
                    <td>Rp <?= number_format($d->subtotal, 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-right">Total</th>
                    <th>Rp <?= number_format($so->total, 0, ',', '.') ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>