<div class="container-fluid">

<h2 class="h3 mb-4 text-gray-800">Tambah Sales Order</h2>

<div class="card shadow">
    <div class="card-body">

<form method="post" action="<?= site_url('sales_order/simpan'); ?>">

    <div class="form-group">
        <label>Pelanggan</label>
        <select name="pelanggan_id" class="form-control" required>
            <option value="">-- Pilih Pelanggan --</option>
            <?php foreach($pelanggan as $p): ?>
                <option value="<?= $p->id ?>">
                    <?= $p->nama_pelanggan ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Produk</label>
        <select name="produk_id" class="form-control" required>
            <option value="">-- Pilih Produk --</option>
            <?php foreach($produk as $p): ?>
                <option value="<?= $p->id ?>">
                    <?= $p->nama_produk ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Qty</label>
        <input type="number"
               name="qty"
               class="form-control"
               required>
    </div>

    <div class="form-group">
        <label>Total</label>
        <input type="number"
               name="total"
               class="form-control"
               required>
    </div>

    <br>

    <button type="submit" class="btn btn-primary">
        Simpan
    </button>

    <a href="<?= site_url('sales_order') ?>"
       class="btn btn-secondary">
       Kembali
    </a>

</form>

    </div>
</div>

</div>