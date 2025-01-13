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

if (!isset($courseId) || $courseId == "" || is_numeric($courseId)) {
    header('Location: cursus.php'); //keep an eye on if this is still correct later
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
        <title><?= $courseData[0]['title'] ?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
        <link rel="stylesheet" href="includes/css/style.css">
    </head>
    <body>
    <nav class="navbar">
        <div id="navbarBasic" class="navbar-menu p-5">
            <div class="navbar-start">
                <a href="index.php" class="navbar-item custom-margin">
                    Home
                </a>
                <a href="reservering.php" class="navbar-item custom-margin">
                    Inschrijven
                </a>
                <a href="cursus.php" class="navbar-item custom-margin">
                    Cursussen
                </a>
            </div>
            <div class="navbar-end">
                <div class="navbar-image">
                    <img src="includes/images/pupp_darkGreen.png" height="100px">
                </div>
            </div>
        </div>
    </nav>
    <main>
        <div class="column is-flex is-justify-content-center">
            <img src="includes/images/<?= $courseData[0]['image'] ?>" alt="<?= $courseData[0]['image'] ?>" class="image is-16by9" width="250px">
        </div>
        <div class="column is-flex is-justify-content-center my-3">
            <h1 class="has-text-centered has-text-weight-bold"><?= $courseData[0]['title'] ?></h1>
        </div>
        <div class="column is-flex is-justify-content-center m-3">
            <p class="has-text-centered custom-paragraph"><?= $courseData[0]['info'] ?></p>
        </div>
        <div class="is-flex is-justify-content-flex-end mt-auto p-4">
            <a href="reservering.php" class="button custom-button">Inschrijven</a>
        </div>
    </main>
    <footer class="bg-footer-top pt-5">
        <div class="bg-footer columns">
            <img src="includes/images/pupp_darkGreen.png" width="100px">
            <p class="column is-align-self-flex-end is-size-3 has-text-weight-semibold">A Paw in Your Hand</p>
        </div>
    </footer>
    </body>
    </html>
<?php endif; ?>