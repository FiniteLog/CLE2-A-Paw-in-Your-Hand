<?php
/** @var mysqli $db */
require_once 'includes/connection.php';
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit;
}

// Get admin data from the SESSION
$admin = $_SESSION['admin'];
$name = $admin['username'];

if (!isset($_GET['id'])) {
    die('Reservation ID is required.');
}

$reservationId = intval($_GET['id']);

// Updated query to join the timeslots table and retrieve timeslot_info
$query = "
    SELECT reservations.*, courses.title, timeslots.timeslot_info
    FROM reservations
    JOIN courses ON reservations.course_id = courses.course_id
    JOIN timeslots ON reservations.timeslot = timeslots.timeslot_id
    WHERE reservations.reservation_id = $reservationId
";

$result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db) . ' with query ' . $query);

$reservation = mysqli_fetch_assoc($result);
if (!$reservation) {
    die('Reservation not found.');
}

mysqli_close($db);
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Detail</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="includes/css/style.css">
</head>
<body style="background-repeat: no-repeat; background-size: cover;">
<nav class="navbar">
    <div id="navbarBasic" class="navbar-menu p-5">
        <div class="navbar-start">
            <a href="index.php" class="navbar-item custom-margin">
                Home
            </a>
            <a href="agenda.php" class="navbar-item custom-margin">
                Agenda
            </a>
            <a href="admin_cursus_overzicht.php" class="navbar-item custom-margin">
                Cursusoverzicht
            </a>
            <a href="" class="navbar-item custom-margin">
                Cursisten
            </a>
        </div>
        <div class="navbar-end">
            <div class="navbar-image">
                <img src="includes/images/pupp_darkGreen.png" height="100px">
            </div>
        </div>
    </div>
</nav>
<main class="m-6">
    <div class="box">
        <h1 class="title">Reservation Details</h1>
        <p><strong>Course:</strong> <?= htmlspecialchars($reservation['title']) ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($reservation['date']) ?></p>
        <p><strong>Time:</strong> <?= htmlspecialchars($reservation['timeslot_info']) ?></p> <!-- Updated field -->
        <p><strong>Client Name:</strong> <?= htmlspecialchars($reservation['name']) ?></p>
        <p><strong>Dog Amount:</strong> <?= htmlspecialchars($reservation['dog_amount']) ?></p>
        <p><strong>Phone Number:</strong> <?= htmlspecialchars($reservation['phone_number']) ?></p>
        <p><strong>Question:</strong> <?= htmlspecialchars($reservation['question']) ?></p>
    </div>
</main>
</body>
</html>
