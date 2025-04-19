<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nota Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .receipt {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .receipt h2 {
            text-align: center;
            margin: 0;
            font-size: 1.5em;
        }
        .receipt .header, .receipt .footer {
            text-align: center;
            margin-bottom: 15px;
            font-size: 0.9em;
        }
        .receipt table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }
        .receipt table th, .receipt table td {
            text-align: left;
            font-size: 0.85em;
            padding: 5px 0;
            border-bottom: 1px dashed #ccc;
        }
        .receipt .total-row td {
            font-weight: bold;
        }
        .receipt .right {
            text-align: right;
        }
        .receipt .center {
            text-align: center;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .receipt {
                width: 400px;
                margin: 0 auto;
                box-shadow: none;
                border: none;
            }
            .receipt h2 {
                font-size: 1.4em;
            }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <h2>NOTA CAFE</h2>
        <div class="header">
           Jalan clusterdaisy <br>
            Telp: (248) 434-5508
        </div>

        <!-- Display Nota Details -->
        <table>
            <tr>
                <td><b>No. Nota:</b></td>
                <td class="right"><?= esc($data->nomor_nota) ?></td>
            </tr>
            <tr>
                <td><b>Tanggal:</b></td>
                <td class="right"><?= esc($data->tanggal) ?></td>
            </tr>
            <tr>
                <td><b>Kasir:</b></td>
                <td class="right"><?= esc($data->nama_kasir) ?></td>
            </tr>
            <tr>
                <td><b>Customer:</b></td>
                <td class="right"><?= esc($data->nama_customer) ?></td>
            </tr>
            <tr>
                <td><b>Nomor Meja:</b></td>
                <td class="right"><?= esc($data->nomor_meja) ?></td>
            </tr>
        </table>

        <hr>

        <!-- Rincian Pemesanan (Item Details) -->
        <table>
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Total</th>
        </tr>
    </thead>
   <tbody>
    <?php if (isset($items) && !empty($items)): ?>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= esc($item->nama_barang) ?></td>
                <td class="right"><?= esc($item->jumlah) ?></td>
                <td class="right">Rp <?= number_format($item->harga_satuan, 0, ',', '.') ?></td>
                <td class="right">Rp <?= number_format($item->jumlah * $item->harga_satuan, 0, ',', '.') ?></td>  <!-- Calculate total -->
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4" class="center">Tidak ada item dalam pesanan.</td>
        </tr>
    <?php endif; ?>
</tbody>

</table>


        <hr>

        <!-- Display Payment and Total -->
        <table>
            <tr>
                <td><b>Metode Pembayaran:</b></td>
                <td class="right"><?= esc($data->metode_pembayaran) ?></td>
            </tr>
            <!-- Display Payment Status -->
<tr>
    <td><b>Status Pembayaran:</b></td>
    <td class="right"><?= esc($data->keterangan) ?></td>
</tr>

            <tr>
                <td><b>Grand Total:</b></td>
                <td class="right">Rp <?= number_format($data->grand_total, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td><b>Bayar:</b></td>
                <td class="right">Rp <?= number_format($data->bayar, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td><b>Kembali:</b></td>
                <td class="right">Rp <?= number_format($data->kembali, 0, ',', '.') ?></td>
            </tr>
        </table>

        <hr>

        <div class="footer">
            Terima kasih telah berkunjung!<br>
            <i>Have a great day at Cafe!</i>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
