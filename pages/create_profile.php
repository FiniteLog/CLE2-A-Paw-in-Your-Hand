<?php
/** @var mysqli $db */
require_once 'includes/connection.php';

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone_number = $_POST['phone_number'];

    $errors = [];

    if ($first_name == '') {
        $errors['first_name'] = 'Voornaam vereist.';
    }
    if ($last_name == '') {
        $errors['last_name'] = 'Achternaam vereist.';
    }
    if ($email == '') {
        $errors['email'] = 'E-mail vereist.';
    }
    if ($password == '') {
        $errors['password'] = 'Wachtwoord vereist.';
    }
    if ($phone_number == '') {
        $errors['phone_number'] = 'Telefoonnummer vereist.';
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO cursisten (first_name, last_name, email, password, phone_number) 
                    VALUES  ('$first_name', '$last_name', '$email', '$hashed_password','$phone_number')";
        mysqli_query($db, $query);
        mysqli_close($db);
        header('location: login.php');
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create profile - A Paw in Your Hand</title>
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
        Account aanmaken
    </h1>
    <form class="mx-6" method="POST">


        <label class="is-flex is-justify-content-center is-size-3 mb-3">Voornaam</label>
        <div class="columns is-centered">
            <input type="text" class="custom-box is-size-6  column is-4" name="first_name" id="first_name">
        </div>
        <p class="help is-danger">
            <?= $errors['first_name'] ?? '' ?>
        </p>

        <label class="is-flex is-justify-content-center is-size-3 mb-3">Achternaam</label>
        <div class="columns is-centered">
            <input type="text" class="custom-box is-size-6 column is-4" name="last_name" id="last_name">
        </div>
        <p class="help is-danger">
            <?= $errors['last_name'] ?? '' ?>
        </p>
        <label class="is-flex is-justify-content-center is-size-3 mb-3">E-mail</label>
        <div class="columns is-centered">
            <input type="email" class="custom-box is-size-6 column is-4" name="email" id="email">
        </div>
        <p class="help is-danger">
            <?= $errors['email'] ?? '' ?>
        </p>
        <label class="is-flex is-justify-content-center is-size-3 mb-3">Telefoonnummer</label>
        <div class="columns is-centered">
            <input type="number" class="custom-box is-size-6 column is-4" name="phone_number" id="phone_number">
        </div>
        <p class="help is-danger">
            <?= $errors['phone_number'] ?? '' ?>
        </p>
        <label class="is-flex is-justify-content-center is-size-3 mb-3">Wachtwoord</label>
        <div class="columns is-centered is-3">
            <input type="password" class="custom-box is-size-6 column is-4 has-fixed-size" name="password"
                   id="password">
        </div>
        <p class="help is-danger">
            <?= $errors['password'] ?? '' ?>
        </p>
        <br>
        <div class="columns is-centered mb-6">
            <button class="button is-link" type="submit" name="submit"> Create</button>
        </div>
    </form>
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