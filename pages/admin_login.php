<?php
/** @var mysqli $db */
session_start();
require_once 'includes/connection.php';

$login = false;
// Is admin logged in?
$errors = []; // Initialize errors array

// Check if form is submitted
if (isset($_POST['submit'])) {

    // Get form data
    $username = mysqli_real_escape_string($db, $_POST['username'] ?? '');
    $password = mysqli_real_escape_string($db, $_POST['password'] ?? '');

    // Server-side validation
    if ($username === "") {
        $errors['username'] = "Enter a name";
    }
    if ($password === "") {
        $errors['password'] = "Enter a password";
    }

    // Proceed only if there are no validation errors
    if (empty($errors)) {
        // SELECT the admin from the database, based on the name
        $loginQuery = "SELECT * FROM admins WHERE username = ?";
        $stmt = $db->prepare($loginQuery);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the admin exists
        if ($result->num_rows === 1) {
            // Get admin data from result
            $admin = $result->fetch_assoc();

            // Check if the provided password matches the stored password in the database
//            if (password_verify($password, $admin['password'])) {
            if ($password === $admin['password']) {

                // Password is correct

                // Store the admin in the session
                $_SESSION['admin'] = $admin; // Assuming admin details are stored in session

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
<nav class="navbar is-primary">
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="index.php">
                Home
            </a>
            <a class="navbar-item" href="reservering.php">
                Inschrijven
            </a>
            <a class="navbar-item" href="gebruiker_cursus_overzicht.php">
                Cursussen
            </a>
        </div>
    </div>
</nav>
<main>
    <h1 class="has-text-centered mt-6 is-size-2 has-text-weight-semibold">Log in</h1>
    <form class="column" action="" method="post">

        <div class="">
            <div class="has-text-centered">
                <label class="has-text-centered mt-6 is-size-4" for="username">Gebruikersnaam</label>
            </div>
            <div class="columns is-centered my-4">
                <div class="column is-4">
                    <div class="control">
                        <input class="input" id="username" type="text" name="username" placeholder="Gebruikersnaam"
                               value="<?= $username ?? '' ?>"/>
                        <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                    </div>
                    <p class="help is-danger">
                        <?= $errors['username'] ?? '' ?>
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