<?php
/** @var mysqli $db */
require_once 'includes/connection.php';
require_once 'includes/classes/DateHandler.php';
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit;
}

// Get admin data from the SESSION
$admin = $_SESSION['admin'];
$name = $admin['username'];

// Fetch reservations with course information
$query = "
    SELECT reservations.reservation_id, reservations.date, courses.title, reservations.timeslot
    FROM reservations
    JOIN courses ON reservations.course_id = courses.course_id
";
$result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db) . ' with query ' . $query);

// Group reservations by date
$reservationsByDate = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Use the correct column name: 'date' instead of 'reservation_date'
    if (!empty($row['date'])) {
        $reservationsByDate[$row['date']][] = $row;
    }
}

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
          content="width=device-width, initial-scale=1.0">
    <title>Reservering</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="includes/css/style.css">
    <link rel="icon" href="includes/images/pupp_darkGreen.png">
</head>
<body style="background-repeat: no-repeat; background-size: cover; background-image: url('includes/css/bg4.jpg');">
<nav class="navbar">
    <div id="navbarBasic" class="navbar-menu px-6">
        <div class="navbar-start">
            <a href="index.php" class="navbar-item custom-margin">
                Home
            </a>
            <a href="agenda.php" class="navbar-item custom-margin" style="background-color: #2CDB43; color: black;">
                Agenda
            </a>
            <a href="admin_cursus_overzicht.php" class="navbar-item custom-margin">
                Cursusoverzicht
            </a>
            <a href="cursisten_overzicht.php" class="navbar-item custom-margin">
                Cursisten
            </a>
            <a href="logout.php" class="navbar-item custom-margin">Log out</a>
        </div>
        <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
    </div>
</nav>
<main class="pt-6">
    <!-- Flex container to align everything vertically -->
    <div class="columns mx-6 is-flex is-flex-direction-column">
        <!-- Week navigation -->
        <div id="weeks" class="columns is-flex is-flex-direction-row is-justify-content-space-between">
            <?php foreach ($weekNumbers as $index => $weekStartForNextWeek): ?>
                <div>
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

        <!-- Display the selected week's dates and reservations -->
        <div id="days" class="box">
            <div class="columns is-flex is-justify-content-space-between is-mobile">
                <?php foreach ($days as $day): ?>
                    <div class=" column box box-last is-radiusless">
                        <h3 class="title is-5"><?= date('D, M d', strtotime($day)) ?></h3>
                        <?php if (isset($reservationsByDate[$day])): ?>
                            <?php foreach ($reservationsByDate[$day] as $reservation): ?>
                                <form method="get" action="reservation_details.php" class="mb-2">
                                    <input type="hidden" name="id" value="<?= $reservation['reservation_id'] ?>">
                                    <button class="button is-info is-fullwidth">
                                        <?= htmlspecialchars($reservation['timeslot']) ?>
                                        <?= htmlspecialchars($reservation['title']) ?>
                                    </button>
                                </form>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No reservations</p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<footer>
    <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
    <p class="column is-align-self-flex-end is-size-4 has-text-weight-semibold">A Paw in Your Hand</p>
</footer>
</body>
</html>

