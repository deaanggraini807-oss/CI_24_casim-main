<!-- application/views/laporan/index.php -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="font-weight-bold text-dark mb-0">Laporan Penjualan</h4>
    <a href="<?= site_url('laporan/cetak?'.http_build_query($filter)) ?>"
       target="_blank" class="btn btn-sm btn-danger">
        <i class="fas fa-file-pdf"></i> Cetak PDF
    </a>
</div>

<!-- Filter -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="get" class="form-row align-items-end">
            <div class="col-md-3 form-group mb-0">
                <label>Sales</label>
                <select name="sales_id" class="form-control form-control-sm">
                    <option value="">Semua Sales</option>
                    <?php foreach($list_sales as $s): ?>
                    <option value="<?= $s->id ?>" <?= $filter['user_id']==$s->id?'selected':'' ?>>
                        <?= $s->nama ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2 form-group mb-0">
                <label>Dari</label>
                <input type="date" name="dari" class="form-control form-control-sm" value="<?= $filter['dari'] ?>">
            </div>
            <div class="col-md-2 form-group mb-0">
                <label>Sampai</label>
                <input type="date" name="sampai" class="form-control form-control-sm" value="<?= $filter['sampai'] ?>">
            </div>
            <div class="col-md-2 form-group mb-0">
                <label>Status</label>
                <select name="status" class="form-control form-control-sm">
                    <option value="">Semua</option>
                    <?php foreach(['draft','dikirim','selesai','dibatalkan'] as $s): ?>
                    <option value="<?= $s ?>" <?= $filter['status']===$s?'selected':'' ?>><?= ucfirst($s) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2 form-group mb-0">
                <button type="submit" class="btn btn-sm btn-block" style="background:#1a7f8e;color:#fff;">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow">
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead style="background:#f8f9fc;">
                <tr>
                    <th>No</th><th>Kode SO</th><th>Pelanggan</th>
                    <th>Sales</th><th>Total</th><th>Status</th><th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($orders as $o): ?>
                <?php $badge=['draft'=>'secondary','dikirim'=>'primary','selesai'=>'success','dibatalkan'=>'danger']; ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $o->kode_so ?></td>
                    <td><?= $o->nama_pelanggan ?></td>
                    <td><?= $o->nama_sales ?></td>
                    <td>Rp <?= number_format($o->total, 0, ',', '.') ?></td>
                    <td><span class="badge badge-<?= $badge[$o->status]??'secondary' ?>"><?= ucfirst($o->status) ?></span></td>
                    <td><?= $o->tanggal_order ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-right">Total Keseluruhan</th>
                    <th>Rp <?= number_format($total, 0, ',', '.') ?></th>
                    <th colspan="2"></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>