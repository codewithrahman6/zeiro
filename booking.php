<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // If you want to force login to book, keep this. Otherwise comment out.
    header("Location: login.php");
    exit();
}

$config = include __DIR__ . "/config.php";
$razorpay_key = $config["razorpay_key"] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Book Experience — ZEIRO Photography</title>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">

<!-- small inline styles for booking page only (you can move to style.css) -->
<style>
/* Booking page mini-theme - keeps consistent with your main CSS */
.booking-page { display:flex; gap:28px; align-items:flex-start; padding:40px 0; }
.booking-left { flex:1; min-width:360px; }
.booking-side { width:360px; }
.stepper { display:flex; gap:10px; margin-bottom:18px; }
.step { padding:8px 12px; background:rgba(255,255,255,0.03); border-radius:8px; color:#ccc; font-weight:600; }
.step.active { background:var(--gold); color:#111; }
.step-panel { background:rgba(255,255,255,0.02); padding:20px; border-radius:12px; border:1px solid rgba(255,255,255,0.04); margin-bottom:18px; }
.icon-row { display:flex; flex-wrap:wrap; gap:12px; }
.icon-card { width:150px; padding:14px; background:#0b0b0b; border-radius:10px; text-align:center; cursor:pointer; border:1px solid rgba(255,255,255,0.03); }
.icon-card.selected { background:var(--gold); color:#111; }
.addon-card { margin-top:10px; padding:10px; border-radius:8px; background:rgba(255,255,255,0.02); display:flex; align-items:center; justify-content:space-between; gap:10px; }
.summary-box { padding:20px; border-radius:12px; background:rgba(255,255,255,0.02); border:1px solid rgba(255,255,255,0.04); }
.summary-row { display:flex; justify-content:space-between; margin:8px 0; color:#eee; }
.total-row { font-size:22px; font-weight:700; color:var(--gold); margin-top:12px; text-align:right; }
.btn-ghost, .btn-primary { padding:10px 14px; border-radius:8px; cursor:pointer; }
.btn-ghost { background:transparent; border:1px solid var(--gold); color:var(--gold); }
.btn-primary { background:var(--gold); color:#111; border:none; font-weight:600; }
.input-plain { width:100%; padding:8px 10px; border-radius:8px; background:#0d0d0d; border:1px solid rgba(255,255,255,0.04); color:#fff; margin-top:8px; }
.dynamic-addons .addon-card input[type="number"]{ width:100px; text-align:right; }
/* responsive */
@media(max-width:900px){ .booking-page{ flex-direction:column } .booking-side{ width:100% } }
</style>

</head>
<body>
<?php // include your header file if you have one ?>
<header class="site-header">
  <div class="header-inner container">
    <div class="brand"><img src="images/zeiro-logo.png" class="logo" alt="ZEIRO"></div>
    <nav class="main-nav">
      <a href="index.php">Home</a>
      <a href="gallery.php">Gallery</a>
      <a href="about.php">About</a>
      <a class="active" href="booking.php">Booking</a>
    </nav>
  </div>
</header>

<div style="height:110px"></div>

<div class="container booking-page">

  <!-- LEFT: Steps -->
  <div class="booking-left">

    <div class="stepper">
      <div class="step active" data-step="1">1. Experience</div>
      <div class="step" data-step="2">2. Add-ons</div>
      <div class="step" data-step="3">3. Review & Pay</div>
    </div>

    <!-- PANEL 1 -->
    <div class="step-panel" id="panel-1">
      <h3>Select Experience</h3>
      <div class="icon-row">
        <div class="icon-card" data-exp="wildlife">🦁<br>Wildlife</div>
        <div class="icon-card" data-exp="prewedding">💍<br>Pre-Wedding</div>
        <div class="icon-card" data-exp="baby">👶<br>Baby Shoot</div>
        <div class="icon-card" data-exp="fashion">👗<br>Fashion</div>
        <div class="icon-card" data-exp="event">🏢<br>Event / Corporate</div>
      </div>
      <div style="margin-top:14px;">
        <button id="next1" class="btn-ghost">Next</button>
      </div>
    </div>

    <!-- PANEL 2 -->
    <div class="step-panel" id="panel-2" style="display:none;">
      <h3>Add-ons & Options</h3>

      <label>Camera Setup</label>
      <select id="camera" class="input-plain" style="margin-top:8px;">
        <option value="basic" data-m="1">Basic</option>
        <option value="pro" data-m="1.4">Pro</option>
        <option value="ultra" data-m="2">Ultra Pro</option>
      </select>

      <div id="dynamicAddons" class="dynamic-addons" style="margin-top:14px;"></div>

      <div style="margin-top:14px;">
        <button id="back1" class="btn-ghost">Back</button>
        <button id="next2" class="btn-ghost">Next</button>
      </div>
    </div>

    <!-- PANEL 3 -->
    <div class="step-panel" id="panel-3" style="display:none;">
      <h3>Review & Pay</h3>

      <div id="reviewBox" style="margin-bottom:14px;"></div>

      <!-- CLIENT CONTACTS (required) -->
      <label>Your Full Name</label>
      <input id="client_name" class="input-plain" placeholder="Name" required>

      <label style="margin-top:8px;">Email</label>
      <input id="client_email" type="email" class="input-plain" placeholder="you@example.com" required>

      <label style="margin-top:8px;">Phone</label>
      <input id="client_phone" class="input-plain" placeholder="+91 9xxxxxxxxx" required>

      <div style="margin-top:14px;">
        <button id="back2" class="btn-ghost">Back</button>
        <button id="payBtn" class="btn-primary">Pay Now</button>
      </div>
    </div>

  </div>

  <!-- RIGHT: summary -->
  <aside class="booking-side">
    <div class="summary-box">
      <h3>Booking Summary</h3>
      <div class="summary-row"><div>Experience</div><div id="s_exp">—</div></div>
      <div class="summary-row"><div>Camera</div><div id="s_cam">—</div></div>
      <div class="summary-row"><div>Drone</div><div id="s_dr">No</div></div>
      <div class="summary-row"><div>Travel (km)</div><div id="s_tr">0</div></div>
      <div class="summary-row"><div>Extra hours</div><div id="s_hr">0</div></div>
      <div class="summary-row"><div>Edited photos</div><div id="s_ph">0</div></div>
      <div class="total-row">Total: ₹<span id="totalPrice">0</span></div>
      <div style="font-size:13px;color:var(--muted);margin-top:8px;">Prices update live while you change options</div>
    </div>
  </aside>

</div>

<!-- scripts -->
<script>window.RAZORPAY_KEY = "<?php echo htmlspecialchars($razorpay_key, ENT_QUOTES); ?>";</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="js/booking.js"></script>

</body>
</html>
