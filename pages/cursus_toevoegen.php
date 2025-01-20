<?php
/** @var mysqli $db
 * @var string $host
 * @var string $user
 * @var string $password
 * @var string $database
 * */

require_once 'includes/connection.php';
session_start();
if (isset($_POST['submit'])) {

    $title = htmlentities($_POST['title']);
    $short_info = htmlentities($_POST['short_info']);
    $info = htmlentities($_POST['info']);

    $errors = [];

    if ($title == '') {
        $invalidTitle = "Kies een andere titel";
        $errors[] = $invalidTitle;
    } elseif (strlen($title) >= 50) {
        $invalidTitle = "De titel is te lang!";
        $errors[] = $invalidTitle;
    } elseif (strlen($title) <= 10) {
        $invalidTitle = "De titel is te kort!";
        $errors[] = $invalidTitle;
    }
    if ($short_info == '') {
        $invalidsinfo = "Er mist nog informatie!";
        $errors[] = $invalidsinfo;
    } elseif (strlen($short_info) >= 300) {
        $invalidsinfo = "De tekst is te lang";
        $errors[] = $invalidsinfo;
    }
    if ($info == '') {
        $invalidInfo = "Er mist nog informatie!";
        $errors[] = $invalidInfo;
    } elseif (strlen($info) >= 3000) {
        $invalidInfo = "De tekst is te lang";
        $errors[] = $invalidInfo;
    }

    if (empty($errors)) {
        $query = "INSERT INTO `courses`(`title`, `info`, `short_info`) VALUES ('$title', '$info', '$short_info')";

        $result = mysqli_query($db, $query);
        mysqli_close($db);
        header('Location: admin_cursus_overzicht.php');
    }
}

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
    <link rel="icon" href="includes/images/pupp_darkGreen.png">
    <title>Cursus toevoegen - A Paw in Your Hand</title>
</head>
<body style="background-repeat: no-repeat; background-size: cover; background-image: url('includes/css/bg4.jpg');">
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
            <a href="cursisten_overzicht.php" class="navbar-item custom-margin">
                Cursisten
            </a>
        </div>
        <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
    </div>
</nav>
<main>
    <div style="background-color: white; width: 75%; margin-left: 8vw; height: 100vh; margin-top: -2.5vh; padding: 5%;">
        <h2 style="color: black; font-size: 2rem; font-weight: bold; margin-bottom: 2%; margin-top: 6%;">Cursus
            toevoegen</h2>

        <form action="" method="post" style="display: flex; flex-flow: column; ">
            <label for="title" style="color: black; margin-top: 4%;">Titel</label>
            <input type="text" value="<?= $title ?? '' ?>" id="title" name="title" style="width: 15vw;">
            <p><?= $invalidTitle ?? '' ?></p>
            <label for="short_info" style="color: black; margin-top: 4%;">Pop-up informatie</label>
            <textarea id="short_info" name="short_info" oninput="this.style.height"
                      style="height: 50px; padding: 1%; width: 40vw;"><?= $short_info ?? '' ?></textarea>
            <p><?= $invalidsinfo ?? '' ?></p>
            <label for="info" style="color: black; margin-top: 4%;">Informatie</label>
            <textarea id="info" name="info" oninput="this.style.height"
                      style="height: 150px; padding: 1%;"><?= $info ?? '' ?></textarea>
            <p><?= $invalidInfo ?? '' ?></p>
            <div style="display: flex; flex-flow: row;">
                <input class="button" type="submit" name="submit" value="Toevoegen"
                       style="width: 10vw; height: 5vh; margin-top: 3%;">
                <a href="admin_cursus_overzicht.php" class="button"
                   style="padding: 1%; font-size: 1rem; background-color: #23B136; color: black; width: 10vw; height: 5vh; margin-left: 3%;  margin-top: 3%;">Terug</a>
                <!--history.back()-->
            </div>
        </form>
    </div>
</main>
<footer>
    <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
    <p class="column is-align-self-flex-end is-size-4 has-text-weight-semibold">A Paw in Your Hand</p>
</footer>
</body>
</html>