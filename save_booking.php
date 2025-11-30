<?php
// save_booking.php
header('Content-Type: text/plain; charset=utf-8');
session_start();
include "db.php"; // must define $conn

function post($k,$d=null){ return isset($_POST[$k])?trim($_POST[$k]):$d; }

$name = post('name','');
$email = post('email','');
$phone = post('phone','');
$experience = post('experience','');
$camera = strtolower(post('camera','basic'));
$payment_id = post('payment_id', null);

// Add-ons (checkboxes and numbers)
$drone = (post('drone','0') === '1') ? 1 : 0;
$makeup = (post('makeup','0') === '1') ? 1 : 0;
$jeep = (post('jeep','0') === '1') ? 1 : 0;
$travel = intval(post('travel', 0));
$hours = intval(post('hours', 0));
$photos = intval(post('photos', 0));

// Basic validation
if ($name==='' || $email==='' || $phone==='' || $experience==='') {
    echo "error: missing required fields";
    exit;
}

// Server-side price calc (mirror of client)
$basePrices = ['wildlife'=>5000,'prewedding'=>8000,'baby'=>4000,'fashion'=>7000,'event'=>6000];
$cameraMultiplier = ['basic'=>1.0,'pro'=>1.4,'ultra'=>2.0];
$addonPrices = ['drone'=>1500,'makeup'=>2000,'jeep'=>1200,'travel_per_km'=>20,'extra_hour'=>800,'per_photo'=>50,'premium_lighting'=>2500,'premium_edit'=>1500];

$base = $basePrices[strtolower($experience)] ?? 0;
$mult = $cameraMultiplier[$camera] ?? 1.0;
$total = $base * $mult;
if ($drone) $total += $addonPrices['drone'];
if ($makeup) $total += $addonPrices['makeup'];
if ($jeep) $total += $addonPrices['jeep'];
if ($travel>0) $total += $travel * $addonPrices['travel_per_km'];
if ($hours>0) $total += $hours * $addonPrices['extra_hour'];
if ($photos>0) $total += $photos * $addonPrices['per_photo'];

// extras if sent
$premium_lighting = (post('premium_lighting','0') === '1')?1:0;
$premium_edit = (post('premium_edit','0') === '1')?1:0;
if ($premium_lighting) $total += $addonPrices['premium_lighting'];
if ($premium_edit) $total += $addonPrices['premium_edit'];

$addons = json_encode(['drone'=>$drone,'makeup'=>$makeup,'jeep'=>$jeep,'premium_lighting'=>$premium_lighting,'premium_edit'=>$premium_edit], JSON_UNESCAPED_UNICODE);
$category_details = json_encode(['edited_photos'=>$photos], JSON_UNESCAPED_UNICODE);

$client_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : null;
$payment_status = ($payment_id && strlen($payment_id)>0) ? 'paid' : 'pending';

// Insert with prepared statement
$sql = "INSERT INTO bookings (client_id, name, email, phone, experience, category_details, addons, package_choice, camera_setup, drone, makeup, travel_km, extra_hours, edited_photos, price_total, payment_status, payment_id, created_at)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);
if (!$stmt) { echo "error: prepare failed"; exit; }

$client_param = $client_id ? $client_id : NULL;

$bind = $stmt->bind_param(
    "issssssiiiiiidsis",
    $client_param,
    $name,
    $email,
    $phone,
    $experience,
    $category_details,
    $addons,
    $camera,
    $camera,    // camera_setup stored as string, kept for column order (string expected) - we pass again, adjust below
    $drone,
    $makeup,
    $travel,
    $hours,
    $photos,
    $total,
    $payment_status,
    $payment_id
);

// Note: if your DB schema types differ adjust bind types accordingly.
if (!$bind) { echo "error: bind failed"; exit; }

$exec = $stmt->execute();
if ($exec) echo "success";
else echo "error: db insert failed";

$stmt->close();
$conn->close();
