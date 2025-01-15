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
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="includes/css/style.css">
    <title>Admin - Cursus overzicht - A Paw in Your Hand</title>
</head>
<body style="background-repeat: no-repeat; background-size: cover;">
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
            <a href="" class="navbar-item custom-margin">
                Cursisten
            </a>
        </div>
        <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
    </div>
</nav>
<main>
    <div style="margin-top: 3%;">
        <h1 style="margin-bottom: 3%; text-align: center; color: black; font-size: 2rem; font-weight: bold;">Cursus overzicht</h1>
    <?php if (isset($courses)):
        foreach ($courses as $course):?>
            <table style="color: black; margin-left: 2%; margin-right: 2%; margin-top: 0.5%; border-right: black solid 2px; border-left: black solid 2px;">
                <thead>
                <tr style="border-top: black solid 2px;">
                    <th></th>
                    <th style="color: var(--black);">Title</th>
                    <th style="color: var(--black);">info</th>
                </tr>
                </thead>
                <tfoot></tfoot>
                <tbody style="border-bottom: black solid 2px;">
                <tr>
                    <th><img src="includes/images/<?= $course['image'] ?>" alt="" width="100px"></th>
                    <td><?= $course['title'] ?></td>
                    <td><?= $course['short_info'] ?></td>
                    <th>
                        <a href="cursus_aanpassen.php?course_id=<?= $course['course_id'] ?>">
                            Aanpassen
                        </a>
                    </th>
                </tr>
                </tbody>
            </table>
        <?php
        endforeach;
    endif; ?>
        </div>
    <a href="cursus_toevoegen.php" style="margin-left: 2%;">+ Nieuwe cursus toevoegen</a>
</main>
<footer>
    <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
    <p class="column is-align-self-flex-end is-size-4 has-text-weight-semibold">A Paw in Your Hand</p>
    <a class="is-flex is-justify-content-right is-align-self-flex-end" href="reviews.php">Reviews</a>
</footer>
</body>
</html>
