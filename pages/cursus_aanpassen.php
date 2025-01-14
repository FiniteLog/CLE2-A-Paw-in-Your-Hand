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
    header('Location: gebruiker_cursus_overzicht.php'); //keep an eye on if this is still correct later
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
        <title><?= $courseData[0]['title']; ?> aanpassen</title>
    </head>
    <body style="background-repeat: no-repeat; background-size: cover;">
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
                <a href="" class="navbar-item custom-margin">
                    Cursisten
                </a>
            </div>
            <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
        </div>
    </nav>
    <main>
        <div style="background-color: white; width: 75%; margin-left: 8vw; height: 100vh; margin-top: -2.5vh; padding: 5%;">
            <h2><?= $title ?? $courseData[0]['title'] ?> aanpassen</h2>
            <section class="columns mt-2">
                <a href="admin_cursus_overzicht.php" class="box mx-2 column is-2 button is-link">Terug</a>
                <a href="delete.php?id=<?= $courseData[0]['course_id'] ?>"
                   class="box box-last mx-2 column is-2 button is-link">Verwijder cursus</a>
            </section>
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
                <br>
                <input type="submit" name="submit" value="aanpassen" style="width: 10vw; height: 5vh;">
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