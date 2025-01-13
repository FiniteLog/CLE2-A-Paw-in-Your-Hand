<?php
/** @var mysqli $db */
require_once 'includes/connection.php';
session_start();

$query = "SELECT * FROM courses";

$result = mysqli_query($db, $query)
or die ('Error ' . mysqli_error($db) . ' with query ' . $query);

$courses = [];

while ($row = mysqli_fetch_assoc($result)) {
    $courses[] = $row;
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
    <link rel="stylesheet" href="includes/css/style.css">
    <title>Cursus overzicht</title>
</head>
<body>
<main>
<?php if (isset($courses)):
    foreach ($courses as $course):?>
        <table>
            <thead>
            <tr>
                <th></th>
                <th>Title</th>
                <th>info</th>
            </tr>
            </thead>
            <tfoot></tfoot>
            <tbody>
            <tr>
                <th><img src="includes/images/<?= $course['image'] ?>" alt="" width="100px"></th>
                <td><?= $course['title'] ?></td>
                <td><?= $course['short_info'] ?></td>
                <th>
                    <a href="admin_cursus_aanpassen.php?course_id=<?= $course['course_id']?>">
                        Aanpassen
                    </a>
                </th>
            </tr>
            </tbody>
        </table>
    <?php
    endforeach;
endif; ?>
<a href="cursus_toevoegen.php">+ Nieuwe cursus toevoegen</a>
</main>
</body>
</html>
