<?php
/** @var mysqli $db */
require_once 'includes/connection.php';
session_start();

$studentId = $_GET['cursist_id'];

$query = "SELECT * FROM cursisten WHERE cursist_id=$studentId";

$result = mysqli_query($db, $query);

$studentData = [];

while ($row = mysqli_fetch_assoc($result)) {
    $studentData[] = $row;
}

$reservationQuery = "SELECT cursisten.first_name AS firstNameCursist, cursisten.last_name AS lastNameCursist,
    reservations.phone_number AS phoneNumber, reservations.timeslot AS timeslot, 
    reservations.date AS date, courses.title AS courseName
FROM reservations 
RIGHT JOIN cursisten ON reservations.cursist_id = cursisten.cursist_id
RIGHT JOIN courses ON reservations.course_id = courses.course_id
WHERE cursisten.cursist_id = $studentId";

$reservationResult = mysqli_query($db, $reservationQuery);

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
    <body>
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
            </div>
            <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
        </div>
    </nav>
    <main style="display: flex; gap: 0%;">
        <div class="column">
            <a href="cursisten_overzicht.php"
               style="color: black; background-color: #23B136;"
               class="button">Terug</a>
            <div class="">
                <h1 style="color: black; font-weight: bold; font-size: 2rem; margin-top: 5%;"
                    class="has-text-centered"><?= $studentData[0]['first_name'] ?> <?= $studentData[0]['last_name'] ?></h1>
                <div class="has-text-centered">
                    <img src="includes/images/<?= $studentData[0]['pfp'] ?>">
                </div>
            </div>
            <h2 style="color: black; font-weight: bold; font-size: 1.5rem; margin-top: 5%;" class="has-text-centered">
                Inschrijvingen</h2>
            <div class="inschrijvingen has-text-centered">
                <?php if (!empty($reservationData)): ?>
                    <table>
                        <thead>
                        <tr>
                            <th>Cursus</th>
                            <th>Telefoonnummer</th>
                            <th>Datum</th>
                            <th>Tijd</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($reservationData as $reservation): ?>
                            <tr>
                                <td><?= $reservation['courseName'] ?></td>
                                <td><?= $reservation['phoneNumber'] ?></td>
                                <td><?= $reservation['date'] ?></td>
                                <td><?= $reservation['timeslot'] ?></td>
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