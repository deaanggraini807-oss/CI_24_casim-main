<div class="container-fluid">

    <h2 class="h3 mb-4 text-gray-800">Edit Pelanggan</h2>

    <div class="card shadow">
        <div class="card-body">

            <form method="post" action="<?= site_url('pelanggan/update/'.$pelanggan->id) ?>">

                <div class="form-group">
                    <label>Nama Pelanggan</label>
                    <input type="text"
                           name="nama_pelanggan"
                           value="<?= $pelanggan->nama_pelanggan ?>"
                           class="form-control"
                           required>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat"
                              class="form-control"
                              required><?= $pelanggan->alamat ?></textarea>
                </div>

                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text"
                           name="telepon"
                           value="<?= $pelanggan->telepon ?>"
                           class="form-control"
                           required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email"
                           name="email"
                           value="<?= $pelanggan->email ?>"
                           class="form-control">
                </div>

                <br>

                <button type="submit" class="btn btn-success">
                    Update
                </button>

                <a href="<?= site_url('pelanggan') ?>"
                   class="btn btn-secondary">
                   Kembali
                </a>

            </form>

        </div>
    </div>

</div>