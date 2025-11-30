<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login — ZEIRO</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2 style="text-align:center; margin-top:60px;">Admin Login</h2>

<form action="admin_auth.php" method="POST" class="booking-form" style="max-width:400px; margin:auto;">
    <label>Username</label>
    <input type="text" name="username" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <button class="btn btn-gold" style="margin-top:15px;">Login</button>
</form>

</body>
</html>
