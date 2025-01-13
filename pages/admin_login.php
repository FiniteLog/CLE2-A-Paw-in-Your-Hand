<?php
/** @var mysqli $db */
session_start();
require_once 'includes/connection.php';

$login = false;
// Is user logged in?
$errors = []; // Initialize errors array

// Check if form is submitted
if (isset($_POST['submit'])) {

    // Get form data
    $name = mysqli_real_escape_string($db, $_POST['name'] ?? '');
    $password = mysqli_real_escape_string($db, $_POST['password'] ?? '');

    // Server-side validation
    if ($name === "") {
        $errors['name'] = "Enter a name";
    }
    if ($password === "") {
        $errors['password'] = "Enter a password";
    }

    // Proceed only if there are no validation errors
    if (empty($errors)) {
        // SELECT the user from the database, based on the name
        $loginQuery = "SELECT * FROM admins WHERE name = ?";
        $stmt = $db->prepare($loginQuery);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result->num_rows === 1) {
            // Get user data from result
            $user = $result->fetch_assoc();

            // Check if the provided password matches the stored password in the database
//            if (password_verify($password, $user['password'])) {
            if ($password === $user['password']) {

                // Password is correct

                // Store the user in the session
                $_SESSION['user'] = $user; // Assuming user details are stored in session

                // Redirect to secure page
                header('Location: agenda.php');
                exit;
            } else {
                // Password is incorrect
                $errors['loginFailed'] = "Incorrect login credentials";
            }
        } else {
            // User doesn't exist
            $errors['loginFailed'] = "Invalid login credentials";
        }
    }
}
?>
<!doctype html>
<html lang="nl" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="includes/css/style.css">
    <title>admin login</title>
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
            <a href="gebruiker_cursus_overzicht.php" class="navbar-item custom-margin">
                Cursussen
            </a>
            <a href="admin_login.php" class="navbar-item custom-margin">
                Admin Login
            </a>
            <a href="agenda.php" class="navbar-item custom-margin">
                Agenda
            </a>
        </div>
        <div class="navbar-end">
            <div class="navbar-image">
                <img src="includes/images/pupp_darkGreen.png" height="100px">
            </div>
        </div>
    </div>
</nav>
<main>
    <h1 class="has-text-centered mt-6 is-size-2 has-text-weight-semibold">Log in</h1>
    <form class="column" action="" method="post">

        <div class="">
            <div class="has-text-centered">
                <label class="has-text-centered mt-6 is-size-4" for="name">Gebruikersnaam</label>
            </div>
            <div class="columns is-centered my-4">
                <div class="column is-4">
                    <div class="control">
                        <input class="input" id="name" type="text" name="name" placeholder="Gebruikersnaam"
                               value="<?= $name ?? '' ?>"/>
                        <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                    </div>
                    <p class="help is-danger">
                        <?= $errors['name'] ?? '' ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="">
            <div class="has-text-centered mt-6 is-size-4">
                <label class="columns is-centered my-4" for="password">Wachtwoord</label>
            </div>
            <div class="columns is-centered my-4">
                <div class="column is-4">
                    <div class="control">
                        <input class="input" id="password" type="password" name="password" placeholder="Wachtwoord"/>
                        <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>

                        <?php if (isset($errors['loginFailed'])) { ?>
                            <div class="notification is-danger">
                                <button class="delete"></button>
                                <?= $errors['loginFailed'] ?>
                            </div>
                        <?php } ?>

                    </div>
                    <p class="help is-danger">
                        <?= $errors['password'] ?? '' ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="columns is-centered my-6">
            <div class=""></div>
            <div class="">
                <button class="button is-large is-responsive column is-3" type="submit" name="submit">
                    Log in
                </button>
            </div>
        </div>

    </form>
</main>
<footer class=" bg-footer-top pt-5">
    <div class="bg-footer columns">
        <img src="/pages/includes/images/pupp_darkGreen.png" width="100">
        <p class="column is-align-self-flex-end is-size-3 has-text-weight-semibold">A Paw in Your Hand</p>
    </div>
</footer>
</body>
</html>