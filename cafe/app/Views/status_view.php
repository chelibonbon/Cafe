
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #333;
        }
        p {
            color: #555;
            font-size: 16px;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            color: white;
            background-color: #007BFF;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><?= $type === 'success' ? 'Success' : 'Error' ?></h2>
        <p><?= $message; ?></p>
        <?php if ($type === 'success'): ?>
            <a href="<?= base_url('/home/login'); ?>">Go to Login</a>
        <?php else: ?>
            <a href="javascript:history.back()">Try Again</a>
        <?php endif; ?>
    </div>
</body>
</html>