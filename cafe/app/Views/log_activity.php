<!DOCTYPE html>
<html>
<head>
    <title>Log Activity</title><!-- 
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap.min.css') ?>"> -->
</head>
<body>

<div class="container mt-4">
    <h2>Log Activity</h2>
    <div class="table-responsive text-nowrap">
   <table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Waktu</th>
            <th>Tanggal</th>
            <th>Nama User</th>
            <th>Username</th>
            <th>Activity</th>
            <th>IP Address</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($logs as $log): ?>
            <tr>
                <td><?= $log->id ?></td>
                <td><?= $log->waktu ?></td>
                <td><?= $log->date ?></td>
                <td><?= $log->nama_user ?></td>
                <td><?= $log->username ?></td>
                <td><?= $log->activity ?></td>
                <td><?= $log->ip_address ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>

</body>
</html>
