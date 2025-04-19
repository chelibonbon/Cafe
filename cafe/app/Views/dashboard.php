<?php
// Ambil data pengaturan dari database
$db = db_connect();
$pengaturan = $db->table('pengaturan_app')->get()->getRow();
$level = session()->get('level'); // Ambil level user dari session
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($pengaturan->judul ?? 'Home') ?></title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&family=Roboto:wght@400&display=swap" rel="stylesheet">

  <!-- Remix Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css">

  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f4f5fa;
      margin: 0;
      padding: 0;
    }
    .content {
      margin: 40px;
      padding: 20px;
    }
    .navbar {
      background-color: #fff;
      box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      margin-bottom: 30px;
      padding: 1rem 2rem;
    }
    .navbar-brand {
      font-size: 1.5rem;
      color: #6a1b9a;
      font-weight: bold;
    }
    .welcome {
      text-align: center;
      margin-bottom: 20px;
    }
    .welcome h4 {
      font-family: 'Roboto Slab', serif;
      color: #6a1b9a;
      font-size: 2rem;
      margin: 10px 0 0;
    }
    .dashboard-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 40px;
      margin-top: 30px;
    }
    @media (min-width: 768px) {
      .dashboard-container {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding: 0 50px;
      }
    }
    .dashboard-text {
      max-width: 600px;
      text-align: center;
    }
    @media (min-width: 768px) {
      .dashboard-text {
        text-align: left;
      }
    }
    .dashboard-text span {
      color: #6a1b9a;
      font-size: 1.2rem;
      font-weight: 400;
    }
    .dashboard-text h1 {
      font-family: 'Roboto Slab', serif;
      font-size: 3rem;
      color: #6a1b9a;
      margin: 10px 0 20px;
      line-height: 1.2;
    }
    .dashboard-text p {
      color: #8968CD;
      font-size: 1rem;
      margin-bottom: 20px;
    }
    .dashboard-text button {
      background-color: #6a1b9a;
      color: #fff;
      border: none;
      padding: 12px 30px;
      border-radius: 999px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .dashboard-text button:hover {
      background-color: #4a148c;
    
    }
    .dashboard-image img {
      width: 90%;
      height: auto;
      object-fit: contain;
    }
  </style>
</head>
<body>
    <div>
  <!-- Welcome Message -->
  <div class="welcome">
    <?php if (session()->get('level') == 2 && session()->get('nama_kasir')): ?>
      <h4>Greetings, <?= session()->get('nama_kasir') ?>!</h4>
    <?php else: ?>
      <h4>Greetings, <?= session()->get('nama_user') ?>!</h4>
    <?php endif; ?>
  </div>

  <!-- Dashboard Section -->
  <div class="dashboard-container">
    <div class="dashboard-text">
      <span>Welcome to</span>
      <h1><?= esc($pengaturan->judul ?? 'Home') ?></h1>
    <p>Explore our delicious menu filled with handcrafted dishes, refreshing drinks, and sweet treats.  
    Ready to begin your experience? Just tap the "Menu" button below and start your order — we can't wait to serve you!</p>
        <a href="<?= base_url('home/menu_barang/') ?>" style="text-decoration: none;">
  <button style="background-color: #6a1b9a; color: #fff; border: none; padding: 12px 30px; border-radius: 999px; font-size: 1rem; cursor: pointer; transition: background-color 0.3s ease;">
    <i class="ri-restaurant-line"></i> Go to Menu
  </button>
</a>
 <a href="<?= base_url('home/pemesanan/') ?>" style="text-decoration: none;">
  <button style="background-color: #6a1b9a; color: #fff; border: none; padding: 12px 30px; border-radius: 999px; font-size: 1rem; cursor: pointer; transition: background-color 0.3s ease;">
    <i class="ri-receipt-line"></i> Your orders
  </button>
</a>
    </div>
    
    <div class="dashboard-image">
      <img src="<?= base_url(!empty($pengaturan->logo) ? 'uploads/' . esc($pengaturan->logo) : 'assets/img/logo-white.png') ?>" alt="Logo Cafe">
    </div>
  </div>

</div>

<!-- 
<script>
function logUserActivity(activity) {
    fetch('<?= base_url('home/logActivity') ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ activity: activity })
    });
}
document.addEventListener('DOMContentLoaded', function() {
    logUserActivity('Visited: ' + window.location.pathname);
    document.body.addEventListener('click', function(event) {
        let element = event.target.tagName.toLowerCase();
        logUserActivity('Clicked: ' + element);
    });
});
</script>
-->

</body>
</html>
