<?php

$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "CLE2";

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: " . mysqli_connect_error());

$query = "SELECT * FROM courses";

$result = mysqli_query($db, $query)
or die ('Errror ' . mysqli_error($db) . ' with query ' . $query);

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
    <title>Hello Bulma!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="/CSS/style.css">
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
<main class="is-flex is-flex-direction-column is-align-items-center">
    <?php if (isset($courses)):
        foreach ($courses as $course):
            ?>
            <section class="box custom-box columns is-centered is-variable is-8 mx-2 my-2">
                <div class="column is-narrow">
                    <img src="includes/images/<?= $course['image'] ?>" alt="image" class="image is-128x128">
                </div>
                <div class="column is-flex is-flex-direction-column p-4">
                    <h1 class="has-text-weight-bold"><?= $course['title'] ?></h1>
                    <div class="article-container">
                        <p><?= $course['short_info'] ?></p>
                    </div>
                    <div class="is-flex is-justify-content-flex-end mt-auto">
                        <a href="cursus_info.php?course_id=<?= $course['course_id']?>" class="button custom-button">Details</a>
                    </div>
                </div>
            </section>
        <?php
        endforeach;
    endif;
    ?>
</main>
<footer class=" bg-footer-top pt-5">
    <div class="bg-footer columns">
        <img src="includes/images/pupp_darkGreen.png" width="100px">
        <p class="column is-align-self-flex-end is-size-3 has-text-weight-semibold">A Paw in Your Hand</p>
    </div>
</footer>
</body>
</html>
