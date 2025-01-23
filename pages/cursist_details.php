<?php
/** @var mysqli $db */
require_once 'includes/connection.php';
session_start();

$studentId = isset($_GET['cursist_id']) ? mysqli_real_escape_string($db, $_GET['cursist_id']) : null;

if (!$studentId || !is_numeric($studentId)) {
    echo "Invalid student ID.";
    exit();
}

$query = "SELECT * FROM cursisten WHERE cursist_id = $studentId";
$result = mysqli_query($db, $query);

if (!$result) {
    echo "Error: " . mysqli_error($db);
    exit();
}

$studentData = [];

while ($row = mysqli_fetch_assoc($result)) {
    $studentData[] = $row;
}

$reservationQuery = "SELECT c.first_name AS firstNameCursist, c.last_name AS lastNameCursist, 
    r.reservation_id AS reservation_id,
    r.phone_number AS phoneNumber, r.timeslot AS timeslot, 
    r.date AS date, cr.title AS courseName
FROM reservations r
RIGHT JOIN cursisten c ON r.cursist_id = c.cursist_id
RIGHT JOIN courses cr ON r.course_id = cr.course_id
WHERE c.cursist_id = $studentId";

$reservationResult = mysqli_query($db, $reservationQuery);

if (!$reservationResult) {
    echo "Error: " . mysqli_error($db);
    exit();
}

$reservationData = [];

while ($row = mysqli_fetch_assoc($reservationResult)) {
    $reservationData[] = $row;
}

mysqli_close($db);

if (!isset($studentId) || $studentId == "" || !is_numeric($studentId)) {
    header('Location: cursisten_overzicht.php');
}

if (isset($studentId)):
    ?>
    <!doctype html>
    <html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
        <link rel="stylesheet" href="includes/css/style.css">
        <link rel="icon" href="includes/images/pupp_darkGreen.png">
        <title>Cursist Details</title>
    </head>
    <body style="background-repeat: no-repeat; background-size: cover; background-image: url('includes/css/bg4.jpg');">
    <nav class="navbar">
        <div id="navbarBasic" class="navbar-menu px-6">
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
                <a href="cursisten_overzicht.php" class="navbar-item custom-margin"
                   style="background-color: #2CDB43; color: black;">
                    Cursisten
                </a>
                <a href="logout.php" class="navbar-item custom-margin">Log out</a>
            </div>
            <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
        </div>
    </nav>
    <main style="display: flex; gap: 0%; flex-direction: column">
        <a href="cursisten_overzicht.php"
           style="color: black; background-color: #23B136; height: 5%; margin-left: 3%; margin-top: 3%; width: 8%"
           class="button">Terug</a>
        <div style="display: flex; flex-direction: column; align-items: center">
            <h1 style="color: black; font-weight: bold; font-size: 2rem;"><?= $studentData[0]['first_name'] ?> <?= $studentData[0]['last_name'] ?></h1>
            <div style="width: 30%;">
                <img src="includes/images/<?= $studentData[0]['pfp'] ?>">
            </div>
            <h2 style="color: black; font-weight: bold; font-size: 1.5rem; margin-top: 5%;">Inschrijvingen</h2>
            <div class="inschrijvingen">
                <?php if (!empty($reservationData)): ?>
                    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                        <thead>
                        <tr>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2; font-weight: bold; color: black">Cursus</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2; font-weight: bold; color: black">Telefoonnummer</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2; font-weight: bold; color: black">Datum</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2; font-weight: bold; color: black">Tijd</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2; font-weight: bold; color: black">Verwijder</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($reservationData as $index => $reservation): ?>
                            <tr style="background-color: <?= $index % 2 == 0 ? '#f9f9f9' : 'transparent'; ?>;">
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;"><?= $reservation['courseName'] ?></td>
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;"><?= $reservation['phoneNumber'] ?></td>
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;"><?= $reservation['date'] ?></td>
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;"><?= $reservation['timeslot'] ?></td>
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;"><a href="delete_cursist_reservation.php?reservation_id=<?= $reservation['reservation_id'] ?>&cursist_id=<?= $studentId ?>">Verwijder</a></td>
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
    </footer>
    </body>
    </html>
<?php endif; ?>