<div class="container-fluid">

<h2 class="h3 mb-4 text-gray-800">Data Kategori</h2>

<a href="<?= site_url('kategori/tambah'); ?>" class="btn btn-primary mb-3">Tambah</a>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">

<table id="tableKategori" class="table table-bordered" width="100%">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama Kategori</th>
        <th>Aksi</th>
    </tr>
    </thead>

    <tbody>
    <?php $no=1; foreach($kategori as $k): ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $k->nama_kategori; ?></td>
        <td>
            <a href="<?= site_url('kategori/edit/'.$k->id); ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="<?= site_url('kategori/hapus/'.$k->id); ?>" 
               onclick="return confirm('Yakin?')" 
               class="btn btn-danger btn-sm">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>

</table>

        </div>
    </div>
</div>

</div>

<!-- ================= DATATABLES ================= -->

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<!-- jQuery (HAPUS kalau sudah ada di SB Admin) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- INIT DATATABLE -->
<script>
$(document).ready(function() {
    $('#tableKategori').DataTable();
});
</script>