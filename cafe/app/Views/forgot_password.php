<!DOCTYPE html>
<html lang="en">

<?php
// Ambil data pengaturan dari database
$db = db_connect();
$pengaturan = $db->table('pengaturan_app')->get()->getRow();
$level = session()->get('level'); // Ambil level user dari session
?>
    <!-- Content -->

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Kasir MiniMarket</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
     <link rel="shortcut icon" href="<?= base_url(!empty($pengaturan->logo) ? 'uploads/' . esc($pengaturan->logo) : 'assets/img/logo-white.png') ?>" type="image/x-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Template Main CSS File -->

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
<div class="container">
  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">

          <!-- Login Card -->
          <div class="card mb-3" style="width: 100%; max-width: 500px; min-height: 300px;">
            <div class="card-body d-flex flex-column justify-content-between">

              <!-- Header -->
              <div>
                  <!-- Logo -->
          <div class="d-flex justify-content-center py-4">
            <a href="index.html" class="logo d-flex align-items-center w-auto">
             <a href="<?= base_url() ?>" class="app-brand-link gap-3">
    <img src="<?= base_url(!empty($pengaturan->logo) ? 'uploads/' . esc($pengaturan->logo) : 'assets/img/logo-white.png') ?>" 
         alt="Logo" 
         style="max-height: 50px;"/>
            </a>
          </div>
          <!-- End Logo -->
                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Reset your password</h5>
                  <p class="text-center small">Enter the email address linked to your account and we'll send you an email.</p>
                </div>
              </div>
              <!-- End Header -->

              <!-- Forgot Password Form -->
              <div>
                <form action="<?= base_url('/home/aksi_forgot_password') ?>" method="POST">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input 
                      type="email" 
                      class="form-control" 
                      id="email" 
                      name="email" 
                      placeholder="Enter your email" 
                      style="height: 50px;" 
                      required>
                  </div>
                  <div class="d-grid mt-auto">
                <button type="submit" class="btn btn-primary">Send Link</button>
              </div>
                </form>

              </div>
              <!-- End Forgot Password Form -->

              <!-- Submit Button -->
              
              <!-- End Submit Button -->

            </div>
          </div>
          <!-- End Login Card -->
        </div>
      </div>
    </div>
  </section>
</div>
 </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Template Main JS File -->
</body>

</html>