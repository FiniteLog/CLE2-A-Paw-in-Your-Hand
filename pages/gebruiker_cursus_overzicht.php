<?php
/** @var mysqli $db */
require_once 'includes/connection.php';
session_start();

$query = "SELECT * FROM courses";

$result = mysqli_query($db, $query)
or die ('Error ' . mysqli_error($db) . ' with query ' . $query);

$courses = [];

while ($row = mysqli_fetch_assoc($result)) {
    $courses[] = $row;
}

mysqli_close($db);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cursus aanbod - A Paw in Your Hand</title>
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
            <a href="gebruiker_cursus_overzicht.php" class="active navbar-item custom-margin" style="background-color: #2CDB43; color: black;">
                Cursussen
            </a>
            <a href="admin_login.php" class="navbar-item custom-margin">
                Admin Login
            </a>
            <a href="agenda.php" class="navbar-item custom-margin">
                Agenda
            </a>
        </div>
        <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
    </div>
</nav>
<main class="is-flex is-flex-direction-column is-align-items-center">
    <?php if (isset($courses)):
        foreach ($courses as $course):
            ?>
            <section class="columns is-centered is-variable is-8 mx-2 my-2"
                     style="border: black 2px solid; width: 70%;">
                <img src="includes/images/<?= $course['image'] ?>" alt="image" style="width: 40%; margin: 1%;">
                <div class="column is-flex is-flex-direction-column p-4">
                    <h1 class="has-text-weight-bold" style="font-size: 1.2rem;"><?= $course['title'] ?></h1>
                    <div class="article-container">
                        <p><?= $course['short_info'] ?></p>
                    </div>
                    <div class="is-flex is-justify-content-flex-end mt-auto">
                        <a href="cursus_details.php?course_id=<?= $course['course_id'] ?>" class="button custom-button">Details</a>
                    </div>
                </div>
            </section>
        <?php
        endforeach;
    endif;
    ?>
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