<?php
/** @var mysqli $db */
require_once 'includes/connection.php';

$course_id = mysqli_real_escape_string($db, $_GET['id']);
$course_name = mysqli_real_escape_string($db, $_GET['name']);
$course_image = mysqli_real_escape_string($db, $_GET['image']);

if (isset($_POST['confirm'])) {
    $query = "DELETE FROM courses WHERE course_id = $course_id";
    $result = mysqli_query($db, $query);
    if ($result) {
        header('location: admin_cursus_overzicht.php');
        exit();
    }
    else {
        $deleteError = 'Deletion was not successful, please try again';
        echo "Error: " . mysqli_error($db);
    }
}
else if (isset($_POST['cancel'])){
    header('location: cursus_aanpassen.php?course_id=' . $course_id);
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
    <title><?=$course_name?> verwijderen</title>
</head>
<body style="background-image: url('includes/css/bg4.jpg');">
<main style="background-color: black;">
    <form method="post" style="margin-top: 6%;">
        <img src="includes/images/<?= $course_image ?>" style="width: 30%; margin-left: 35%; margin-top: 10%;" alt="course image">
        <div style="display: flex; flex-flow: column;">
            <div class="is-normal" style="margin-left: 23%; margin-top: 1%;">
                <label class="label" style="font-size: 1.5rem;">Weet je zeker dat je <?=$course_name?> wilt verwijderen?</label>
            </div>
            <div style="display: flex; flex-flow: column; align-items: center;">
                <button class="button" name="confirm" value="confirm" style="margin-top: 2%; width: 35vw; background-color: darkred;">Ja</button>
                <button class="button" name="cancel" value="cancel" style="margin-top: 2%; width: 35vw; background-color: darkslategrey">Nee</button>
            </div>

        </div>
    </form>
</main>
</body>
</html>