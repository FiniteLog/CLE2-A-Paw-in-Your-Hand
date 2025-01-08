<!doctype html>
<html lang="nl" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>reservering</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="/CSS/style.css"

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

<main class="m-6">
    <div class="bg-footer box mx-3">

        <div class="columns mx-6">
            <button class="column is-narrow button mx-2">week 1</button>
            <button class="column is-narrow button mx-2">week 2</button>
            <button class="column is-narrow button mx-2">week 3</button>
            <button class="column is-narrow button mx-2">week 4</button>
        </div>

        <div class="bg-footer-top box">

            <div class="bg-footer box columns">
                <p class="column box pb-6 is-radiusless ">Ma</p>
                <p class="column box pb-6 is-radiusless ">Di</p>
                <p class="column box pb-6 is-radiusless ">Wo</p>
                <p class="column box pb-6 is-radiusless ">Do</p>
                <p class="column box pb-6 is-radiusless ">Vr</p>
                <p class="column box pb-6 is-radiusless ">Za</p>
                <p class="column box pb-6 is-radiusless box-last">Zo</p>
            </div>

            <div class="bg-footer box mt-4 columns is-multiline is-centered">
                <div class="box column is-3 mx-4">
                    <p>Aantal honden</p>
                    <input class="box is-radiusless input" type="number">
                </div>
                <div class="box column is-3 mx-4">
                    <p>Cursus</p>
                    <div class="select is-fullwidth">
                        <select>
                            <option>Selecteer een cursus</option>
                            <option>pipi</option>
                            <option>poopoo</option>
                        </select>
                    </div>
                </div>
                <div class="box column is-3 mx-4">
                    <p>Selecteer een tijdslot</p>
                    <input class="box is-radiusless input" type="time">
                </div>
                <div class="column box is-4 mx-4">
                    <p>Uw naam</p>
                    <input class="box is-radiusless input" type="text">
                </div>
                <div class="column box is-4 mx-4 box-last">
                    <p>Telefoonnummer</p>
                    <input class="box is-radiusless input" type="tel">
                </div>
            </div>

            <div class="box bg-footer">
                <div class="px-6 is-half column container">
                    <h1 class="has-text-centered is-underlined is-size-5">Vraag?</h1>
                    <input class="box is-radiusless input" type="text">
                </div>
            </div>

        </div>
    </div>
</main>
<footer class=" bg-footer-top pt-5
                    ">
    <div class="bg-footer columns">
        <img src="/pages/includes/images/pupp_darkGreen.png" width="100">
        <p class="column is-align-self-flex-end is-size-3 has-text-weight-semibold">A Paw in Your Hand</p>
    </div>
</footer>
</body>
</html>
