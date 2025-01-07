<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "CLE2";

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: " . mysqli_connect_error());;

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
</head>
<body>
<nav class="navbar is-primary">
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item">
                Home
            </a>

            <a class="navbar-item">
                Inschrijven
            </a>

            <a class="navbar-item">
                Cursussen
            </a>

        </div>
    </div>
</nav>
<header></header>
<main>
    <?php if (isset($courses)):

        foreach ($courses as $course):
            ?>
            <section class="course-container mx-2 my-2">
                <h1><?= $course['title'] ?></h1>
                <p><?= $course['short_info'] ?></p>
                <div class="image is-128x128">
                    <img src="/includes/images/<?= $course['image'] ?>" alt="image">
                </div>
                <a href="#">Details</a>
            </section>
        <?php
        endforeach;
    endif;
    ?>

</main>
<footer></footer>
</body>
</html>
