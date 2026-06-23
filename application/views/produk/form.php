<!-- application/views/produk/form.php -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="font-weight-bold text-dark mb-0"><?= $judul ?></h4>
    <a href="<?= site_url('produk') ?>" class="btn btn-sm btn-secondary">← Kembali</a>
</div>

<div class="card shadow" style="max-width:600px;">
    <div class="card-body">
        <form method="post">
            <div class="form-group">
                <label>Kode Produk</label>
                <input type="text" name="kode_produk" class="form-control"
                       value="<?= $produk->kode_produk ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control"
                       value="<?= $produk->nama_produk ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" class="form-control"
                       value="<?= $produk->harga ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control"
                       value="<?= $produk->stok ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="2"><?= $produk->keterangan ?? '' ?></textarea>
            </div>
            <button type="submit" class="btn" style="background:#1a7f8e;color:#fff;">Simpan</button>
        </form>
    </div>
</div>