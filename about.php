<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About — Alex Morgan Photography</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header class="site-header glass glass-shine glass-animated tilt">
    <div class="container header-inner">

        <div class="brand">
            <img src="images/zeiro-logo.png" alt="ZEIRO Logo" class="logo">
        </div>


    </div>
</header>

  


<!-- ABOUT TITLE -->
<section class="container">
    <h1 style="font-family:'Playfair Display';text-align:center;font-size:40px;margin-top:20px;">
        About Me
    </h1>

    <!-- ABOUT SECTION -->
    <div class="about-row">

        <!-- IMAGE -->
        <div class="about-img glass glass-shine glass-animated tilt">
            <img src="images/photo.avif" style="width:100%;height:100%;border-radius:12px;">
        </div>

        <!-- TEXT -->
        <div class="about-text glass glass-shine glass-glow glass-animated tilt" style="padding:28px;border-radius:12px;">
            <h3 style="font-family:'Playfair Display';font-size:28px;margin-top:0;">Alex Morgan</h3>

            <p>
                I am a passionate professional photographer with over
                <strong>10 years of experience</strong> in the field.
                I specialize in <strong>weddings, portraits, wildlife, events, and commercial product photography</strong>.
            </p>

            <p>
                Every photograph is a story. My mission is to capture raw emotions, natural beauty, and timeless memories.
            </p>

            <ul style="list-style:none;padding-left:0;margin-top:18px;">
                <li>✉️ alex@morganphotography.com</li>
                <li>📞 +1 (555) 123-4567</li>
                <li>📍 New York, USA</li>
            </ul>

            <a href="booking.php" class="btn btn-gold" style="margin-top:14px;display:inline-block;">Book a Session</a>
        </div>

    </div>


    <!-- ACHIEVEMENTS -->
    <!-- ACHIEVEMENTS & RECOGNITION -->
<section class="achievements-section container">

    <h2 class="section-title">Achievements & Recognition</h2>
    <div class="underline"></div>

    <div class="achievements-grid">

        <div class="ach-card">
            <i class="icon">🏆</i>
            <p>International Photography Award Winner 2023</p>
        </div>

        <div class="ach-card">
            <i class="icon">📸</i>
            <p>Featured in National Geographic</p>
        </div>

        <div class="ach-card">
            <i class="icon">⭐</i>
            <p>Over 500 successful client projects</p>
        </div>

        <div class="ach-card">
            <i class="icon">🎖️</i>
            <p>Certified Professional Photographer (CPP)</p>
        </div>

    </div>
</section>



    <!-- TESTIMONIALS -->
    <!-- CLIENT REVIEWS -->
<section class="reviews-section container">

    <h2 class="section-title">What Clients Say</h2>
    <div class="underline"></div>

    <div class="reviews-grid">

        <!-- REVIEW 1 -->
        <div class="review-card">
            <img src="images/r1.avif" class="client-photo">
            <h3>Sarah Johnson</h3>
            <span class="role">Bride</span>
            <div class="stars">★★★★★</div>
            <p class="review-text">
                "Alex captured our wedding perfectly! Every photo feels magical."
            </p>
        </div>

        <!-- REVIEW 2 -->
        <div class="review-card">
            <img src="images/r2.avif" class="client-photo">
            <h3>Michael Chen</h3>
            <span class="role">Business Owner</span>
            <div class="stars">★★★★★</div>
            <p class="review-text">
                "The product photography for our brand was amazing and boosted sales."
            </p>
        </div>

        <!-- REVIEW 3 -->
        <div class="review-card">
            <img src="images/r3.avif" class="client-photo">
            <h3>Emily Davis</h3>
            <span class="role">Event Organizer</span>
            <div class="stars">★★★★★</div>
            <p class="review-text">
                "Professional, creative, and extremely talented. Highly recommended!"
            </p>
        </div>

    </div>
</section>

<?php session_start(); ?>
<nav class="main-nav">

<?php if (isset($_SESSION['user_id'])): ?>
    <a href="index.php">Home</a>
    <a href="gallery.php">Gallery</a>
    <a href="about.php">About</a>
    <a href="booking.php">Booking</a>
    <a href="logout.php">Logout</a>
<?php else: ?>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
<?php endif; ?>

</nav>



<!-- FOOTER -->
<footer class="site-footer glass glass-shine glass-animated tilt">
    <div class="container">
        <div class="brand">Alex Morgan</div>

        <div class="footer-links">
            <a href="index.html">Home</a>
            <a href="gallery.html">Gallery</a>
            <a href="about.html">About</a>
            <a href="booking.php">Booking</a>
        </div>

        <div style="margin-top:10px;color:#999;font-size:14px;">
            © 2025 Alex Morgan Photography. All Rights Reserved.
        </div>
    </div>
</footer>

</body>
</html>
