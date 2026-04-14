<div class="container-fluid">
<h2>Edit Buku</h2>

<form method="post" action="<?= site_url('buku/update') ?>">

<input type="hidden" name="id" value="<?= $buku->id ?>">

<input type="text" name="judul" value="<?= $buku->judul ?>" class="form-control mb-2">
<input type="text" name="penulis" value="<?= $buku->penulis ?>" class="form-control mb-2">

<button type="submit" class="btn btn-success">Update</button>
<a href="<?= site_url('buku') ?>" class="btn btn-secondary">Kembali</a>

</form>
</div>