<?php
/** @var mysqli $db */
require_once 'includes/connection.php';
session_start();

$courseId = $_GET['course_id'];

$query = "SELECT * FROM courses WHERE course_id=$courseId";

$result = mysqli_query($db, $query);

$courseData = [];

while ($row = mysqli_fetch_assoc($result)) {
    $courseData[] = $row;
}

mysqli_close($db);

if (!isset($courseId) || $courseId == "" || !is_numeric($courseId)) {
    header('Location: gebruiker_cursus_overzicht.php'); //keep an eye on if this is still correct later
}

if (isset($courseData)):
    ?>
    <!doctype html>
    <html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $courseData[0]['title'] ?> - A Paw in Your Hand</title>
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
                <a href="reservering.php" class="navbar-item custom-margin">
                    Inschrijven
                </a>
                <a href="gebruiker_cursus_overzicht.php" class="navbar-item custom-margin" style="background-color: #2CDB43; color: black;">
                    Cursussen
                </a>
                <a href="admin_login.php" class="navbar-item custom-margin">
                    Admin Login
                </a>
                <a href="agenda.php" class="navbar-item custom-margin">
                    Agenda
                </a>
                <a href="reviews.php" class="navbar-item custom-margin">
                    Reviews
                </a>
            </div>
            <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">

        </div>
    </nav>
    <main>
        <div class="column is-flex is-justify-content-center">
            <img src="includes/images/<?= $courseData[0]['image'] ?>" alt="<?= $courseData[0]['image'] ?>"
                 class="image is-16by12" width="250px">
        </div>
        <div>
            <h1 class="has-text-centered has-text-weight-bold"
                style="color: black; font-size: 1.5rem;"><?= $courseData[0]['title'] ?></h1>
        </div>
        <div class="information_div">
            <p class="information"
               style="color: black; margin: 4%; margin-bottom: 2%; margin-top: 2%;"><?= $courseData[0]['info'] ?></p>
        </div>
        <div class="is-flex is-justify-content-flex-end" style="margin-right: 10%; margin-bottom: 2%">
            <a href="reservering.php" class="sign-up-btn button custom-button">Inschrijven</a>
        </div>
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
<?php endif; ?>