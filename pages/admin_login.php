<!doctype html>
<html lang="nl" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>admin login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="/CSS/style.css">
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

<main>
    <h1 class="has-text-centered mt-6 is-size-2 has-text-weight-semibold">Log in</h1>

    <h2 class="has-text-centered mt-6 is-size-4">Gebruikersnaam</h2>
    <div class="columns is-centered my-4">
        <div class="column is-4">
            <div class="control">
                <input class="input" type="text" placeholder="Gebruikersnaam">
            </div>
        </div>
    </div>
    <h2 class="has-text-centered mt-6 is-size-4">Wachtwoord</h2>
    <div class="columns is-centered my-4">
        <div class="column is-4">
            <div class="control">
                <input class="input" type="text" placeholder="Wachtwoord">
            </div>
        </div>
    </div>
    <div class="columns is-centered my-6">
        <button class="button is-large is-responsive column is-3">
            Log in
        </button>
    </div>
</main>

<footer class=" bg-footer-top pt-5">
    <div class="bg-footer columns">
        <img src="/pages/includes/images/pupp_darkGreen.png" width="100">
        <p class="column is-align-self-flex-end is-size-3 has-text-weight-semibold">A Paw in Your Hand</p>
    </div>
</footer>
</body>
</html>