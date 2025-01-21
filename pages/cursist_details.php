<?php
/** @var mysqli $db */
require_once 'includes/connection.php';
session_start();

$cursist_id = $_GET['cursist_id'];

if (!isset($cursist_id) || $cursist_id == "" || !is_numeric($cursist_id)) {
    header('Location: cursisten_overzicht.php');
    exit;
}

// Fetch cursist details
$query = "SELECT * FROM cursisten WHERE cursist_id='$cursist_id'";
$result = mysqli_query($db, $query);
$cursistData = mysqli_fetch_assoc($result);

// Fetch reservations for this cursist
$reservationQuery = "
    SELECT r.*, c.title AS course_title, t.timeslot_info 
    FROM reservations r
    LEFT JOIN courses c ON r.course_id = c.course_id
    LEFT JOIN timeslots t ON r.timeslot = t.timeslot_id
    WHERE r.cursist_id = '$cursist_id'
";
$reservationResult = mysqli_query($db, $reservationQuery);
$reservations = [];

while ($row = mysqli_fetch_assoc($reservationResult)) {
    $reservations[] = $row;
}

mysqli_close($db);
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="includes/css/style.css">
    <link rel="icon" href="includes/images/pupp_darkGreen.png">
    <title>Cursist Details</title>
</head>
<body>
<nav class="navbar">
    <div id="navbarBasic" class="navbar-menu px-6">
        <div class="navbar-start">
            <a href="index.php" class="navbar-item custom-margin">Home</a>
            <a href="agenda.php" class="navbar-item custom-margin">Agenda</a>
            <a href="admin_cursus_overzicht.php" class="navbar-item custom-margin">Cursusoverzicht</a>
            <a href="cursisten_overzicht.php" class="navbar-item custom-margin"
               style="background-color: #2CDB43; color: black;">
                Cursisten
            </a>
        </div>
        <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
    </div>
</nav>
<main style="display: flex; gap: 0%;">
    <a href="cursisten_overzicht.php"
       style="color: black; background-color: #23B136; height: 5%; margin-left: 3%; margin-top: 3%;" class="button">Terug</a>
    <div>
        <div style="display: flex; flex-flow: column; margin-left: 45%">
            <h1 style="color: black; font-weight: bold; font-size: 2rem; margin-top: 5%;"><?= $cursistData['first_name'] ?> <?= $cursistData['last_name'] ?></h1>
            <div style="width: 30%; margin-left: 15%;">
                <img src="includes/images/<?= $cursistData['pfp'] ?>">
            </div>
        </div>
        <h2 style="color: black; font-weight: bold; font-size: 1.5rem; margin-top: 5%;">Inschrijvingen</h2>
        <div class="inschrijvingen">
            <?php if (count($reservations) > 0): ?>
                <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Datum</th>
                        <th>Tijdslot</th>
                        <th>Cursus</th>
                        <th>Vragen</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($reservations as $index => $reservation): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlentities($reservation['date']) ?></td>
                            <td><?= htmlentities($reservation['timeslot_info']) ?></td>
                            <td><?= htmlentities($reservation['course_title']) ?></td>
                            <td><?= htmlentities($reservation['question']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>[ Gebruiker heeft nog geen inschrijvingen ]</p>
            <?php endif; ?>
        </div>
    </div>
</main>
<footer>
    <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
    <p class="column is-align-self-flex-end is-size-4 has-text-weight-semibold">A Paw in Your Hand</p>
    <div style="display: flex; flex-flow: column; margin-top: 2%; margin-right: 3%;">
        <a href="mailto:email@example.com"
           style="color: black; text-decoration: underline;">emaillesgevende@email.com</a>
        <p>+31 6 12345678</p>
    </div>
</footer>
</body>
</html>