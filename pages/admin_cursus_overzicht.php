<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "CLE2";

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: " . mysqli_connect_error());

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
    <title>Cursus overzicht</title>
</head>
<body>
<?php if(isset($courses)):
    foreach($courses as $course):?>
        <table>
            <thead>
            <tr>
                <th> </th>
                <th>Title</th>
                <th>info</th>
            </tr>
            </thead>
            <tfoot></tfoot>
            <tbody>
            <tr>
                <th><img src="includes/images/<?= $course['image'] ?>" alt="" width="100px"></th>
                <td><?= $course['title']?></td>
                <td><?= $course['short_info'] ?></td>
                <th><a href="admin_curus_aanpassen.php?course_id=<?= $course['course_id']?>">Aanpassen</a></th>
            </tr>
            </tbody>
        </table>
    <?php
    endforeach;
endif; ?>
<a href="#">+ Nieuwe cursus toevoegen</a>
</body>
</html>
