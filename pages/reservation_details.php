@ -1,88 +1,277 @@
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
<html lang="nl" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inschrijven voor cursus - A Paw in Your Hand</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="includes/css/style.css">
    <link rel="icon" href="includes/images/pupp_darkGreen.png">
</head>
<body style="background-repeat: no-repeat; background-size: cover; background-image: url('includes/css/bg4.jpg');">
<nav class="navbar">
    <div id="navbarBasic" class="navbar-menu px-6">
        <div class="navbar-start">
            <a href="index.php" class="navbar-item custom-margin">
                Home
            </a>
            <a href="agenda.php" class="navbar-item custom-margin" style="background-color: #2CDB43; color: black;">
                Agenda
            </a>
            <a href="admin_cursus_overzicht.php" class="navbar-item custom-margin">
                Cursusoverzicht
            </a>
            <a href="cursisten_overzicht.php" class="navbar-item custom-margin">
                Cursisten
            </a>
            <a href="logout.php" class="navbar-item custom-margin">Log out</a>
        </div>
        <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
    </div>
</nav>
<main class="">
    <div class="box">
        <h1 class="title">Reservation Details</h1>
        <p><strong>Course:</strong> <?= htmlspecialchars($reservation['title']) ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($reservation['date']) ?></p>
        <p><strong>Time:</strong> <?= htmlspecialchars($reservation['timeslot_info']) ?></p>
        <p><strong>Client Name:</strong> <?= htmlspecialchars($reservation['name']) ?></p>
        <p><strong>Dog Amount:</strong> <?= htmlspecialchars($reservation['dog_amount']) ?></p>
        <p><strong>Phone Number:</strong> <?= htmlspecialchars($reservation['phone_number']) ?></p>
        <p><strong>Question:</strong> <?= htmlspecialchars($reservation['question']) ?></p>
    </div>
</main>
<footer>
    <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
    <p class="column is-align-self-flex-end is-size-4 has-text-weight-semibold">A Paw in Your Hand</p>
    <a class="is-flex is-justify-content-right is-align-self-flex-end" href="reviews.php">Reviews</a>
    <div style="display: flex; flex-flow: column; margin-top: 2%; margin-right: 3%;">
        <a href="mailto:email@example.com"
           style="color: black; text-decoration: underline;">emaillesgevende@email.com</a>
        <p>+31 6 12345678</p>
    </div>
</footer>
</body>
</html>