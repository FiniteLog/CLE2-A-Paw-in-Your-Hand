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
        <a href="cursisten_overzicht.php"
           style="color: black; background-color: #23B136; height: 5%; margin-left: 3%; margin-top: 3%;" class="button">Terug</a>
        <div>
            <div style="display: flex; flex-flow: column; margin-left: 45%">
                <h1 style="color: black; font-weight: bold; font-size: 2rem; margin-top: 5%;"><?= $studentData[0]['first_name'] ?> <?= $studentData[0]['last_name'] ?></h1>
                <div style="width: 30%; margin-left: 15%;">
                    <img src="includes/images/<?= $studentData[0]['pfp'] ?>">
                </div>
            </div>
            <h2 style="color: black; font-weight: bold; font-size: 1.5rem; margin-top: 5%;">Inschrijvingen</h2>
            <div class="inschrijvingen">
                <!--Put table here-->
                <p>[ Gebruiker heeft nog geen inschrijvingen ] </p>
            </div>
        </div>
    </main>
    <footer>
        <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
        <p class="column is-align-self-flex-end is-size-4 has-text-weight-semibold">A Paw in Your Hand</p>
        <div style="display: flex; flex-flow: column; margin-top: 2%; margin-right: 3%;">
            <a href="mailto:email@example.com" style="color: black; text-decoration: underline;">emaillesgevende@email.com</a>
            <p>+31 6 12345678</p>
        </div>
    </footer>
    </body>
    </html>

<?php endif; ?>