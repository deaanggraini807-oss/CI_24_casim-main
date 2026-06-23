<div class="container-fluid">

    <h2 class="h3 mb-4 text-gray-800">Laporan Sales Order</h2>

    <div class="card shadow">
        <div class="card-body">

            <!-- Tombol Print & Download PDF -->
            <div class="mb-3 d-flex gap-2 no-print">
                <button class="btn btn-secondary" onclick="window.print()">
                    <i class="fas fa-print"></i> Print
                </button>
                <button class="btn btn-danger" onclick="downloadPDF()">
                    <i class="fas fa-file-pdf"></i> Download PDF
                </button>
            </div>

            <div id="tabel-laporan">
                <table class="table table-bordered" id="tabel">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode SO</th>
                            <th>Pelanggan ID</th>
                            <th>Tanggal Order</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($data as $d): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $d->kode_so ?></td>
                            <td><?= $d->pelanggan_id ?></td>
                            <td><?= $d->tanggal_order ?></td>
                            <td>Rp <?= number_format($d->total, 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<!-- jsPDF (letakkan sebelum </body> jika belum ada) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>

<script>
function downloadPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.setFontSize(13);
    doc.text('Laporan Sales Order', 14, 15);

    const table   = document.getElementById('tabel');
    const headers = [...table.querySelectorAll('thead th')].map(th => th.innerText);
    const rows    = [...table.querySelectorAll('tbody tr')].map(tr =>
        [...tr.querySelectorAll('td')].map(td => td.innerText)
    );

    doc.autoTable({
        head: [headers],
        body: rows,
        startY: 20,
        styles: { fontSize: 10, halign: 'center' },
        headStyles: { fillColor: [78, 115, 223] }
    });

    doc.save('Laporan_SalesOrder.pdf');
}
</script>

<!-- Sembunyikan tombol saat print -->
<style>
@media print {
    .no-print { display: none !important; }
    .card { box-shadow: none !important; border: none !important; }
}
</style>