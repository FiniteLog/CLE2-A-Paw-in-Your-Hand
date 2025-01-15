<?php

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
        Review schrijven
    </h1>
    <form class="mx-6">
        <label class="is-flex is-justify-content-center is-size-3 mb-3">Naam</label>
        <div class="columns is-centered">
            <input type="text" class="box is-size-6  column is-4">
        </div>
        <label class="is-flex is-justify-content-center is-size-3 mb-3">Review</label>
        <div class="columns is-centered control">
            <textarea class="box is-size-6 column is-5"></textarea>
        </div>
        <label class="is-flex is-justify-content-center is-size-3 mb-3">E-mail</label>
        <div class="columns is-centered is-3    ">
            <input type="email" class="box is-size-6 column is-4 has-fixed-size"><br>
        </div>
        <div class="columns is-centered">
            <button class="is-link button">Submit</button>
        </div>
    </form>
    <a href="reviews.php" class="is-flex is-justify-content-right">Terug</a>
</main>
<footer>
    <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
    <p class="column is-align-self-flex-end is-size-4 has-text-weight-semibold">A Paw in Your Hand</p>
</footer>
</body>
</html>