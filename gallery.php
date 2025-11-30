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
    <title>Gallery — ZEIRO Photography</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<!-- NAVBAR -->
<header class="site-header">
    <div class="header-inner">

        <div class="brand">
            <img src="images/zeiro-logo.png" alt="ZEIRO Logo" class="logo">
        </div>

        <nav class="main-nav">
            <a href="index.php">Home</a>
            <a href="gallery.php" class="active">Gallery</a>
            <a href="about.php">About</a>
            <a href="booking.php">Booking</a>
            <a href="logout.php">Logout</a>
        </nav>

    </div>
</header>

<div style="height:100px;"></div> <!-- spacing under navbar -->

<!-- PAGE TITLE -->
<section class="container center">
    <h1 class="gallery-title">Gallery</h1>
    <p class="muted" style="margin-top:8px;">
        Explore photography categories
    </p>

    <!-- FILTER BUTTONS -->
    <div class="filter-bar">
        <button class="active" data-filter="all">All</button>
        <button data-filter="wedding">Wedding</button>
        <button data-filter="prewedding">Pre-Wedding</button>
        <button data-filter="portraits">Portraits</button>
        <button data-filter="products">Products</button>
        <button data-filter="events">Events</button>
        <button data-filter="wildlife">Wildlife</button>
        <button data-filter="framefables">Frame Fables</button>
    </div>
</section>

<!-- GALLERY GRID -->
<section class="gallery-grid">

    <!-- Wedding -->
    <div class="item" data-category="wedding">
        <img src="images/shadi.avif" alt="">
    </div>

    <div class="item" data-category="wedding">
        <img src="images/shadi2.jpeg" alt="">
    </div>

    <div class="item" data-category="wedding">
        <img src="images/shadi3.avif" alt="">
    </div>

    <div class="item" data-category="wedding">
        <img src="images/shadi4.avif" alt="">
    </div>

    <div class="item" data-category="wedding">
        <img src="images/shadi5.avif" alt="">
    </div>

    <div class="item" data-category="wedding">
        <img src="images/shadi6.avif" alt="">
    </div>

    <!-- Pre-Wedding -->
    <div class="item" data-category="prewedding">
        <img src="images/prewed.avif" alt="">
    </div>
    <!-- Pre-Wedding -->
    <div class="item" data-category="prewedding">
        <img src="images/pre1.avif" alt="">
    </div>
    <!-- Pre-Wedding -->
    <div class="item" data-category="prewedding">
        <img src="images/pre2.avif" alt="">
    </div>
    <!-- Pre-Wedding -->
    <div class="item" data-category="prewedding">
        <img src="images/pre3.avif" alt="">
    </div>
    <!-- Pre-Wedding -->
    <div class="item" data-category="prewedding">
        <img src="images/pre4.avif" alt="">
    </div>
    <!-- Pre-Wedding -->
    <div class="item" data-category="prewedding">
        <img src="images/pre5.avif" alt="">
    </div>

    <!-- Portraits -->
    <div class="item" data-category="portraits">
        <img src="images/pro.avif" alt="">
    </div>

    <!-- Portraits -->
    <div class="item" data-category="portraits">
        <img src="images/p1.avif" alt="">
    </div>

    <!-- Portraits -->
    <div class="item" data-category="portraits">
        <img src="images/p2.avif" alt="">
    </div>

    <!-- Portraits -->
    <div class="item" data-category="portraits">
        <img src="images/p3.avif" alt="">
    </div>

    <!-- Portraits -->
    <div class="item" data-category="portraits">
        <img src="images/p4.avif" alt="">
    </div>

    <!-- Portraits -->
    <div class="item" data-category="portraits">
        <img src="images/p5.avif" alt="">
    </div>

   

    <!-- Products -->
    <div class="item" data-category="products">
        <img src="images/per.avif" alt="">
    </div>

    <!-- Products -->
    <div class="item" data-category="products">
        <img src="images/d1.avif" alt="">
    </div>

    <!-- Products -->
    <div class="item" data-category="products">
        <img src="images/d2.avif" alt="">
    </div>

    <!-- Products -->
    <div class="item" data-category="products">
        <img src="images/d3.avif" alt="">
    </div>

    <!-- Products -->
    <div class="item" data-category="products">
        <img src="images/d4.avif" alt="">
    </div>

    <!-- Products -->
    <div class="item" data-category="products">
        <img src="images/d5.avif" alt="">
    </div>

    <!-- Events -->
    <div class="item" data-category="events">
        <img src="images/event5.avif" alt="">
    </div>
    <!-- Events -->
    <div class="item" data-category="events">
        <img src="images/e1.avif" alt="">
    </div>
    <!-- Events -->
    <div class="item" data-category="events">
        <img src="images/e2.avif" alt="">
    </div>
    <!-- Events -->
    <div class="item" data-category="events">
        <img src="images/e3.avif" alt="">
    </div>
    <!-- Events -->
    <div class="item" data-category="events">
        <img src="images/e4.avif" alt="">
    </div>
    <!-- Events -->
    <div class="item" data-category="events">
        <img src="images/e5.avif" alt="">
    </div>

    <!-- Wildlife -->
    <div class="item" data-category="wildlife">
        <img src="images/wild.avif" alt="">
    </div>

    <!-- Wildlife -->
    <div class="item" data-category="wildlife">
        <img src="images/w1.avif" alt="">
    </div>

    <!-- Wildlife -->
    <div class="item" data-category="wildlife">
        <img src="images/w6.avif" alt="">
    </div>

    <!-- Wildlife -->
    <div class="item" data-category="wildlife">
        <img src="images/w3.avif" alt="">
    </div>

    <!-- Wildlife -->
    <div class="item" data-category="wildlife">
        <img src="images/g1.jpeg" alt="">
    </div>

    <!-- Wildlife -->
    <div class="item" data-category="wildlife">
        <img src="images/g2.jpeg" alt="">
    </div>

    <!-- Frame Fables -->
    <div class="item" data-category="framefables">
        <img src="images/g4.jpeg" alt="">
    </div>
    <!-- Frame Fables -->
    <div class="item" data-category="framefables">
        <img src="images/g5.jpeg" alt="">
    </div>
    <!-- Frame Fables -->
    <div class="item" data-category="framefables">
        <img src="images/g6.jpeg" alt="">
    </div>
    <!-- Frame Fables -->
    <div class="item" data-category="framefables">
        <img src="images/g7.jpeg" alt="">
    </div>
    <!-- Frame Fables -->
    <div class="item" data-category="framefables">
        <img src="images/c5.jpeg" alt="">
    </div>
    <!-- Frame Fables -->
    <div class="item" data-category="framefables">
        <img src="images/c2.jpg" alt="">
    </div>

</section>


<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox">
    <img id="lightbox-img" class="lb-img">
    <div id="lightbox-close" class="lb-close">&times;</div>
</div>

<!-- FOOTER -->
<footer class="site-footer">
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

<script src="js/gallery.js"></script>

</body>
</html>
