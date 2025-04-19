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

      <title><?= esc($pengaturan->judul ?? 'Home') ?></title>

  <meta content="<?= esc($pengaturan->nama_app ?? 'Spedito - All in one place') ?>" name="description">

    <!-- Favicon -->
     <link rel="shortcut icon" href="<?= base_url(!empty($pengaturan->logo) ? 'uploads/' . esc($pengaturan->logo) : 'assets/img/logo-white.png') ?>" type="image/x-icon">

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
    
<div id="google_translate_element"></div>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'id',
            includedLanguages: 'en,id',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  </head>
<body>
