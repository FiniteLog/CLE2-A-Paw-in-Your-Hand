<?php
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Week-Based Date Picker</title>
</head>
<body>
<div class="container">
    <section class="section">
        <h1 class="title">Select a Date</h1>

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

        <!-- Submit the selected date -->
        <form method="post" action="your_form_handler.php">
            <div class="field">
                <label class="label">Selected Date</label>
                <div class="control">
                    <input
                            class="input"
                            type="text"
                            name="selected_date"
                            value="<?= isset($_GET['date']) ? htmlentities($_GET['date']) : date('Y-m-d') ?>"
                            readonly>
                </div>
            </div>
            <button class="button is-link" type="submit">Submit</button>
        </form>
    </section>
</div>
</body>
</html>
