<?php
$metode_pembayaran = session()->get('metode_pembayaran');

// Daftar rekening / nomor tujuan palsu
$rekening = [
    'BCA' => [
        'bank' => 'BCA',
        'nomor' => '1234 5678 9012',
        'nama' => 'Cafe <3'
    ],
    'DANA' => [
        'bank' => 'DANA',
        'nomor' => '0812 3456 7890',
        'nama' => 'Cafe <3'
    ],
    'E-Wallet' => [
        'bank' => 'E-Wallet',
        'nomor' => '0821 9876 5432',
        'nama' => 'Cafe <3'
    ],
];
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow p-4" style="max-width: 500px; width: 100%;">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">Upload Bukti Pembayaran</h3>

            <?php if (isset($rekening[$metode_pembayaran])): ?>
                <div class="alert alert-info text-center">
                    <strong>Transfer ke:</strong><br>
                    <?= $rekening[$metode_pembayaran]['bank'] ?><br>
                    <strong><?= $rekening[$metode_pembayaran]['nomor'] ?></strong><br>
                    a.n. <?= $rekening[$metode_pembayaran]['nama'] ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('home/submit_payment') ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="bukti_transfer">Pilih File Bukti Transfer</label>
                    <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control-file" required>
                </div>
                <button type="submit" class="btn btn-success btn-block mt-4">Kirim Bukti</button>
            </form>
        </div>
    </div>
</div>
