<?php
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="/CSS/style.css">
    <title>Nieuwe cursus</title>
</head>
<body>
<nav class="navbar">
    <div id="navbarBasic" class="navbar-menu my-5 mx-5">
        <div class="navbar-start">
            <a class="navbar-item">
                Agenda
            </a>
            <a class="navbar-item">
                Cursussen overzicht
            </a>
        </div>
        <div class="navbar-end">
            <div class="navbar-item">
                <img src="includes/images/pupp_darkGreen.png" height="100"> <!--Ik mis een unit bij de 100 - image is nu ook heel klein-->
            </div>
        </div>
    </div>
</nav>
<main>
    <body style="background-image: url('includes/images/bg1.png'); background-repeat: no-repeat; background-size: cover;">
    <div style="background-color: white; width: 75%; margin-left: 8vw; height: 100vh; margin-top: -2.5vh; padding: 5%;">
        <h2>Cursus toevoegen</h2>
        <a href="admin_cursus_overzicht.php">Terug</a> <!--history.back()-->
        <br>
        <br>
        <form action="" method="post" style="display: flex; flex-flow: column; ">
            <label for="title">Titel</label>
            <input type="text" value="" id="title" name="title" style="width: 15vw;">
            <br>
            <label for="short_info">Pop-up informatie</label>
            <textarea id="short_info" name="short_info" style="height: 50px; padding: 1%; width: 40vw;"></textarea>
            <br>
            <label for="info">Informatie</label>
            <textarea id="info" name="info" style="height: 150px; padding: 1%;"></textarea>
            <br>
            <input type="submit" name="submit" value="toevoegen" style="width: 10vw; height: 5vh;">
        </form>
    </div>
</main>
<footer class=" bg-footer-top pt-5">
    <div class="bg-footer columns">
        <img src="/pages/includes/images/pupp_darkGreen.png" width="100">
        <p class="column is-align-self-flex-end is-size-3 has-text-weight-semibold">A Paw in Your Hand</p>
    </div>
</footer>
</body>
</html>