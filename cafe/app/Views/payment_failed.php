<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4 text-center" style="max-width: 500px; width: 100%;">
        <div class="card-body">
            <i class="fas fa-times-circle fa-5x text-danger mb-3"></i>
            <h2 class="card-title mb-3">Gagal Upload</h2>
            <p class="card-text">Gagal mengupload bukti pembayaran. Coba lagi atau hubungi kasir.</p>
            <a href="<?= base_url('home/upload_payment') ?>" class="btn btn-danger mt-4">Coba Lagi</a>
             <a href="<?= base_url('home/dashboard') ?>" class="btn btn-danger mt-4">Kembali ke beranda</a>
        </div>
    </div>
</div>
