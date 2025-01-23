<?php
/** @var mysqli $db */
include_once "includes/connection.php";

$query = "SELECT * FROM reviews";
$result = mysqli_query($db, $query)
or die('Error ' . mysqli_error($db) . ' with query ' . $query);

$reviews = [];
while ($row = mysqli_fetch_assoc($result)) {
    $reviews[] = $row;
}

mysqli_close($db);

// Calculate average rating
$totalReviews = count($reviews);
$totalRating = array_sum(array_column($reviews, 'rating'));
$averageRating = $totalReviews > 0 ? round($totalRating / $totalReviews, 1) : 0;

// Calculate the percentage for the average rating
$averagePercentage = ($averageRating / 5) * 100;
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
    <link rel="icon" href="includes/images/pupp_darkGreen.png">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            const width = $(".progress-bar").attr("data-percentage");
            $(".progress-bar").css("width", "0%");
            $(".progress-bar").animate({width: width + "%"}, 1000);
        });
    </script>
</head>
<body style="background-repeat: no-repeat; background-size: cover; background-image: url('includes/css/bg4.jpg');">
<nav class="navbar">
    <div id="navbarBasic" class="navbar-menu px-6">
        <div class="navbar-start">
            <a href="index.php" class="navbar-item custom-margin"">
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
            <a href="reviews.php" class="navbar-item custom-margin" style="background-color: #2CDB43; color: black;">
                Reviews
            </a>
            <a href="create_profile.php" class="navbar-item custom-margin">
                Registreer
            </a>
            <a href="logout.php" class="navbar-item custom-margin">Log out</a>
        </div>
        <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">

    </div>
</nav>
<main>
    <h1 class="is-flex is-size-2 is-justify-content-center has-text-weight-semibold pb-3">
        Reviews
    </h1>

    <section class="rating-container">
        <div class="average-rating-box">
            <h2 class="is-size-4">Gemiddelde beoordeling: <?= $averageRating ?> / 5</h2>
            <div class="progress-bar-border"
                 style="width: 100%; height: 20px; background-color: #ddd; border-radius: 10px;">
                <div class="progress-bar" data-percentage="<?= $averagePercentage ?>" style="
                        width: <?= $averagePercentage ?>%;
                        height: 100%;
                        background-color: #4CAF50;
                        border-radius: 10px;">
                    <span style="color: white; font-weight: bold;"><?= $averagePercentage ?>%</span>
                </div>
            </div>
        </div>
    </section>

    <?php foreach (array_chunk($reviews, 2) as $reviewPair) { ?>
        <section class="is-flex is-justify-content-space-evenly mt-0">
            <?php foreach ($reviewPair as $review) { ?>
                <div class="box box-last column is-5">
                    <div class="stars" style="color: gold; font-size: 1.5em;">
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            echo $i <= intval($review['rating']) ? '★' : '☆';
                        }
                        ?>
                    </div>
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
    <div style="display: flex; flex-flow: column; margin-top: 2%; margin-right: 3%;">
        <a href="mailto:email@example.com"
           style="color: black; text-decoration: underline;">emaillesgevende@email.com</a>
        <p>+31 6 12345678</p>
    </div>
</footer>
</body>
</html>
