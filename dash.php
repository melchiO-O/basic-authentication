<?php
session_start();

// Access Rule: redirect to form if session data does not exist
if (!isset($_SESSION['name']) || !isset($_SESSION['email'])) {
    header("Location: form.php");
    exit();
}

$name       = htmlspecialchars($_SESSION['name']);
$email      = htmlspecialchars($_SESSION['email']);
$cookieName = htmlspecialchars($_COOKIE['user_name'] ?? '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard – Protected Page</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            padding: 40px;
            width: 100%;
            max-width: 480px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 6px;
            font-size: 1.8rem;
        }

        .subtitle {
            text-align: center;
            color: #777;
            margin-bottom: 30px;
            font-size: 0.9rem;
        }

        .info-box {
            background: #f0fdf4;
            border: 1px solid #86efac;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .info-box p {
            margin-bottom: 10px;
            color: #374151;
            font-size: 0.95rem;
        }

        .info-box p:last-child { margin-bottom: 0; }

        .info-box span {
            font-weight: 700;
            color: #166534;
        }

        .cookie-box {
            background: #fefce8;
            border: 1px solid #fde047;
            border-radius: 8px;
            padding: 16px 20px;
            margin-bottom: 24px;
            color: #713f12;
            font-size: 0.9rem;
        }

        .cookie-box strong { font-weight: 700; }

        .btn-logout {
            display: block;
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #ef4444, #b91c1c);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: opacity 0.3s;
            letter-spacing: 0.5px;
        }

        .btn-logout:hover { opacity: 0.88; }
    </style>
</head>
<body>
<div class="card">
    <h1>Dashboard</h1>
    <p class="subtitle">Protected Page</p>

    <div class="info-box">
        <p>Name: <span><?= $name ?></span></p>
        <p>Email: <span><?= $email ?></span></p>
    </div>

    <?php if ($cookieName): ?>
    <div class="cookie-box">
        <strong>Cookie value:</strong> user_name = "<?= $cookieName ?>"
    </div>
    <?php endif; ?>

    <a href="logout.php" class="btn-logout">Logout &rarr;</a>
</div>
</body>
</html>