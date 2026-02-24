<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Expire the cookie
if (isset($_COOKIE['user_name'])) {
    setcookie('user_name', '', time() - 3600, '/');
}

// Redirect back to the form
header("Location: form.php");
exit();