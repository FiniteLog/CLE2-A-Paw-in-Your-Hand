<?php
/** @var mysqli $db */
session_start();
require_once 'includes/connection.php';

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

// Get the current date from the query string or default to today
$currentDate = isset($_GET['date']) ? strtotime($_GET['date']) : time();

// Get the start of the current week (Monday)
$weekStart = strtotime("Monday this week", $currentDate);

// Generate dates for the current week (Monday to Sunday)
$days = [];
for ($i = 0; $i < 7; $i++) {
    $days[] = date('Y-m-d', strtotime("+$i day", $weekStart));
}

// Calculate the start of the next 4 weeks (week 1 to week 4)
$weekNumbers = [];
for ($i = 0; $i < 4; $i++) {
    // Start each week from the Monday of that week
    $weekStartForNextWeek = strtotime("+$i week", $weekStart);
    $weekNumbers[] = date('Y-m-d', $weekStartForNextWeek);
}

// Set the week number based on the current date or default to this week
$currentWeekIndex = isset($_GET['week']) ? $_GET['week'] : 0;
$currentWeekStart = $weekNumbers[$currentWeekIndex]; // Set the current week based on selected week
$weekStart = strtotime($currentWeekStart); // Update the weekStart with the chosen week's start date

// Generate the days for the selected week (Monday to Sunday)
$days = [];
for ($i = 0; $i < 7; $i++) {
    $days[] = date('Y-m-d', strtotime("+$i day", $weekStart));
}
?>
<!doctype html>
<html lang="en" class="has-background-black-ter">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Inschrijving</title>
</head>
<body>
<div class="container px-4">
    <section class="columns is-centered">
        <div class="column is-10">
            <h2 class="title mt-4 has-text-primary">Inschrijfformulier</h2>

            <!-- Navigation for the upcoming 4 weeks -->
            <div class="level">
                <?php foreach ($weekNumbers as $index => $weekStartForNextWeek): ?>
                    <div class="level-item">
                        <form method="get" action="">
                            <!-- Pass the specific week number as a query parameter -->
                            <input type="hidden" name="week" value="<?= $index ?>">
                            <button class="button is-link" type="submit">
                                Week <?= $index + 1 ?>
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Display the selected week's dates (Monday to Sunday) -->
            <div class="box">
                <div class="columns is-centered">
                    <?php foreach ($days as $day): ?>
                        <div class="column is-1">
                            <form method="get" action="">
                                <input type="hidden" name="date" value="<?= $day ?>">
                                <button
                                        class="button <?= isset($_GET['date']) && $_GET['date'] == $day ? 'is-primary' : '' ?>"
                                        type="submit">
                                    <?= date('D', strtotime($day)) ?><br>
                                    <?= date('M d', strtotime($day)) ?>
                                </button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <form class="column is-6" action="" method="post">
                <!-- Name -->
                <div class="field">
                    <label class="label has-text-primary" for="name">Naam</label>
                    <div class="control">
                        <input class="input" id="name" type="text" name="name" value="<?= htmlentities($name) ?>"/>
                    </div>
                    <p class="help is-danger"><?= $errors['name'] ?? '' ?></p>
                </div>

                <!-- Date -->
                <div class="field">
                    <label class="label has-text-primary" for="date"></label>
                    <div class="control">
                        <input type="hidden" name="selected_date" value="<?= isset($_GET['date']) ? htmlentities($_GET['date']) : date('Y-m-d') ?>">                    </div>
                    <p class="help is-danger"><?= $errors['date'] ?? '' ?></p>
                </div>

