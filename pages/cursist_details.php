<?php
/** @var mysqli $db */
require_once 'includes/connection.php';
session_start();

$studentId = $_GET['cursist_id'];

$query = "SELECT * FROM cursisten WHERE cursist_id=$studentId";

$result = mysqli_query($db, $query);

$studentData = [];

while ($row = mysqli_fetch_assoc($result)) {
    $studentData[] = $row;
}

mysqli_close($db);

if (!isset($studentId) || $studentId == "" || !is_numeric($studentId)) {
    header('Location: cursisten_overzicht.php');
}

if (isset($studentId)):
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cursist Details</title>
</head>
<body>
<main>
    <div>
        <img src="includes/images/<?= $studentData[0]['pfp']?>">
    </div>
    <div>
       <h1><?= $studentData[0]['first_name']?> <?= $studentData[0]['last_name']?></h1>
    </div>
    <div>
        <p><?= $studentData[0]['email']?></p>
    </div>
</main>
</body>
</html>

<?php endif; ?>