<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .title-row {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .periode-row {
            font-size: 14px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="title-row">
        Laporan Keuangan
    </div>
    <div class="periode-row">
        Periode: <?= date('d-m-Y', strtotime($tanggal_awal)); ?> hingga <?= date('d-m-Y', strtotime($tanggal_akhir)); ?>
    </div>

    <table id="tabelbk">
        <thead>
            <tr>
                <th>No</th>
                <th>Barang</th>
                <th>Jumlah Terjual</th>
                <th>Pendapatan</th>
                <th>Pengeluaran</th>
                <th>Total keuangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($laporan as $row): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nama_barang']; ?></td>
                    <td><?= $row['jumlah_terjual']; ?></td>
                    <td><?= number_format($row['total_pendapatan'], 2); ?></td>
                    <td><?= number_format($row['modal'], 2); ?></td>
                    <td><?= number_format($row['laba'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td>Total</td>
                <td></td>
                <td><?= $totals['jumlah_terjual']; ?></td>
                <td><?= number_format($totals['total_pendapatan'], 2); ?></td>
                <td><?= number_format($totals['modal'], 2); ?></td>
                <td><?= number_format($totals['laba'], 2); ?></td>
            </tr>
        </tbody>
    </table>

    <script>
        window.onload = () => {
            const table = document.getElementById('tabelbk');
            exportTable(table, 'laporan_keuangan.xls');
        };

        function exportTable(table, filename) {
            let tableHTML = table.outerHTML;

            // Add title and periode rows above the table in Excel with bold and larger font
            const title = "<div class='title-row' style='font-size: 20px; font-weight: bold;'>Laporan Keuangan</div>";
            const periode = "<div class='periode-row'>Periode: <?= date('d-m-Y', strtotime($tanggal_awal)); ?> hingga <?= date('d-m-Y', strtotime($tanggal_akhir)); ?></div>";
            tableHTML = title + periode + "<br>" + tableHTML;

            // Apply inline styles for the table cells to ensure borders appear in Excel
            tableHTML = tableHTML.replace(/<th/g, '<th style="border: 1px solid black; padding: 8px; text-align: center;"')
                                 .replace(/<td/g, '<td style="border: 1px solid black; padding: 8px; text-align: center;"');

            const downloadLink = document.createElement('a');
            downloadLink.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(tableHTML);
            downloadLink.download = filename;
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
            window.close();
        }
    </script>
</body>
</html>
