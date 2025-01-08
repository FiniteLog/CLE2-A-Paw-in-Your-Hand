<?php
$courseId = $_GET['course_id'];

$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "CLE2";

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: " . mysqli_connect_error());

$query = "SELECT * FROM courses WHERE course_id=$courseId";

$result = mysqli_query($db, $query);

$courseData = [];

while ($row = mysqli_fetch_assoc($result)) {
    $courseData[] = $row;
}

mysqli_close($db);

if (!isset($courseId) || $courseId == "") {
    header('Location: cursus.php'); //keep an eye on if this is still correct later
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
        <title><?= $courseData[0]['title'] ?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
        <link rel="stylesheet" href="../CSS/style.css">
    </head>
    <body>
    <div>
        <img src="includes/images/<?= $courseData[0]['image'] ?>" alt="<?= $courseData[0]['image'] ?>">
    </div>
    <div>
        <h1><?= $courseData[0]['title'] ?></h1>
        <p><?= $courseData[0]['info'] ?></p>
    </div>
    </body>
    </html>
<?php endif; ?>