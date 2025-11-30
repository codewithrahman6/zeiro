<?php
session_start();
include "db.php";

$error = "";

// If already logged in → go home (not dashboard)
if (isset($_SESSION["admin_id"])) {
    header("Location: admin/dashboard.php");
    exit();
}
if (isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    /* ===================================
       1) CHECK ADMIN LOGIN
    ==================================== */
    $admin = $conn->prepare("SELECT * FROM admin_users WHERE email = ?");
    $admin->bind_param("s", $email);
    $admin->execute();
    $adminResult = $admin->get_result();

    if ($adminResult->num_rows === 1) {
        $row = $adminResult->fetch_assoc();

        if (password_verify($password, $row["password"])) {
            $_SESSION["admin_id"] = $row["id"];
            header("Location: admin/dashboard.php");
            exit();
        } else {
            $error = "Incorrect password";
        }
    }

    /* ===================================
       2) CHECK CLIENT LOGIN
    ==================================== */
    $client = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $client->bind_param("s", $email);
    $client->execute();
    $clientResult = $client->get_result();

    if ($clientResult->num_rows === 1) {
        $row = $clientResult->fetch_assoc();

        if (password_verify($password, $row["password"])) {

            // 🤝 CLIENT LOGIN → GO TO HOME PAGE
            $_SESSION["user_id"] = $row["id"];
            header("Location: index.php");
            exit();

        } else {
            $error = "Incorrect password";
        }
    }

    if ($error === "") {
        $error = "Email not found";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login — ZEIRO Photography</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<div class="login-bg"></div>

<div class="login-container glass">
    <div class="logo-holder">
        <img src="images/zeiro-logo.png">
        <h2>Welcome Back</h2>
        <p class="subtitle">Login to continue your journey</p>
    </div>

    <?php if (!empty($error)): ?>
        <div class="error-box"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button class="btn-login">Login</button>
    </form>

    <p class="bottom-text">
        New here? <a href="register.php">Create an Account</a>
    </p>
</div>

</body>
</html>
