<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello Bulma!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="/CSS/style.css">
</head>
<body>
<nav class="navbar">
    <div id="navbarBasic" class="navbar-menu my-5 mx-5">
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
        <div class="navbar-end">
            <div class="navbar-item">
                <img src="/images/pupp_darkGreen.png" height="100">
            </div>
        </div>
    </div>
</nav>
<header></header>
<main>
    <?php if (isset($courses)):

        foreach ($courses as $course):
            ?>
            <section class="course-container mx-2 my-2">
                <h1><?= $course['title'] ?></h1>
                <p><?= $course['short_info'] ?></p>
                <div class="image is-128x128">
                    <img src="/includes/images/<?= $course['image'] ?>" alt="image">
                </div>
                <a href="#">Details</a>
            </section>
        <?php
        endforeach;
    endif;
    ?>

</main>
<footer class=" bg-footer-top pt-5">
    <div class="bg-footer columns">
        <img src="/images/pupp_darkGreen.png" width="100">
        <p class="column is-align-self-flex-end is-size-3 has-text-weight-semibold">A Paw in Your Hand</p>
    </div>
</footer>
</body>
</html>
