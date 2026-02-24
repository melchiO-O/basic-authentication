<?php
session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name']  ?? '');
    $email = trim($_POST['email'] ?? '');

    // Validate: fields must not be empty
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (empty($errors)) {
        // Store in session
        $_SESSION['name']  = $name;
        $_SESSION['email'] = $email;

        // Store name in a cookie (expires in 1 hour)
        setcookie('user_name', $name, time() + 3600, '/');

        // Redirect to dashboard
        header("Location: dash.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Data Input Form</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            max-width: 420px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 8px;
            font-size: 1.8rem;
        }

        .subtitle {
            text-align: center;
            color: #777;
            margin-bottom: 28px;
            font-size: 0.9rem;
        }

        .error-box {
            background: #ffeaea;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 20px;
            color: #c0392b;
            font-size: 0.9rem;
        }

        .error-box ul { padding-left: 18px; }
        .error-box li { margin-bottom: 4px; }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #555;
            font-size: 0.9rem;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
            margin-bottom: 20px;
            outline: none;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #667eea;
        }

        button[type="submit"] {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: opacity 0.3s;
            letter-spacing: 0.5px;
        }

        button[type="submit"]:hover { opacity: 0.88; }
    </style>
</head>
<body>
<div class="card">
    <h1>Welcome</h1>
    <p class="subtitle">Input Form</p>

    <?php if (!empty($errors)): ?>
        <div class="error-box">
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="form.php">
        <label for="name">Name</label>
        <input
            type="text"
            id="name"
            name="name"
            placeholder="Enter your name"
            value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
            autocomplete="off"
        >

        <label for="email">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            placeholder="Enter your email"
            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
            autocomplete="off"
        >

        <button type="submit">Submit &rarr;</button>
    </form>
</div>
</body>
</html>