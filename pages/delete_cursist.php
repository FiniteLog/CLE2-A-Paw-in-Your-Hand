<?php
/** @var mysqli $db */
require_once 'includes/connection.php';
session_start();

if (isset($_GET['cursist_id']) && is_numeric($_GET['cursist_id'])) {
    $cursistID = mysqli_real_escape_string($db, $_GET['cursist_id']);
} else {
    header('location: cursist_overzicht.php');
    exit();
}

if (isset($_POST['confirm'])) {
    $query = "DELETE FROM cursisten WHERE cursisten.cursist_id = $cursistID";
    $result = mysqli_query($db, $query);
    if ($result) {
        header('location: cursisten_overzicht.php?cursist_id=' . $cursistID);
        exit();
    } else {
        $deleteError = 'Deletion was not successful, please try again';
        echo "Error: " . mysqli_error($db);
    }
} else if (isset($_POST['cancel'])) {
    header('location: cursist_details.php?cursist_id=' . $cursistID);
    exit();
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
    <title>Verwijder cursist</title>
</head>
<body style="background-image: url('includes/css/bg4.jpg');">
<main style="background-color: black;">
    <form method="post" style="margin-top: 6%;">
        <div style="display: flex; flex-flow: column;">
            <div class="is-normal" style="margin-left: 23%; margin-top: 1%;">
                <label class="label" style="font-size: 1.5rem;">Weet je zeker dat je deze cursist wilt verwijderen?</label>
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