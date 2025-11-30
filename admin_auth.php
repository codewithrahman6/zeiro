<?php
session_start();

// SIMPLE ADMIN DETAILS (You can change these)
$admin_user = "admin";
$admin_pass = "12345";

if ($_POST['username'] === $admin_user && $_POST['password'] === $admin_pass) {
    $_SESSION['admin'] = true;
    header("Location: dashboard.php");
} else {
    echo "<h2>Invalid Login!</h2>";
}
?>
