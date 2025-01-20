<?php
/** @var mysqli $db */
require_once 'includes/connection.php';

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $review = $_POST['review'];
    $email = $_POST['email'];
    $rating = $_POST['rating'];


    $errors = [];


    if ($first_name == '') {
        $errors['first_name'] = 'Voornaam vereist.';
    }
    if ($last_name == '') {
        $errors['last_name'] = 'Achternaam vereist.';
    }
    if ($review == '') {
        $errors['review'] = 'Review vereist.';
    }
    if ($email == '') {
        $errors['email'] = 'E-mail vereist.';
    }
    if (!isset($_POST['rating']) || $_POST['rating'] < 1 || $_POST['rating'] > 5) {
        $errors['rating'] = "Select a valid rating between 1 and 5.";
    }


    if (empty($errors)) {
        $query = "INSERT INTO reviews (first_name, last_name, review, email, rating) 
                    VALUES  ('$first_name', '$last_name', '$review', '$email', '$rating')";
        mysqli_query($db, $query);
        mysqli_close($db);
    }
}
?>
<!doctype html>
<html lang="nl" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Review create</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="includes/css/style.css">
    <link rel="icon" href="includes/images/pupp_darkGreen.png">
</head>
<body>
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
            <a href="agenda.php" class="navbar-item custom-margin">
                Agenda
            </a>
            <a href="reviews.php" class="navbar-item custom-margin" style="background-color: #2CDB43; color: black;">
                Reviews
            </a>
        </div>
        <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">

    </div>
</nav>
<main>
    <h1 class="is-flex is-size-2 is-justify-content-center has-text-weight-semibold pb-3">
        Review schrijven
    </h1>
    <form class="mx-6" method="POST">

        <label class="is-flex is-justify-content-center is-size-3 mb-3">Rating</label>
        <div class="columns is-centered">
            <div class="rating-container">
                <!-- Star Rating Input -->
                <input type="radio" id="star5" name="rating" value="5">
                <label for="star5" title="5 stars">★</label>

                <input type="radio" id="star4" name="rating" value="4">
                <label for="star4" title="4 stars">★</label>

                <input type="radio" id="star3" name="rating" value="3">
                <label for="star3" title="3 stars">★</label>

                <input type="radio" id="star2" name="rating" value="2">
                <label for="star2" title="2 stars">★</label>

                <input type="radio" id="star1" name="rating" value="1">
                <label for="star1" title="1 star">★</label>
            </div>
        </div>
        <p class="help is-danger">
            <?= $errors['rating'] ?? '' ?>
        </p>

        <label class="is-flex is-justify-content-center is-size-3 mb-3">Voornaam</label>
        <div class="columns is-centered">
            <input type="text" class="box is-size-6  column is-4" name="first_name" id="first_name">
        </div>
        <p class="help is-danger">
            <?= $errors['first_name'] ?? '' ?>
        </p>

        <label class="is-flex is-justify-content-center is-size-3 mb-3">Achternaam</label>
        <div class="columns is-centered">
            <input type="text" class="box is-size-6 column is-4" name="last_name" id="last_name">
        </div>
        <p class="help is-danger">
            <?= $errors['last_name'] ?? '' ?>
        </p>

        <label class="is-flex is-justify-content-center is-size-3 mb-3">Review</label>
        <div class="columns is-centered control">
            <textarea class="box is-size-6 column is-5" rows="5" maxlength="400"
                      placeholder="Maximaal 400 characters" name="review" id="review"></textarea>
        </div>
        <p class="help is-danger">
            <?= $errors['review'] ?? '' ?>
        </p>

        <label class="is-flex is-justify-content-center is-size-3 mb-3">E-mail</label>
        <div class="columns is-centered is-3">
            <input type="email" class="box is-size-6 column is-4 has-fixed-size" name="email" id="email"
            ><br>
        </div>
        <p class="help is-danger">
            <?= $errors['email'] ?? '' ?>
        </p>

        <div class="columns is-centered">
            <button class="button is-link" type="submit" name="submit"> Submit</button>
        </div>

    </form>
    <a href="reviews.php" class="is-flex is-justify-content-right">Terug</a>
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