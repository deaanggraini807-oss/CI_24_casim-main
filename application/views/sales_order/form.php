<!-- application/views/sales_order/form.php -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="font-weight-bold text-dark mb-0">Buat Sales Order Baru</h4>
    <a href="<?= site_url('sales_order') ?>" class="btn btn-sm btn-secondary">← Kembali</a>
</div>

<form method="post" action="<?= site_url('sales_order/simpan') ?>">
<div class="row">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header font-weight-bold">Informasi Order</div>
            <div class="card-body">
                <div class="form-group">
                    <label>Pelanggan</label>
                    <select name="pelanggan_id" class="form-control" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php foreach($pelanggan as $p): ?>
                        <option value="<?= $p->id ?>"><?= $p->nama ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Catatan</label>
                    <textarea name="catatan" class="form-control" rows="2" placeholder="Opsional"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span class="font-weight-bold">Daftar Produk</span>
        <button type="button" class="btn btn-sm" style="background:#1a7f8e;color:#fff;" onclick="tambahBaris()">
            + Tambah Produk
        </button>
    </div>
    <div class="card-body p-0">
        <table class="table table-bordered mb-0" id="tabel-produk">
            <thead style="background:#f8f9fc;">
                <tr>
                    <th>Produk</th><th>Harga</th><th>Qty</th><th>Subtotal</th><th></th>
                </tr>
            </thead>
            <tbody id="tbody-produk">
                <!-- Baris produk ditambah JS -->
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-right">Total:</th>
                    <th id="total-display">Rp 0</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<button type="submit" class="btn" style="background:#1a7f8e;color:#fff;padding:10px 30px;">
    <i class="fas fa-save"></i> Simpan SO
</button>
</form>

<!-- Data produk untuk JS -->
<script>
var dataProduk = <?= json_encode(array_map(function($p){
    return ['id'=>$p->id,'nama'=>$p->nama_produk,'harga'=>$p->harga,'stok'=>$p->stok];
}, $produk)) ?>;

var barisCtr = 0;

function tambahBaris() {
    barisCtr++;
    var opts = '<option value="">-- Pilih --</option>';
    dataProduk.forEach(function(p){
        opts += '<option value="'+p.id+'" data-harga="'+p.harga+'">'+p.nama+' (stok: '+p.stok+')</option>';
    });

    var html = '<tr id="baris-'+barisCtr+'">'
        + '<td><select name="produk_id[]" class="form-control form-control-sm" onchange="updateHarga(this,'+barisCtr+')" required>'+opts+'</select></td>'
        + '<td><input type="number" name="harga[]" id="harga-'+barisCtr+'" class="form-control form-control-sm" readonly></td>'
        + '<td><input type="number" name="qty[]" id="qty-'+barisCtr+'" class="form-control form-control-sm" min="1" value="1" oninput="hitungSubtotal('+barisCtr+')" required></td>'
        + '<td><span id="sub-'+barisCtr+'">Rp 0</span></td>'
        + '<td><button type="button" class="btn btn-sm btn-danger" onclick="hapusBaris('+barisCtr+')">✕</button></td>'
        + '</tr>';
    document.getElementById('tbody-produk').insertAdjacentHTML('beforeend', html);
}

function updateHarga(sel, i) {
    var opt = sel.options[sel.selectedIndex];
    var harga = opt ? (opt.getAttribute('data-harga') || 0) : 0;
    document.getElementById('harga-'+i).value = harga;
    hitungSubtotal(i);
}

function hitungSubtotal(i) {
    var harga = parseFloat(document.getElementById('harga-'+i).value) || 0;
    var qty   = parseFloat(document.getElementById('qty-'+i).value) || 0;
    var sub   = harga * qty;
    document.getElementById('sub-'+i).innerText = 'Rp ' + sub.toLocaleString('id-ID');
    hitungTotal();
}

function hapusBaris(i) {
    document.getElementById('baris-'+i).remove();
    hitungTotal();
}

function hitungTotal() {
    var rows = document.querySelectorAll('#tbody-produk tr');
    var total = 0;
    rows.forEach(function(row){
        var id = row.id.replace('baris-','');
        var harga = parseFloat(document.getElementById('harga-'+id)?.value) || 0;
        var qty   = parseFloat(document.getElementById('qty-'+id)?.value) || 0;
        total += harga * qty;
    });
    document.getElementById('total-display').innerText = 'Rp ' + total.toLocaleString('id-ID');
}

// Tambah 1 baris default
tambahBaris();
</script>