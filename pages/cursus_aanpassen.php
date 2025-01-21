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

if (!isset($courseId) || $courseId == "" || !is_numeric($courseId)) {
    header('Location: admin_cursus_overzicht.php'); //keep an eye on if this is still correct later
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
    } elseif (strlen($title) <= 10) {
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
        <link rel="stylesheet" href="includes/css/style.css">
        <link rel="icon" href="includes/images/pupp_darkGreen.png">
        <title>Admin - <?= $courseData[0]['title']; ?> aanpassen - A Paw in Your Hand</title>
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
                <a href="admin_cursus_overzicht.php" class="navbar-item custom-margin"
                   style="background-color: #2CDB43; color: black;">
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
            <h2 style="color: black; font-size: 2rem; font-weight: bold; margin-bottom: 2%; margin-top: 3%;"><?= $title ?? $courseData[0]['title'] ?>
                aanpassen</h2>
            <form action="" method="post" style="display: flex; flex-flow: column; ">
                <label for="title" style="color: black; margin-top: 4%;">Titel</label>
                <input type="text" value="<?= $courseData[0]['title']; ?>" id="title" name="title" style="width: 15vw;">

                <label for="short_info" style="color: black; margin-top: 4%;">Pop-up informatie</label>
                <textarea id="short_info" name="short_info"
                          style="height: 50px; padding: 1%; width: 40vw;"><?= $courseData[0]['short_info']; ?></textarea>

                <label for="info" style="color: black; margin-top: 4%;">Informatie</label>
                <textarea id="info" name="info"
                          style="height: 150px; padding: 1%;"><?= $courseData[0]['info']; ?></textarea>

                <div style="display: flex; flex-flow: row; margin-top: 5%;">
                    <input type="submit" name="submit" value="Aanpassen"
                           style="width: 10vw; height: 5vh; margin-right: 2%;" class="button">
                    <a href="admin_cursus_overzicht.php" class="button"
                       style="margin-right: 2%; background-color: #23B136; color: black;">Terug</a>
                    <a href="delete.php?id=<?= $courseData[0]['course_id'] ?>&name=<?= $courseData[0]['title'] ?>&image=<?= $courseData[0]['image'] ?>"
                       class="button" style="background-color: darkred">Verwijder cursus</a>
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

<?php endif; ?>