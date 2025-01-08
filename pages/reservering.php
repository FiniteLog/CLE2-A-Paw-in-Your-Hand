<?php
/** @var mysqli $db */
require_once 'includes/connection.php';
require_once 'includes/classes/DateHandler.php';
session_start();

$errors = [];
$name = $date = $timeslot = $dog_amount = $phone_number = $course = $question = '';

// Handle form submission
if (isset($_POST['submit'])) {
    // Sanitize inputs
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $date = mysqli_real_escape_string($db, $_POST['date']);
    $timeslot = mysqli_real_escape_string($db, $_POST['timeslot']);
    $dog_amount = mysqli_real_escape_string($db, $_POST['dog_amount']);
    $phone_number = mysqli_real_escape_string($db, $_POST['phone_number']);
    $course = mysqli_real_escape_string($db, $_POST['course']);
    $question = mysqli_real_escape_string($db, $_POST['question']);
    $userId = $_SESSION['user']['id'] ?? null; // Retrieve logged-in user's ID

    // Validation
    if ($name === "") {
        $errors['name'] = "Vul alstublieft een naam in.";
    }
    if ($date === "") {
        $errors['date'] = "Kies alstublieft een datum.";
    }
    if ($timeslot === "") {
        $errors['timeslot'] = "Kies alstublieft een tijdslot.";
    }
    if ($dog_amount === "") {
        $errors['dog_amount'] = "Kies alstublieft de hoeveelheid honden.";
    }
    if ($phone_number === "") {
        $errors['phone_number'] = "Vul alstublieft een telefoonnummer in.";
    }
    if ($course === "") {
        $errors['course'] = "Kies alstublieft een cursus.";
    }

    // If no errors, insert data
    if (empty($errors)) {
        $insertQuery = "
        INSERT INTO reservations (name, data, time_slot, dog_amount, phone_number, cursus, question) 
        VALUES ('$name', '$date', '$timeslot', '$dog_amount', '$phone_number', '$course', '$question')";

        if (mysqli_query($db, $insertQuery)) {
            header('Location: index.php');
            exit;
        } else {
            echo "Error: " . mysqli_error($db);
        }
    }
}

// Fetch dropdown options
//$timeslotQuery = "SELECT id, timeslot FROM timeslots";
//$timeslots = mysqli_query($db, $timeslotQuery);
//
//$courseQuery = "SELECT id, name FROM courses";
//$courses = mysqli_query($db, $courseQuery);

mysqli_close($db);

// Instantiate the class
$dateHandler = new DateHandler(isset($_GET['date']) ? $_GET['date'] : null);

// Determine the selected week and set it
$currentWeekIndex = isset($_GET['week']) ? intval($_GET['week']) : 0;
$dateHandler->setWeekByIndex($currentWeekIndex);

// Get week numbers and days
$weekNumbers = $dateHandler->getWeekNumbers();
$days = $dateHandler->getDays();
?>
<!doctype html>
<html lang="nl" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>reservering</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="../CSS/style.css"

</head>
<body>
<nav class="navbar is-primary">
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item">
                Home
            </a>
            <a class="navbar-item">
                Inschrijven
            </a>
            <a class="navbar-item">
                Cursussen
            </a>
        </div>
    </div>
</nav>

<main class="m-6">
    <div class="bg-footer box mx-3">

        <div class="columns mx-6">
            <button class="column is-narrow button mx-2">week 1</button>
            <button class="column is-narrow button mx-2">week 2</button>
            <button class="column is-narrow button mx-2">week 3</button>
            <button class="column is-narrow button mx-2">week 4</button>
        </div>

        <div class="bg-footer-top box">

            <div class="bg-footer box columns">
                <p class="column box pb-6 is-radiusless ">Ma</p>
                <p class="column box pb-6 is-radiusless ">Di</p>
                <p class="column box pb-6 is-radiusless ">Wo</p>
                <p class="column box pb-6 is-radiusless ">Do</p>
                <p class="column box pb-6 is-radiusless ">Vr</p>
                <p class="column box pb-6 is-radiusless ">Za</p>
                <p class="column box pb-6 is-radiusless box-last">Zo</p>
            </div>

            <div class="bg-footer box mt-4 columns is-multiline is-centered">
                <div class="box column is-3 mx-4">
                    <p>Aantal honden</p>
                    <input class="box is-radiusless input" type="number">
                </div>
                <div class="box column is-3 mx-4">
                    <p>Cursus</p>
                    <div class="select is-fullwidth">
                        <select>
                            <option>Selecteer een cursus</option>
                            <option>pipi</option>
                            <option>poopoo</option>
                        </select>
                    </div>
                </div>
                <div class="box column is-3 mx-4">
                    <p>Selecteer een tijdslot</p>
                    <input class="box is-radiusless input" type="time">
                </div>
                <div class="column box is-4 mx-4">
                    <p>Uw naam</p>
                    <input class="box is-radiusless input" type="text">
                </div>
                <div class="column box is-4 mx-4 box-last">
                    <p>Telefoonnummer</p>
                    <input class="box is-radiusless input" type="tel">
                </div>
            </div>

            <div class="box bg-footer">
                <div class="px-6 is-half column container">
                    <h1 class="has-text-centered is-underlined is-size-5">Vraag?</h1>
                    <input class="box is-radiusless input" type="text">
                </div>
            </div>

        </div>
    </div>
</main>
<footer class=" bg-footer-top pt-5
                    ">
    <div class="bg-footer columns">
        <img src="/pages/includes/images/pupp_darkGreen.png" width="100">
        <p class="column is-align-self-flex-end is-size-3 has-text-weight-semibold">A Paw in Your Hand</p>
    </div>
</footer>
</body>
</html>
