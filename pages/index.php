<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome! - A Paw in Your Hand</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="includes/css/style.css">
    <link rel="icon" href="includes/images/pupp_darkGreen.png">
</head>
<body style="background-repeat: no-repeat; background-size: cover; background-image: url('includes/css/bg4.jpg');">
<nav class="navbar">
    <div id="navbarBasic" class="navbar-menu px-6">
        <div class="navbar-start">
            <a href="index.php" class="navbar-item custom-margin" style="background-color: #2CDB43; color: black;">
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
            <a href="reviews.php" class="navbar-item custom-margin">
                Reviews
            </a>
        </div>
        <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">

    </div>
</nav>
<main>
    <h1 style="margin-top: 2%;"> Welcome </h1>
    <section class="section_ind columns is-centered is-variable is-8 mx-4" style="margin-top: 5%;">
        <img src="includes/images/bordercollie.png" alt="placeholder" class="images_ind" style="width: 20%;">
        <!--image is-128x128-->
        <div class="column is-flex is-flex-direction-column p-4">
            <h2 style="font-weight: bold;">Article Title</h2>
            <p style="width: 90%;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, dolorem ipsa
                laborum omnis placeat
                quaerat tempora voluptatibus. Ad, amet assumenda deserunt doloremque excepturi exercitationem fugit
                pariatur porro quod saepe, sapiente.</p>
        </div>
    </section>
    <section class="section_ind columns is-centered is-variable is-8 mx-4" style="margin-top: 5%; text-align: right;">
        <div class="column is-flex is-flex-direction-column p-4">
            <h2 style="font-weight: bold;">Article Title</h2>
            <p style="margin-left: 10%;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, dolorem ipsa
                laborum omnis placeat
                quaerat tempora voluptatibus. Ad, amet assumenda deserunt doloremque excepturi exercitationem fugit
                pariatur porro quod saepe, sapiente.</p>
        </div>
        <img src="includes/images/DogOnFence.jpg" alt="Placeholder" class="images_ind" style="width: 20%; height: 20%;">
    </section>
</main>
<footer>
    <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
    <p class="column is-align-self-flex-end is-size-4 has-text-weight-semibold">A Paw in Your Hand</p>
    <a class="is-flex is-justify-content-right is-align-self-flex-end" href="reviews.php">Reviews</a>
    <div style="display: flex; flex-flow: column; margin-top: 2%; margin-right: 3%;">
        <a href="mailto:email@example.com" style="color: black; text-decoration: underline;">emaillesgevende@email.com</a>
        <p>+31 6 12345678</p>
    </div>
</footer>
</body>
</html>