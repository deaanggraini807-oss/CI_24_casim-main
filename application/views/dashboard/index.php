<!-- application/views/dashboard/index.php -->
<h4 class="mb-4 font-weight-bold text-dark">Dashboard</h4>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-left-primary shadow h-100 py-2" style="border-left: 4px solid #1a7f8e;">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:#1a7f8e;font-size:11px;">Total Produk</div>
                <div class="h4 mb-0 font-weight-bold"><?= $total_produk ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow h-100 py-2" style="border-left: 4px solid #1a8e4a;">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:#1a8e4a;font-size:11px;">Total Pelanggan</div>
                <div class="h4 mb-0 font-weight-bold"><?= $total_pelanggan ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow h-100 py-2" style="border-left: 4px solid #8e5a1a;">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:#8e5a1a;font-size:11px;">Total Order</div>
                <div class="h4 mb-0 font-weight-bold"><?= $total_order ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow h-100 py-2" style="border-left: 4px solid #6f42c1;">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:#6f42c1;font-size:11px;">Total Omset</div>
                <div class="h5 mb-0 font-weight-bold">Rp <?= number_format($total_omset, 0, ',', '.') ?></div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-header font-weight-bold" style="background:#fff;">Order Terbaru</div>
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead style="background:#f8f9fc;">
                <tr>
                    <th>Kode SO</th>
                    <th>Pelanggan</th>
                    <th>Sales</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_terbaru as $o): ?>
                <tr>
                    <td><?= $o->kode_so ?></td>
                    <td><?= $o->nama_pelanggan ?></td>
                    <td><?= $o->nama_sales ?></td>
                    <td>Rp <?= number_format($o->total, 0, ',', '.') ?></td>
                    <td>
                        <?php
                        $badge = ['draft'=>'secondary','dikirim'=>'primary','selesai'=>'success','dibatalkan'=>'danger'];
                        $b = $badge[$o->status] ?? 'secondary';
                        ?>
                        <span class="badge badge-<?= $b ?>"><?= ucfirst($o->status) ?></span>
                    </td>
                    <td><?= $o->tanggal_order ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>