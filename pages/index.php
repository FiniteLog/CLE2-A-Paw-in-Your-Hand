<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello Bulma!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="includes/css/style.css">
</head>
<body style="background-repeat: no-repeat; background-size: cover;">
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
            <div class="navbar-image">
                <img src="includes/images/pupp_darkGreen.png" height="100px" class="logo">
            </div>
    </div>
</nav>
<main>
    <h1> Welcome </h1>
    <section class="box custom-box columns is-centered is-variable is-8 mx-2 my-2">
        <div class="column is-narrow">
            <img src="includes/images/Puppies.jpg" alt="placeholder" class="image is-128x128">
        </div>
        <div class="column is-flex is-flex-direction-column p-4">
            <h2>Article Title</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, dolorem ipsa laborum omnis placeat
                quaerat tempora voluptatibus. Ad, amet assumenda deserunt doloremque excepturi exercitationem fugit
                pariatur porro quod saepe, sapiente.</p>
        </div>
    </section>
    <section class="box custom-box columns is-centered is-variable is-8 mx-2 ">
        <div class="column is-flex is-flex-direction-column p-4">
            <h2>Article Title</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, dolorem ipsa laborum omnis placeat
                quaerat tempora voluptatibus. Ad, amet assumenda deserunt doloremque excepturi exercitationem fugit
                pariatur porro quod saepe, sapiente.</p>
        </div>
        <div class="column is-narrow">
            <img src="includes/images/DogOnFence.jpg" alt="Placeholder" class="image is-128x128">
        </div>
    </section>
</main>
<footer>
        <img src="includes/images/pupp_darkGreen.png" width="100px" class="logo">
        <p class="column is-align-self-flex-end is-size-4 has-text-weight-semibold">A Paw in Your Hand</p>
</footer>
</body>
</html>