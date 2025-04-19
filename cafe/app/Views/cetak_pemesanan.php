<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Cetak Pemesanan Cafe</title>
    <style>
        body { font-family: Arial, sans-serif; background: #fff; margin: 20px; font-size: 13px; }
        .nota { width: 320px; margin: 0 auto; padding: 10px; border: 1px dashed #999; }
        h3 { text-align: center; margin-bottom: 8px; font-size: 16px; }
        table { width: 100%; font-size: 13px; border-collapse: collapse; }
        th, td { padding: 5px; vertical-align: top; }
        th { text-align: left; }
        .center { text-align: center; }
        .right { text-align: right; }
        .bold { font-weight: bold; }
        .item-name { width: 70%; }
        .item-qty { width: 30%; text-align: center; }
        hr { border: 0; border-top: 1px dashed #999; margin: 8px 0; }
    </style>
</head>
<body>

<div class="nota">
    <h3>Pemesanan Cafe</h3>
    <div class="center" style="font-size: 12px;">
        <div>No. Nota: <b><?= esc($nota['nomor_nota']) ?></b></div>
        <div>No. Meja: <b><?= esc($nota['nomor_meja']) ?></b></div>
        <div>Customer: <b><?= esc($nota['nama_customer']) ?></b></div>
        <div>Tanggal: <b><?= esc($nota['tanggal']) ?></b></div>

    </div>
    <hr>
    <table>
        <thead>
            <tr>
                <th class="item-name">Barang</th>
                <th class="item-qty">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
            <tr>
                <td class="item-name"><?= esc($item['nama_barang']) ?></td>
                <td class="item-qty"><?= esc($item['jumlah']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <hr>
</div>

<script>
    window.print();
</script>

</body>
</html>
