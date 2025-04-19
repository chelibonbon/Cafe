<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Cetak Semua Pemesanan Cafe</title>
    <style>
        body { font-family: Arial, sans-serif; background: #fff; margin: 20px; font-size: 13px; }
        .nota { width: 320px; margin: 0 auto 40px; padding: 10px; border: 1px dashed #999; }
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

<?php foreach ($child as $order): ?>
<div class="nota">
    <h3>Pemesanan Cafe</h3>
    <div class="center" style="font-size: 12px;">
        <div>No. Nota: <b><?= esc($order['nomor_nota']) ?></b></div>
        <div>No. Meja: <b><?= esc($order['nomor_meja']) ?></b></div>
        <div>Customer: <b><?= esc($order['nama_user']) ?></b></div>
        <div>Tanggal: <b><?= esc($order['tanggal']) ?></b></div>
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
            <?php if (!empty($order['items'])): ?>
                <?php foreach ($order['items'] as $item): ?>
                <tr>
                    <td class="item-name"><?= esc($item['nama_barang']) ?></td>
                    <td class="item-qty"><?= esc($item['jumlah']) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2" class="center">Tidak ada item.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <hr>
</div>
<?php endforeach; ?>

<script>
    window.print();
</script>

</body>
</html>
