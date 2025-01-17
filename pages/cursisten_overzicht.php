<?php
/** @var mysqli $db */
require_once 'includes/connection.php';
session_start();

$query = "SELECT * FROM cursisten";

$result = mysqli_query($db, $query)
or die('Error' . mysqli_error($db) . 'with query' . $query);

$students = [];

while ($row = mysqli_fetch_assoc($result)) {
    $students[] = $row;
}

mysqli_close($db);
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
    <title>Cursisten overzicht</title>
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
            <a href="cursisten_overzicht.php" class="navbar-item custom-margin" style="background-color: #2CDB43; color: black;">
                Cursisten
            </a>
        </div>
        <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
    </div>
</nav>
<main>
    <div style="margin-top: 3%;">
        <h1 style="margin-left: 10%; margin-top: 8%; color: black; font-size: 1.8rem; font-weight: bold;">Cursisten</h1>

        <table style="color: black; margin-left: auto; margin-right: auto; margin-top: 0.5%; border-right: black solid 2px; border-left: black solid 2px; width: 60vw;">
        <thead>
        <tr style="border-top: black solid 2px;">
            <th></th>
            <th style="color: var(--black); padding: .2%;">Voornaam</th>
            <th style="color: var(--black); padding: .2%;">Achternaam</th>
            <th></th>
            <th style="color: var(--black); padding: .2%;">Contact info</th>
        </tr>
        </thead>

        <tbody style="border-bottom: black solid 2px; border-top: black solid 2px;">
        <?php if(isset($students)):
        foreach ($students as $student):?>
        <tr style="border-bottom: black solid 2px;" class="student-container">
            <th style="padding: 1%; width: 4%; height: 10%;"><img src="includes/images/<?= $student['pfp'] ?>" alt="Pfp"></th>
            <td style="padding: 1%; width: 10%"><?= $student['first_name'] ?></td>
            <td style="padding: 1%; width: 10%"><?= $student['last_name'] ?></td>
            <td style="width: 9%;"></td>
            <td style="padding: 1%; width: 10%"><?= $student['email'] ?></td>
            <th style="padding: 1%; width: 5%">
                <a href="cursist_details.php?cursist_id=<?= $student['cursist_id'] ?>" class="button" style="font-size: 0.8rem; margin: 0%; background-color: #23B136; color: black; border: black 1px solid;">
                    Inschrijvingen
                </a>
            </th>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php endif; ?>
</main>
<footer>
    <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
    <p class="column is-align-self-flex-end is-size-4 has-text-weight-semibold">A Paw in Your Hand</p>
    <a class="is-flex is-justify-content-right is-align-self-flex-end" href="reviews.php">Reviews</a>
    <div style="display: flex; flex-flow: column; margin-top: 2%; margin-right: 3%;">
        <a href="mailto:email@example.com" style="color: black; text-decoration: underline;">emaillesgevende@email.com</a>
        <p>+31 6 12345678</p>
    </div>
</footer>
</body>
</html>
