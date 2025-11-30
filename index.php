<?php
session_start();

// ADMIN logged in
if (!empty($_SESSION['admin_id'])) {
    $forceLogin = false;
}
// CLIENT logged in
else if (!empty($_SESSION['user_id'])) {
    $forceLogin = false;
}
// NOT logged in
else {
    $forceLogin = true;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZEIRO Photography — Home</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<!-- HEADER -->
<header class="site-header">
  <div class="header-inner">

    <!-- LOGO -->
    <div class="brand">
      <img src="images/zeiro-logo.png" class="logo" alt="ZEIRO">
    </div>

    <!-- FIXED NAVBAR (NO DUPLICATES) -->
    <nav class="main-nav">
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="index.php" class="active">Home</a>
        <a href="gallery.php">Gallery</a>
        <a href="about.php">About</a>
        <a href="booking.php">Booking</a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="#" id="open-login">Login</a>
        <a href="#" id="open-register-direct">Register</a>
    <?php endif; ?>
    </nav>

  </div>
</header>


<!-- HERO SECTION -->
<section class="hero">

  <div class="cinematic-overlay">
      <div class="cinematic-grade"></div>
      <div class="lens-flare"></div>

      <div class="dust" style="left:10%; animation-duration:13s;"></div>
      <div class="dust" style="left:25%; animation-duration:11s;"></div>
      <div class="dust" style="left:40%; animation-duration:15s;"></div>
      <div class="dust" style="left:60%; animation-duration:12s;"></div>
      <div class="dust" style="left:75%; animation-duration:10s;"></div>
  </div>

  <div class="hero-slideshow">
      <img src="images/s6.avif" class="hero-img active">
      <img src="images/s4.avif" class="hero-img">
      <img src="images/hero1.jpeg" class="hero-img">
      <img src="images/s5.avif" class="hero-img">
      <img src="images/s1.avif" class="hero-img">
  </div>

  <div class="hero-content">
      <h1>ZEIRO Photography</h1>
      <p class="sub">Capturing Timeless Stories Through the Lens</p>
      <a href="gallery.php" class="btn btn-gold">View Gallery</a>
      <a href="booking.php" class="btn btn-outline">Book Session</a>
  </div>

</section>


<!-- STATS SECTION -->
<section class="stats-section">
    <div class="container stats-grid">

        <div class="stat-box">
            <h3>10+</h3><p>Years Experience</p>
        </div>

        <div class="stat-box">
            <h3>500+</h3><p>Happy Clients</p>
        </div>

        <div class="stat-box">
            <h3>50+</h3><p>Awards Won</p>
        </div>

        <div class="stat-box">
            <h3>5000+</h3><p>Photos Captured</p>
        </div>

    </div>
</section>


<!-- FEATURED WORK -->
<section class="featured container">
    <h2>Featured Work</h2>
    <p class="lead">A glimpse into timeless frames</p>

    <div class="featured-grid">
        <div class="card glass glass-shine glass-glow tilt ripple">
            <img src="images/wildlife.avif">
        </div>

        <div class="card glass glass-shine glass-float tilt">
            <img src="images/rocks.avif">
        </div>

        <div class="card glass glass-shine glass-glow tilt ripple">
            <img src="images/model2.avif">
        </div>
    </div>

    <a href="gallery.php" class="btn btn-gold">View Full Gallery</a>
</section>



<!-- READY TO CAPTURE -->
<section class="ready-section">
  <div class="ready-container">

      <h2 class="ready-title">Ready to Capture Your Story?</h2>
      <p class="ready-sub">
          Let’s create timeless memories together. Book your session today.
      </p>

      <a href="booking.php" class="btn ready-btn">
          BOOK YOUR SESSION →
      </a>

  </div>
</section>



<!-- FOOTER -->
<footer class="site-footer glass glass-shine glass-animated tilt">
    <div class="container">
        <div class="brand">ZEIRO Photography</div>

        <div class="footer-links">
            <a href="index.php">Home</a>
            <a href="gallery.php">Gallery</a>
            <a href="about.php">About</a>
            <a href="booking.php">Booking</a>
        </div>

        <div style="margin-top:10px;color:#999;font-size:14px;">
            © 2025 ZEIRO Photography. All Rights Reserved.
        </div>
    </div>
</footer>


<!-- LOGIN POPUP -->
<div id="login-modal" class="modal-overlay">
  <div class="modal-box glass tilt">

    <h2>Login</h2>

    <form action="login.php" method="POST">
      <label>Email</label>
      <input type="email" name="email" required>

      <label>Password</label>
      <input type="password" name="password" required>

      <button type="submit" class="btn btn-gold">Login</button>

      <p>New here? <a href="#" id="open-register">Register Now</a></p>
    </form>

  </div>
</div>


<!-- REGISTER POPUP -->
<div id="register-modal" class="modal-overlay">
  <div class="modal-box glass tilt">

    <h2>Create Account</h2>

    <form action="register.php" method="POST">

      <label>Name</label>
      <input type="text" name="name" required>

      <label>Email</label>
      <input type="email" name="email" required>

      <label>Password</label>
      <input type="password" name="password" required>

      <button type="submit" class="btn btn-gold">Register</button>

    </form>

  </div>
</div>


<!-- POPUP LOGIC -->
<script>
// open login popup
document.getElementById("open-login")?.addEventListener("click", () => {
    document.getElementById("login-modal").style.display = "flex";
});

// open register popup from navbar
document.getElementById("open-register-direct")?.addEventListener("click", () => {
    document.getElementById("register-modal").style.display = "flex";
});

// from login → go to register
document.getElementById("open-register")?.addEventListener("click", () => {
    document.getElementById("login-modal").style.display = "none";
    document.getElementById("register-modal").style.display = "flex";
});

// show login popup on first visit
<?php if ($forceLogin): ?>
window.onload = function() {
    document.getElementById("login-modal").style.display = "flex";
};
<?php endif; ?>
</script>


<script src="js/main.js"></script>

</body>
</html>
