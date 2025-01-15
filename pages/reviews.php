<?php
/** @var mysqli $db */
include_once "includes/connection.php";

$query = "SELECT * FROM reviews ";
$result = mysqli_query($db, $query)
or die('Error ' . mysqli_error($db) . ' with query ' . $query);

$reviews = [];

while ($row = mysqli_fetch_assoc($result)) {
    $reviews[] = $row;
}

mysqli_close($db);
?>
<!doctype html>
<html lang="nl" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reviews</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="includes/css/style.css">
</head>
<body>
<nav class="navbar">
    <div id="navbarBasic" class="navbar-menu px-6">
        <div class="navbar-start">
            <a href="index.php" class="navbar-item custom-margin">
                Home
            </a>
            <a href="reservering.php" class="navbar-item custom-margin">
                Inschrijven
            </a>
            <a href="gebruiker_cursus_overzicht.php" class="navbar-item custom-margin">
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
<main>
    <h1 class="is-flex is-size-2 is-justify-content-center has-text-weight-semibold pb-3">
        Reviews
    </h1>

    <?php foreach (array_chunk($reviews, 2) as $reviewPair) { ?>
        <section class="is-flex is-justify-content-space-evenly mt-0">
            <?php foreach ($reviewPair as $review) { ?>
                <div class="box box-last column is-5">
                    <h2 class="is-size-4"><?= htmlspecialchars($review['first_name'] . ' ' . $review['last_name']) ?></h2>
                    <p><?= htmlspecialchars($review['review']) ?></p>
                </div>
            <?php } ?>
        </section>
    <?php } ?>


    <a href="review_create.php" class="is-flex is-justify-content-right">Review schrijven</a>

</main>
<footer>
    <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
    <p class="column is-align-self-flex-end is-size-4 has-text-weight-semibold">A Paw in Your Hand</p>
    <a class="is-flex is-justify-content-right is-align-self-flex-end" href="reviews.php">Reviews</a>
</footer>
</body>
</html>