<!-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/uikit.min.css') ?>">
</head>
<body>
    <div class="uk-container">
        <h2>Settings</h2>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="uk-alert-success" uk-alert>
                <p><?= session()->getFlashdata('success') ?></p>
            </div>
        <?php endif; ?>
        <form action="<?= site_url('home/simpan_pengaturan') ?>" method="post" enctype="multipart/form-data">
               <div class="uk-margin">
                  <?php if (!empty($pengaturan->logo)): ?>
                    <div class="uk-margin">
                        <img src="<?= base_url('uploads/' . $pengaturan->logo) ?>" alt="Logo" width="100">
                    </div>
                <?php endif; ?>
                <label>Logo</label>
                <input class="uk-input" type="file" name="logo">
            </div>
            <div class="uk-margin">
                <label>Judul</label>
                <input class="uk-input" type="text" name="judul" value="<?= $pengaturan->judul ?? '' ?>" required>
            </div>
            <div class="uk-margin">
                <label>Nama Aplikasi</label>
                <input class="uk-input" type="text" name="nama_app" value="<?= $pengaturan->nama_app ?? '' ?>" required>
            </div>
         
            <button type="submit" class="uk-button uk-button-primary">Simpan</button>
        </form>
    </div>
</body>
</html> -->

<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/uikit.min.css') ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm">
        <h2 class="text-2xl font-semibold mb-4">Settings</h2>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="uk-alert-success mb-4" uk-alert>
                <p><?= session()->getFlashdata('success') ?></p>
            </div>
        <?php endif; ?>
        <form action="<?= site_url('home/simpan_pengaturan') ?>" method="post" enctype="multipart/form-data">
            <div class="flex justify-center mb-6">
                  <?php if (!empty($pengaturan->logo)): ?>
                    <div class="uk-margin">
                        <img src="<?= base_url('uploads/' . $pengaturan->logo) ?>" alt="Logo" width="100">
                    </div>
                <?php endif; ?>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-500 text-sm">Title App</label>
                    <input type="text" class="w-full border border-gray-300 rounded-lg p-2" name="judul" value="<?= $pengaturan->judul ?? '' ?>" placeholder="App Title" required/>
                </div>
           <!--      <div>
                    <label class="block text-gray-500 text-sm">Name App</label>
                    <input type="text" class="w-full border border-gray-300 rounded-lg p-2" name="nama_app" value="<?= $pengaturan->nama_app ?? '' ?>" placeholder="App Name" required/>
                </div> -->
                <div>
                    <label class="block text-gray-500 text-sm">Logo</label>
                    <input type="file" id="logo-file" class="w-full border border-gray-300 rounded-lg p-2" name="logo" accept="image/*"/>
                </div>
              <!--   <div>
                    <label class="block text-gray-500 text-sm">Icon App</label>
                    <input type="file" id="icon" class="w-full border border-gray-300 rounded-lg p-2" name="icon" accept="image/*"/>
                </div> -->
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg text-lg font-semibold">Save Information</button>
            </div>
        </form>
    </div>
</body>
</html>