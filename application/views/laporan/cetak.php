<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h3 { text-align:center; color:#1a7f8e; }
        p.sub { text-align:center; color:#666; font-size:13px; margin-top:-8px; }
        table { width:100%; border-collapse:collapse; margin-top:16px; font-size:13px; }
        th { background:#1a7f8e; color:#fff; padding:8px; text-align:center; }
        td { padding:7px 10px; border-bottom:1px solid #ddd; text-align:center; }
        tfoot th { background:#f0f0f0; color:#333; }
        .no-print { margin-bottom:16px; }
        @media print { .no-print { display:none; } }
    </style>
</head>
<body>

<div class="no-print">
    <button onclick="window.print()" style="padding:8px 20px;background:#555;color:#fff;border:none;border-radius:4px;cursor:pointer;margin-right:8px;">🖨️ Print</button>
    <button onclick="downloadPDF()" style="padding:8px 20px;background:#e74c3c;color:#fff;border:none;border-radius:4px;cursor:pointer;">⬇️ Download PDF</button>
</div>

<h3>Laporan Penjualan</h3>
<p class="sub">Tanggal cetak: <?= date('d F Y') ?></p>

<table id="tbl">
    <thead>
        <tr><th>No</th><th>Kode SO</th><th>Pelanggan</th><th>Sales</th><th>Total</th><th>Status</th><th>Tanggal</th></tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($orders as $o): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $o->kode_so ?></td>
            <td><?= $o->nama_pelanggan ?></td>
            <td><?= $o->nama_sales ?></td>
            <td>Rp <?= number_format($o->total,0,',','.') ?></td>
            <td><?= ucfirst($o->status) ?></td>
            <td><?= $o->tanggal_order ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">Total</th>
            <th>Rp <?= number_format($total,0,',','.') ?></th>
            <th colspan="2"></th>
        </tr>
    </tfoot>
</table>

<script>
function downloadPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    doc.setFontSize(14);
    doc.setTextColor(26,127,142);
    doc.text('Laporan Penjualan', 105, 16, {align:'center'});
    doc.setFontSize(10);
    doc.setTextColor(100);
    doc.text('Tanggal cetak: <?= date('d F Y') ?>', 105, 22, {align:'center'});

    const tbl = document.getElementById('tbl');
    const heads = [...tbl.querySelectorAll('thead th')].map(t=>t.innerText);
    const rows  = [...tbl.querySelectorAll('tbody tr')].map(tr=>[...tr.querySelectorAll('td')].map(td=>td.innerText));

    doc.autoTable({
        head:[heads], body:rows, startY:27,
        styles:{fontSize:9,halign:'center'},
        headStyles:{fillColor:[26,127,142]}
    });
    doc.save('Laporan_Penjualan_<?= date('Ymd') ?>.pdf');
}
</script>
</body>
</html>