<!--                <!-- Timeslot -->-->
<!--                <div class="field">-->
<!--                    <label class="label has-text-primary" for="timeslot">Tijdslot</label>-->
<!--                    <div class="control">-->
<!--                        <div class="select is-fullwidth">-->
<!--                            <select id="timeslot" name="timeslot">-->
<!--                                <option value="">-- Selecteer een tijdslot --</option>-->
<!--                                --><?php //while ($timeslot = mysqli_fetch_assoc($timeslots)): ?>
<!--                                    <option value="--><?php //= $timeslot['id'] ?><!--" --><?php //= $timeslot['id'] == $timeslot ? 'selected' : '' ?><!-->-->
<!--                                        --><?php //= htmlentities($timeslot['timeslot']) ?>
<!--                                    </option>-->
<!--                                --><?php //endwhile; ?>
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <p class="help is-danger">--><?php //= $errors['timeslot'] ?? '' ?><!--</p>-->
<!--                </div>-->

                <!-- Temporary Timeslot -->
                <div class="field">
                    <label class="label has-text-primary" for="timeslot">Tijdslot</label>
                    <div class="control">
                        <input class="input" id="timeslot" type="text" name="timeslot" placeholder="Voer een tijdslot in, bijvoorbeeld 10:00 - 11:00"/>
                    </div>
                </div>

                <!-- Dog Amount -->
                <div class="field">
                    <label class="label has-text-primary" for="dog_amount">Aantal Honden</label>
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select id="dog_amount" name="dog_amount">
                                <option value="">-- Selecteer het aantal honden --</option>
                                <option value="1" <?= $dog_amount == 1 ? 'selected' : '' ?>>1</option>
                                <option value="2" <?= $dog_amount == 2 ? 'selected' : '' ?>>2</option>
                                <option value="3" <?= $dog_amount == 3 ? 'selected' : '' ?>>3</option>
                                <option value="4" <?= $dog_amount == 4 ? 'selected' : '' ?>>4</option>
                            </select>
                        </div>
                    </div>
                    <p class="help is-danger"><?= $errors['dog_amount'] ?? '' ?></p>
                </div>

                <!-- Phone Number -->
                <div class="field">
                    <label class="label has-text-primary" for="phone_number">Telefoonnummer</label>
                    <div class="control">
                        <input class="input" id="phone_number" type="text" name="phone_number" value="<?= htmlentities($phone_number) ?>" placeholder="06-12345678"/>
                    </div>
                    <p class="help is-danger"><?= $errors['phone_number'] ?? '' ?></p>
                </div>

<!--                <!-- Course -->-->
<!--                <div class="field">-->
<!--                    <label class="label has-text-primary" for="course">Cursus</label>-->
<!--                    <div class="control">-->
<!--                        <div class="select is-fullwidth">-->
<!--                            <select id="course" name="course">-->
<!--                                <option value="">-- Selecteer een cursus --</option>-->
<!--                                --><?php //while ($course = mysqli_fetch_assoc($courses)): ?>
<!--                                    <option value="--><?php //= $course['id'] ?><!--" --><?php //= $course['id'] == $course ? 'selected' : '' ?><!-->-->
<!--                                        --><?php //= htmlentities($course['name']) ?>
<!--                                    </option>-->
<!--                                --><?php //endwhile; ?>
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <p class="help is-danger">--><?php //= $errors['course'] ?? '' ?><!--</p>-->
<!--                </div>-->

                <!-- Temporary Course -->
                <div class="field">
                    <label class="label has-text-primary" for="course">Cursus</label>
                    <div class="control">
                        <input class="input" id="course" type="text" name="course" placeholder="Voer een cursus in, bijvoorbeeld Obedience 1"/>
                    </div>
                </div>

                <!-- Question -->
                <div class="field">
                    <label class="label has-text-primary" for="question">Vraag</label>
                    <div class="control">
                        <textarea class="textarea" id="question" name="question" placeholder="Stel je vraag hier"><?= htmlentities($question) ?></textarea>
                    </div>
                </div>

                <!-- Submit -->
                <div class="field">
                    <button class="button is-link is-fullwidth" type="submit" name="submit">Inschrijven</button>
                </div>
            </form>
        </div>
    </section>
</div>
</body>
</html>
