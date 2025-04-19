<?php
// Ambil data pengaturan dari database
$db = db_connect();
$pengaturan = $db->table('pengaturan_app')->get()->getRow();
$level = session()->get('level'); // Ambil level user dari session
?>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?=base_url('assets/')?>"
  data-template="vertical-menu-template-free"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?=base_url('assets/img/favicon/favicon.ico')?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="<?=base_url('assets/vendor/fonts/remixicon/remixicon.css')?>" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="<?=base_url('assets/vendor/libs/node-waves/node-waves.css')?>" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?=base_url('assets/vendor/css/core.css')?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?=base_url('assets/vendor/css/theme-default.css')?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?=base_url('assets/css/demo.css')?>" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?=base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')?>" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?=base_url('assets/vendor/css/pages/page-auth.css')?>" />

    <!-- Helpers -->
    <script src="<?=base_url('assets/vendor/js/helpers.js')?>"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?=base_url('assets/js/config.js')?>"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="position-relative">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-6 mx-4">
          <!-- Register Card -->
          <div class="card p-7">
        <!-- Logo -->
        <div class="app-brand justify-content-center mt-5">
          <a href="index.html" class="app-brand-link gap-3">
           <div class="app-brand justify-content-center mt-5">
            <a href="<?= base_url() ?>" class="app-brand-link gap-3">
              <img src="<?= base_url(!empty($pengaturan->logo) ? 'uploads/' . esc($pengaturan->logo) : 'assets/img/logo-white.png') ?>" 
              alt="Logo" 
              style="max-height: 50px;"/>
              <span class="app-brand-text demo text-heading fw-semibold">
                <?= esc($pengaturan->judul ?? 'Home') ?>
              </span>
            </a>
          </div>
          <span style="color: #9055fd">

                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M12.3002 1.25469L56.655 28.6432C59.0349 30.1128 60.4839 32.711 60.4839 35.5089V160.63C60.4839 163.468 58.9941 166.097 56.5603 167.553L12.2055 194.107C8.3836 196.395 3.43136 195.15 1.14435 191.327C0.395485 190.075 0 188.643 0 187.184V8.12039C0 3.66447 3.61061 0.0522461 8.06452 0.0522461C9.56056 0.0522461 11.0271 0.468577 12.3002 1.25469Z"
                        fill="currentColor" />
                      <path
                        opacity="0.077704"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M0 65.2656L60.4839 99.9629V133.979L0 65.2656Z"
                        fill="black" />
                      <path
                        opacity="0.077704"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M0 65.2656L60.4839 99.0795V119.859L0 65.2656Z"
                        fill="black" />
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M237.71 1.22393L193.355 28.5207C190.97 29.9889 189.516 32.5905 189.516 35.3927V160.631C189.516 163.469 191.006 166.098 193.44 167.555L237.794 194.108C241.616 196.396 246.569 195.151 248.856 191.328C249.605 190.076 250 188.644 250 187.185V8.09597C250 3.64006 246.389 0.027832 241.935 0.027832C240.444 0.027832 238.981 0.441882 237.71 1.22393Z"
                        fill="currentColor" />
                      <path
                        opacity="0.077704"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M250 65.2656L189.516 99.8897V135.006L250 65.2656Z"
                        fill="black" />
                      <path
                        opacity="0.077704"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M250 65.2656L189.516 99.0497V120.886L250 65.2656Z"
                        fill="black" />
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                        fill="currentColor" />
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                        fill="white"
                        fill-opacity="0.15" />
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                        fill="currentColor" />
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                        fill="white"
                        fill-opacity="0.3" />
                    </svg>
                  </span>
                </span>
               
    </a>
  </div>
  <!-- /Logo -->

  <div class="card-body mt-1">
   <link rel="shortcut icon" href="<?= base_url(!empty($pengaturan->logo) ? 'uploads/' . esc($pengaturan->logo) : 'assets/img/logo-white.png') ?>" type="image/x-icon">
   <h4 class="mb-1">Please sign up before login to <?= esc($pengaturan->judul ?? 'Home') ?> ! 👋🏻</h4>
   <p class="mb-5">Make ur new account here</p>


   <?php if (session()->getFlashdata('error')): ?>
   <p><?= session()->getFlashdata('error') ?></p>
 <?php endif; ?>
 
              <form id="formAuthentication" class="mb-5" action="<?= base_url('home/aksi_registrasi') ?>" method="POST">
                <div class="form-floating form-floating-outline mb-5">
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="name"
                    placeholder="Enter your username"
                    autofocus />
                  <label for="username">Username</label>
                </div>
                <div class="form-floating form-floating-outline mb-5">
                  <input type="text" class="form-control" id="email" name="username" placeholder="Enter your email" />
                  <label for="email">Email</label>
                </div>
                <div class="mb-5 form-password-toggle">
                  <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="password"
                        id="password"
                        class="form-control"
                        name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password" onkeyup="validatePassword()"/>
                      <label for="password">Password</label>
                    </div>
                    <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line ri-20px"></i></span>
                  </div>
                  <ul class="text-start mt-2" style="list-style-type: none; padding: 0;">
        <li id="lengthCheck" class="text-danger">❌ Minimal 8 karakter</li>
        <li id="uppercaseCheck" class="text-danger">❌ Harus ada huruf besar (A-Z)</li>
        <li id="lowercaseCheck" class="text-danger">❌ Harus ada huruf kecil (a-z)</li>
        <li id="numberCheck" class="text-danger">❌ Harus ada angka (0-9)</li>
        <li id="specialCheck" class="text-danger">❌ Harus ada karakter spesial (!@#$%^&*)</li>
    </ul>
                </div>
                <button class="btn btn-primary d-grid w-100 mb-5">Sign up</button>
              </form>

              <p class="text-center mb-5">
                <span>Already have an account?</span>
                  <a href="<?= base_url('home/login') ?>">
                  <span>Sign in instead</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->
          <img
            src="<?=base_url('assets/img/illustrations/tree-3.png')?>"
            alt="auth-tree"
            class="authentication-image-object-left d-none d-lg-block" />
          <img
            src="<?=base_url('assets/img/illustrations/auth-basic-mask-light.png')?>"
            class="authentication-image d-none d-lg-block"
            height="172"
            alt="triangle-bg"
            data-app-light-img="illustrations/auth-basic-mask-light.png"
            data-app-dark-img="illustrations/auth-basic-mask-dark.png" />
          <img
            src="<?=base_url('assets/img/illustrations/tree.png')?>"
            alt="auth-tree"
            class="authentication-image-object-right d-none d-lg-block" />
        </div>
      </div>
    </div>

<script>
function validatePassword() {
    let password = document.getElementById("password").value;

    function updateValidation(elementId, condition, message) {
        let element = document.getElementById(elementId);
        if (condition) {
            element.innerHTML = "✅ " + message;
            element.classList.remove("text-danger");
            element.classList.add("text-success");
        } else {
            element.innerHTML = "❌ " + message;
            element.classList.add("text-danger");
            element.classList.remove("text-success");
        }
    }

    updateValidation("lengthCheck", password.length >= 8, "Minimal 8 karakter");
    updateValidation("uppercaseCheck", /[A-Z]/.test(password), "Harus ada huruf besar (A-Z)");
    updateValidation("lowercaseCheck", /[a-z]/.test(password), "Harus ada huruf kecil (a-z)");
    updateValidation("numberCheck", /[0-9]/.test(password), "Harus ada angka (0-9)");
    updateValidation("specialCheck", /[!@#$%^*&]/.test(password), "Harus ada karakter spesial (!@#$%*^&)");
}
</script>
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?=base_url('assets/vendor/libs/jquery/jquery.js')?>"></script>
    <script src="<?=base_url('assets/vendor/libs/popper/popper.js')?>"></script>
    <script src="<?=base_url('assets/vendor/js/bootstrap.js')?>"></script>
    <script src="<?=base_url('assets/vendor/libs/node-waves/node-waves.js')?>"></script>
    <script src="<?=base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')?>"></script>
    <script src="<?=base_url('assets/vendor/js/menu.js')?>"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="<?=base_url('assets/js/main.js')?>"></script>

    <!-- Page JS -->

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
