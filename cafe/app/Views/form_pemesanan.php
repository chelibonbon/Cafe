<form action="<?= base_url('home/handle_payment') ?>" method="POST" enctype="multipart/form-data">
    <label>Nomor Meja</label>
    <input type="text" name="nomor_meja" class="form-control" required>

    <label>Metode Pembayaran</label>
    <select name="metode_pembayaran" class="form-control" required>
        <option value="Cash">Cash</option>
        <option value="BCA">BCA</option>
        <option value="E-Wallet">E-Wallet</option>
        <option value="DANA">DANA</option>
    </select>

    <h5>Detail Pesanan</h5>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $grand_total = 0; 
            foreach($cart as $index => $item): 
                $total_per_item = $item['harga'] * $item['jumlah'];
                $grand_total += $total_per_item;
            ?>
            <tr>
                <td><?= $item['nama'] ?></td>
                <td><?= $item['jumlah'] ?></td>
                <td><?= number_format($item['harga'], 0, ',', '.') ?></td>
                <td><?= number_format($total_per_item, 0, ',', '.') ?></td>
                <td>
                    <input type="text" name="catatan[<?= $index ?>]" class="form-control" value="<?= $item['catatan'] ?? '' ?>">
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-right">Grand Total:</th>
                <th><?= number_format($grand_total, 0, ',', '.') ?></th>
                <th></th>
            </tr>
        </tfoot>
    </table>

    <button type="submit" class="btn btn-success">Bayar</button>
</form>
