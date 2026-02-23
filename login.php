<?php
session_start();

// LOGOUT
if (isset($_GET['logout'])) {
    session_unset();        // remove session variables
    session_destroy();      // destroy session
    
    setcookie("name", "", time() - 3600); // delete cookie
    
    header("Location: login.php");
    exit();
}

// LOGIN
if (isset($_POST['login'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    if (!empty($name) && !empty($email)) {
        
        // Create session
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;

        // Create cookie (expires in 1 hour)
        setcookie("name", $name, time() + 3600);

        header("Location: login.php");
        exit();
    } else {
        $error = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Car Rental Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<style>

body{
    margin: 0;
    height: 100vh;
    align-items: center;
    display: flex;
    justify-content: center;
}

.container{
    background: white;
    padding: 40px;
    width: 350px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    text-align: center;
}

button{
    width: 80%;
    padding: 10px;
    margin-top: 15px;
    border: none;
    border-radius: 6px;
    background: #CD853F;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

</style>

<body>
    <div class="container" >

<?php if (isset($_SESSION['name'])): ?>

    <h2>Dashboard</h2>
    <p class="welcome">Welcome, <?php echo $_SESSION['name']; ?>!</p>
    <p>Email: <?php echo $_SESSION['email']; ?></p>
    <a class="logout" href="login.php?logout=true">Logout</a>

<?php else: ?>
        <h2>Login </h2>

        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <form method="POST">
            <label>Name:</label><br>
            <input type="text" name="name" placeholder="Enter Name"
                value="<?php echo isset($_COOKIE['name']) ? $_COOKIE['name'] : ''; ?>">
            <br><br>

            <label>Email:</label><br>
            <input type="email" name="email" placeholder="Enter email">
            <br><br>

            <button type="submit" name="login">Login</button>
        </form>

<?php endif; ?>
</div>

</body>
</html>