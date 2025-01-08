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
    <title> aanpassen</title>
</head>
<body>
<h2><?=$courseData[0]['title'];?> aanpassen</h2>
<form action="">
    <label for=""></label>
    <input type="text" value="<?=$courseData[0]['title'];?>">

    <label for=""></label>
    <input type="text" value="<?=$courseData[0]['short_info'];?>">

    <label for=""></label>
    <input type="text" value="<?=$courseData[0]['info'];?>">
</form>
<!--put form with data here-->
</body>
</html>

<?php endif; ?>