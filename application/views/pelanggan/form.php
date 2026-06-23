<!-- application/views/pelanggan/form.php -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="font-weight-bold text-dark mb-0"><?= $judul ?></h4>
    <a href="<?= site_url('pelanggan') ?>" class="btn btn-sm btn-secondary">← Kembali</a>
</div>
<div class="card shadow" style="max-width:600px;">
    <div class="card-body">
        <form method="post">
            <div class="form-group">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama" class="form-control" value="<?= $pelanggan->nama ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="2"><?= $pelanggan->alamat ?? '' ?></textarea>
            </div>
            <div class="form-group">
                <label>Telepon</label>
                <input type="text" name="telepon" class="form-control" value="<?= $pelanggan->telepon ?? '' ?>">
            </div>
            <button type="submit" class="btn" style="background:#1a7f8e;color:#fff;">Simpan</button>
        </form>
    </div>
</div>