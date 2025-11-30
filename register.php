<?php
session_start();
include "db.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $passwordHashed = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Check email exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $res = $check->get_result();

    if ($res->num_rows > 0) {
        $error = "Email already registered.";
    } else {

        // Insert client user
        $insert = $conn->prepare("
            INSERT INTO users (name, email, password, role)
            VALUES (?, ?, ?, 'client')
        ");
        $insert->bind_param("sss", $name, $email, $passwordHashed);

        if ($insert->execute()) {
            $success = "Account created successfully!";
        } else {
            $error = "Database error.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register — ZEIRO Photography</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>

<div class="register-bg"></div>
<div class="register-container glass">

    <div class="logo-holder">
        <img src="images/zeiro-logo.png">
        <h2>Create Account</h2>
        <p class="subtitle">Join Zeiro Photography</p>
    </div>

    <?php if ($error): ?>
        <div class="error-box"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success-box"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Password" required>

        <button class="btn-register">Create Account</button>
    </form>

    <p class="bottom-text">Already registered?
        <a href="login.php">Login</a>
    </p>

</div>

</body>
</html>
