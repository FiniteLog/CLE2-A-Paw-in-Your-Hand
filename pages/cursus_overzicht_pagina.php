<?php
/** @var mysqli $db */
require_once 'includes/connection.php';

if (!isset($_GET['id'])) {
    die('Reservation ID is required.');
}

$reservationId = intval($_GET['id']);

$query = "
    SELECT reservations.*, courses.title
    FROM reservations
    JOIN courses ON reservations.course = courses.course_id
    WHERE reservations.reservation_id = $reservationId
";

$result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db) . ' with query ' . $query);

$reservation = mysqli_fetch_assoc($result);
if (!$reservation) {
    die('Reservation not found.');
}

mysqli_close($db);
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Detail</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>
<body>
<main class="m-6">
    <div class="box">
        <h1 class="title">Reservation Details</h1>
        <p><strong>Course:</strong> <?= htmlspecialchars($reservation['title']) ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($reservation['date']) ?></p>
        <p><strong>Time:</strong> <?= htmlspecialchars($reservation['timeslot']) ?></p>
        <p><strong>Client Name:</strong> <?= htmlspecialchars($reservation['name']) ?></p>
        <p><strong>Dog Amount:</strong> <?= htmlspecialchars($reservation['dog_amount']) ?></p>
        <p><strong>Phone Number:</strong> <?= htmlspecialchars($reservation['phone_number']) ?></p>
        <p><strong>Question:</strong> <?= htmlspecialchars($reservation['question']) ?></p>
    </div>
</main>
</body>
</html>
