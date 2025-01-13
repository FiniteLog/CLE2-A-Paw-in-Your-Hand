<?php
/** @var mysqli $db
 * @var string $host
 * @var string $user
 * @var string $password
 * @var string $database
 * */

require_once 'includes/connection.php';
session_start();
if(isset($_POST['submit'])) {

    $title = htmlentities($_POST['title']);
    $short_info = htmlentities($_POST['short_info']);
    $info = htmlentities( $_POST['info']);

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
                <img src="includes/images/pupp_darkGreen.png" height="100">
                <!--Ik mis een unit bij de 100 - image is nu ook heel klein-->
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
            <input type="text" value="<?=$title ?? ''?>" id="title" name="title" style="width: 15vw;">
            <p><?= $invalidTitle ?? '' ?></p>
            <br>
            <label for="short_info">Pop-up informatie</label>
            <textarea id="short_info" name="short_info" oninput="this.style.height" style="height: 50px; padding: 1%; width: 40vw;"><?=$short_info ?? ''?></textarea>
            <p><?= $invalidsinfo ?? '' ?></p>
            <br>
            <label for="info">Informatie</label>
            <textarea id="info" name="info" oninput="this.style.height" style="height: 150px; padding: 1%;"><?=$info ?? ''?></textarea>
            <p><?= $invalidInfo ?? '' ?></p>
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