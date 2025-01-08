<?php
$courseId = $_GET["course_id"];

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

if(!isset($courseId) || $courseId == ""){
    header('Location: cursus.php'); //keep an eye on if this is still correct later
}

if(isset($courseData)):

?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$courseData[0]['title'];?> aanpassen</title>
</head>
<body>
<h2><?=$courseData[0]['title'];?> aanpassen</h2>
<form action="" method="post">
    <label for="title">Titel</label>
    <input type="text" value="<?=$courseData[0]['title'];?>" id="title" name="title">

    <label for="short_info">Pop-up informatie</label>
    <input type="text" value="<?=$courseData[0]['short_info'];?>" id="short_info" name="short_info">

    <label for="info">Informatie</label>
    <input type="text" value="<?=$courseData[0]['info'];?>" id="info" name="info">

    <input type="submit" value="Aanpassen">
</form>
<!--put form with data here-->
</body>
</html>

<?php endif; ?>