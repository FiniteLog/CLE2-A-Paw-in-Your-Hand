<?php
/** @var mysqli $db */
require_once 'includes/connection.php';
session_start();

$query = "SELECT * FROM cursisten";

$result = mysqli_query($db, $query)
or die('Error' . mysqli_error($db) . 'with query' . $query);

$students = [];

while ($row = mysqli_fetch_assoc($result)) {
    $students[] = $row;
}

mysqli_close($db);
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<main>
    <table>
        <thead>
        </thead>

        <tbody>
        <?php if (isset($students));
        foreach ($students as $student):?>
        <tr>
            <td><?= $student['cursist_id'] ?></td>
            <td><?= $student['first_name'] ?></td>
            <td><?= $student['last_name'] ?></td>
            <td><?= $student['email'] ?></td>
            <td><?= $student['password'] ?></td>
            <td><?= $student['pfp'] ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>
</body>
</html>
