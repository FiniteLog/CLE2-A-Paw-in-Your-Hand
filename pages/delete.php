<?php
/** @var mysqli $db */
require_once 'includes/connection.php';

$course_id = mysqli_escape_string($db, $_GET['id']);

print_r($course_id);
if (isset($_POST['confirm'])) {
    if (isset($course_id)) {
        $query = "DELETE FROM courses WHERE course_id = $course_id";
        $result = mysqli_query($db, $query);

        if ($result) {
            header('location: admin_cursus_overzicht.php');
            exit();
        } else {
            $deleteError = 'Deletion was not successful, please try again';
            echo "Error: " . mysqli_error($db);
        }
    } else {
        header('location: admin_cursus_overzicht.php');
        exit();
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
    <title>Cursus verwijderen</title>
</head>
<body>
<main>
    <form method="post">
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Weet je zeker dat je deze cursus wilt verwijderen?</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="control">
                        <button class="button is-danger" name="confirm" value="yes">Ja</button>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <button class="button is-primary" name="confirm" value="no">Nee</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>
</body>
</html>