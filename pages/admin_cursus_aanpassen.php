<?php
/** @var mysqli $db
 * @var string $host
 * @var string $user
 * @var string $password
 * @var string $database
 * */

require_once 'includes/connection.php';
session_start();

$courseId = $_GET["course_id"];

$query = "SELECT * FROM courses WHERE course_id=$courseId";

$result = mysqli_query($db, $query);

$courseData = [];

while ($row = mysqli_fetch_assoc($result)) {
    $courseData[] = $row;
}

if (!isset($courseId) || $courseId == "" || is_numeric($courseId)) {
    header('Location: cursus.php'); //keep an eye on if this is still correct later
}

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
    } elseif (strlen($title) <= 10){
        $invalidTitle = "De titel is te kort!";
        $errors[] = $invalidTitle;
    }
    if ($short_info == '') {
        $invalidsinfo = "Er mist nog informatie!";
        $errors[] = $invalidsinfo;
    } elseif (strlen($short_info) >= 200) {
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
        $query_sub = "UPDATE `courses` SET `title`='$title',`info`='$info',`short_info`='$short_info' WHERE course_id=$courseId";

        mysqli_query($db, $query_sub);
        header('Location: admin_cursus_overzicht.php');
    }
}

if (isset($courseData)):

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
        <title><?= $courseData[0]['title']; ?> aanpassen</title>
    </head>
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
                    <img src="includes/images/pupp_darkGreen.png" height="100px">
                </div>
            </div>
        </div>
    </nav>
    <main>
        <body style="background-image: url('includes/images/bg1.png'); background-repeat: no-repeat; background-size: cover;">
        <div style="background-color: white; width: 75%; margin-left: 8vw; height: 100vh; margin-top: -2.5vh; padding: 5%;">
            <h2><?= $courseData[0]['title']; ?> aanpassen</h2>
            <a href="admin_cursus_overzicht.php">Terug</a>
            <h2><?=$title ?? $courseData[0]['title']?> aanpassen</h2>
            <a href="admin_cursus_overzicht.php">Terug</a>
            <a>Verwijder cursus</a>
            <br>
            <br>
            <form action="" method="post" style="display: flex; flex-flow: column; ">
                <label for="title">Titel</label>
                <input type="text" value="<?= $courseData[0]['title']; ?>" id="title" name="title" style="width: 15vw;">
                <br>
                <label for="short_info">Pop-up informatie</label>
                <textarea id="short_info" name="short_info"
                          style="height: 50px; padding: 1%; width: 40vw;"><?= $courseData[0]['short_info']; ?></textarea>
                <br>
                <label for="info">Informatie</label>
                <textarea id="info" name="info"
                          style="height: 150px; padding: 1%;"><?= $courseData[0]['info']; ?></textarea>
                <input type="text" value="<?=$courseData[0]['title'];?>" id="title" name="title" style="width: 15vw;">
                <p><?= $invalidTitle ?? '' ?></p>
                <br>
                <label for="short_info">Pop-up informatie</label>
                <textarea id="short_info" name="short_info" oninput="this.style.height" style="height: 50px; padding: 1%; width: 40vw;"><?=$courseData[0]['short_info'];?></textarea>
                <p><?= $invalidsinfo ?? '' ?></p>
                <br>
                <label for="info">Informatie</label>
                <textarea id="info" name="info" oninput="this.style.height" style="height: 150px; padding: 1%;"><?=$courseData[0]['info'];?></textarea>
                <p><?= $invalidInfo ?? '' ?></p>
                <br>
                <input type="submit" name="submit" value="aanpassen" style="width: 10vw; height: 5vh;">
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

<?php endif; ?>