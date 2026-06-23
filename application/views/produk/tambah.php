<div class="container-fluid">

    <h2 class="h3 mb-4 text-gray-800">Tambah Produk</h2>

    <div class="card shadow">
        <div class="card-body">

            <form method="post" action="<?= site_url('produk/simpan') ?>">

                <div class="form-group">
                    <label>Kode Produk</label>
                    <input type="text"
                           name="kode_produk"
                           class="form-control"
                           required>
                </div>

                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text"
                           name="nama_produk"
                           class="form-control"
                           required>
                </div>

                <div class="form-group">
                    <label>Harga</label>
                    <input type="number"
                           name="harga"
                           class="form-control"
                           required>
                </div>

                <div class="form-group">
                    <label>Stok</label>
                    <input type="number"
                           name="stok"
                           class="form-control"
                           required>
                </div>

                <br>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="<?= site_url('produk') ?>"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>