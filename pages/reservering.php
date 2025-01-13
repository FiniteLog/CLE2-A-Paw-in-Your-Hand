<?php
/** @var mysqli $db */
require_once 'includes/connection.php';
require_once 'includes/classes/DateHandler.php';

session_start();

$errors = [];
$name = $date = $timeslot = $dog_amount = $phone_number = $course_id = $question = '';

// Handle form submission
if (isset($_POST['submit'])) {
    // Sanitize inputs
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $date = mysqli_real_escape_string($db, $_POST['date']);
    $timeslot = mysqli_real_escape_string($db, $_POST['timeslot']);
    $dog_amount = mysqli_real_escape_string($db, $_POST['dog_amount']);
    $phone_number = mysqli_real_escape_string($db, $_POST['phone_number']);
    $course_id = mysqli_real_escape_string($db, $_POST['course_id']);
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
    if ($course_id === "") {
        $errors['course'] = "Kies alstublieft een cursus.";
    }

    // If no errors, insert data
    if (empty($errors)) {
        $insertQuery = "
        INSERT INTO reservations (name, date, timeslot, dog_amount, phone_number, course_id, question) 
        VALUES ('$name', '$date', '$timeslot', '$dog_amount', '$phone_number', '$course_id', '$question')";

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

$courseQuery = "SELECT course_id, title FROM courses";
$courses = mysqli_query($db, $courseQuery);

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
    <link rel="stylesheet" href="includes/css/style.css">

</head>
<body>
<nav class="navbar">
    <div id="navbarBasic" class="navbar-menu p-5">
        <div class="navbar-start">
            <a href="index.php" class="navbar-item custom-margin">
                Home
            </a>
            <a href="reservering.php" class="navbar-item custom-margin">
                Inschrijven
            </a>
            <a href="gebruiker_cursus_overzicht.php.php" class="navbar-item custom-margin">
                Cursussen
            </a>
        </div>
        <div class="navbar-end">
            <div class="navbar-image">
                <img src="includes/images/pupp_darkGreen.png" height="100px">
            </div>
        </div>
    </div>
</nav>
<main class="m-6">
    <!-- Flex container to align everything vertically -->
    <div class="bg-footer box mx-3">
        <!-- Week navigation -->
        <div id="weeks" class="columns mx-6">
            <?php foreach ($weekNumbers as $index => $weekStartForNextWeek): ?>
                <div>
                    <form method="get" action="">
                        <!-- Pass the specific week number as a query parameter -->
                        <input type="hidden" name="week" value="<?= $index ?>">
                        <button class="button is-narrow mx-2 column" type="submit">
                            Week <?= $index + 1 ?>
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Display the selected week's dates (Monday to Sunday) -->
        <div id="days" class="bg-footer-top box">
            <div class="columns box bg-footer">
                <?php foreach ($days as $day): ?>
                    <form method="get" action="" class="column p-0">
                        <input type="hidden" name="date" value="<?= $day ?>">
                        <button
                                class="button is-radiusless is-fullwidth py-4<?= isset($_GET['date']) && $_GET['date'] == $day ? 'is-primary is-fullwidth py-2' : '' ?>"
                                type="submit">
                            <?= date('D', strtotime($day)) ?><br>
                            <?= date('M d', strtotime($day)) ?>
                        </button>
                    </form>
                <?php endforeach; ?>

            </div>


            <!-- The form -->
            <form class="columns bg-footer box mt-4 is-multiline is-centered" action="" method="post">

                <!-- Dog Amount -->
                <div class="field box mx-2 column is-3">
                    <label class="label" for="dog_amount">Aantal Honden</label>

                    <div class="select is-fullwidth">
                        <select id="dog_amount" name="dog_amount">
                            <option value="">-- Selecteer het aantal honden --</option>
                            <option value="1" <?= $dog_amount == 1 ? 'selected' : '' ?>>1</option>
                            <option value="2" <?= $dog_amount == 2 ? 'selected' : '' ?>>2</option>
                            <option value="3" <?= $dog_amount == 3 ? 'selected' : '' ?>>3</option>
                            <option value="4" <?= $dog_amount == 4 ? 'selected' : '' ?>>4</option>
                        </select>
                    </div>
                    <p class="help is-danger"><?= $errors['dog_amount'] ?? '' ?></p>
                </div>

                <!-- Course -->
                <div class="field box is-3 column mx-2">
                    <label class="label" for="course">Cursus</label>
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select id="course_id" name="course_id">
                                <option value="">-- Selecteer een cursus --</option>
                                <?php while ($course_id = mysqli_fetch_assoc($courses)): ?>
                                    <option value="<?= $course_id['course_id'] ?>" <?= $course_id['course_id'] == $course_id ? 'selected' : '' ?>>
                                        <?= htmlentities($course_id['title']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <p class="help is-danger"><?= $errors['course_id'] ?? '' ?></p>
                </div>

                <!-- Date -->
                <label class="label" for="date"></label>
                <div class="control">
                    <input type="hidden" name="date"
                           value="<?= isset($_GET['date']) ? htmlentities($_GET['date']) : date('Y-m-d') ?>">
                </div>
                <p class="help is-danger"><?= $errors['date'] ?? '' ?></p>


                <!--                Timeslot -->
                <!--                <div class="field">-->
                <!--                    <label class="label has-text-primary" for="timeslot">Tijdslot</label>-->
                <!--                    <div class="control">-->
                <!--                        <div class="select is-fullwidth">-->
                <!--                            <select id="timeslot" name="timeslot">-->
                <!--                                <option value="">-- Selecteer een tijdslot --</option>-->
                <!--                                --><?php //while ($timeslot = mysqli_fetch_assoc($timeslots)): ?>
                <!--                                    <option value="--><?php //= $timeslot['id'] ?><!--" -->
                <!--                <?php //= $timeslot['id'] == $timeslot ? 'selected' : '' ?>-->
                <!--                                        --><?php //= htmlentities($timeslot['timeslot']) ?>
                <!--                                    </option>-->
                <!--                                --><?php //endwhile; ?>
                <!--                            </select>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                    <p class="help is-danger">--><?php //= $errors['timeslot'] ?? '' ?><!--</p>-->
                <!--                </div>-->

                <!-- Timeslot -->
                <div class="box column mx-2 is-3 field">
                    <label class="label" for="timeslot">Tijdslot</label>
                    <div class="control">
                        <input class="input" id="timeslot" type="text" name="timeslot"
                               placeholder="Voer een tijdslot in, bvb 10:00 - 11:00"/>
                    </div>
                </div>

                <!-- Name -->
                <div class="field box column is-3 mx-2">
                    <label class="label" for="name">Naam</label>
                    <input class="is-radiusless input" id="name" type="text" name="name"
                           value="<?= htmlentities($name) ?>"/>
                    <p class="help is-danger"><?= $errors['name'] ?? '' ?></p>
                </div>

                <!-- Phone Number -->
                <div class="field box column is-3 mx-2">
                    <label class="label" for="phone_number">Telefoonnummer</label>
                    <div class="control">
                        <input class="input" id="phone_number" type="text" name="phone_number"
                               value="<?= htmlentities($phone_number) ?>" placeholder="06-12345678"/>
                    </div>
                    <p class="help is-danger"><?= $errors['phone_number'] ?? '' ?></p>
                </div>

                <!-- Question -->
                <div class="field box column is-6 mx-2 is-centered">
                    <label class="label" for="question">Vraag</label>
                    <div class="control">
                    <textarea class="textarea" id="question" name="question"
                              placeholder="Stel je vraag hier"><?= htmlentities($question) ?></textarea>
                    </div>
                </div>

                <!-- Submit -->
                <div class="field mx-2">
                    <button class="button is-link is-fullwidth" type="submit" name="submit">Inschrijven</button>
                </div>

            </form>
        </div>
    </div>
</main>

<footer class=" bg-footer-top pt-5">
    <div class="bg-footer columns">
        <img src="includes/images/pupp_darkGreen.png" width="100">
        <p class="column is-align-self-flex-end is-size-3 has-text-weight-semibold">A Paw in Your Hand</p>
    </div>
</footer>
</body>
</html>