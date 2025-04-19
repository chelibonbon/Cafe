<main id="main" class="main">
    <div class="pagetitle">
        <h3>Laporan Keuangan</h3>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Keuangan</h5>

                        <form class="mt-3" action="<?= base_url('home/excel_keuangan') ?>" method="POST">
                            <div class="row g-3 align-items-end">
                                <div class="col-md-4">
                                    <label for="tanggal_awal" class="form-label">Tanggal Awal:</label>
                                    <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="tanggal_akhir" class="form-label">Tanggal Akhir:</label>
                                    <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control">
                                </div>
                                <div class="col-md-2 d-flex justify-content-center align-items-end">
                                    <button type="submit" class="btn btn-success" style="width: 120px;" formtarget="_blank">
                                        <i class="fas fa-file-excel"></i> Excel
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
