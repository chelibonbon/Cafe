<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4 text-center" style="max-width: 500px; width: 100%;">
        <div class="card-body">
            <i class="fas fa-hourglass-half fa-5x text-warning mb-3"></i>
            <h2 class="card-title mb-3">Menunggu Verifikasi</h2>
            <p class="card-text">Kami sedang memeriksa bukti pembayaranmu. Mohon tunggu sebentar.</p>
            <div class="progress mt-4">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%;"></div>
            </div>
            <a href="<?= base_url('home/pemesanan') ?>" class="btn btn-primary mt-4">Lihat dari pemesanan</a>
        </div>
    </div>
</div>
<script>
setInterval(function() {
    fetch('<?= base_url('home/check_payment_status/'.$nota['id_nota']) ?>')
        .then(response => response.json())
        .then(data => {
            console.log(data); // <-- useful to debug
            if (data.keterangan === 'lunas') {
                window.location.href = "<?= base_url('home/payment_success') ?>";
            } else if (data.keterangan === 'gagal') {
                window.location.href = "<?= base_url('home/payment_failed') ?>";
            }
        })
        .catch(error => console.error('Error checking status:', error));
}, 5000); // 5 seconds
</script>
