<?php
/**
 * @var $Title string
 * @var $Content string
 * @var $User string генератиор логіну
 */
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title><?= $Title ?></title>
</head>
<body>

<!-- Коробка логіна\реєстрації-->
<div id="myModal" class="modal fade">
    <div class="modal-dialog text-center text-light">
        <div class="modal-content bg-dark">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-5 border-right border-light mr-3">
                            <form method="post" action="/users/login">
                                <p>
                                <h1 class="h3 mb-3 font-weight-normal">Вхід</h1></p>
                                <p class="mt-1 text-left">Логін:
                                    <input type="email" id="inputEmail" name="login" class="form-control mb-2 mt-1"
                                           placeholder="Email address" required autofocus></p>
                                <p class="mt-2 text-left">Пароль:
                                    <input type="password" id="inputPassword" name="password"
                                           class="form-control mb-2 mt-1"
                                           placeholder="Password" required></p>
                                <button class="btn btn-lg btn-secondary btn-block mb-2" type="submit">Ввійти</button>
                            </form>
                        </div>
                        <div class="col-5">
                            <form method="post" action="/users/registration">
                                <p>
                                <h1 class="h3 mb-3 font-weight-normal">Реєстрація</h1></p>
                                <p class="mt-1 text-left">Імя:
                                    <input type="text" name="name" class="form-control mb-2 mt-1"
                                           placeholder="Імя" required autofocus></p>
                                <p class="mt-2 text-left">Прізвище:
                                    <input type="text" name="sname" class="form-control mb-2 mt-1"
                                           placeholder="Прізвище" required></p>
                                <p class="mt-1 text-left">Логін:
                                    <input type="email" name="login" class="form-control mb-2 mt-1"
                                           placeholder="Email" required autofocus></p>
                                <p class="mt-2 text-left">Пароль:
                                    <input type="password" name="password" id="inputPassword"
                                           class="form-control mb-2 mt-1"
                                           placeholder="Password" required></p>
                                <p class="mt-2 text-left">Повторіть пароль:
                                    <input type="password" name="spassword" class="form-control mb-2 mt-1"
                                           placeholder="Пароль" required></p>
                                <p class="mt-1 text-left">Телефон:
                                    <input type="tel" name="telephone" class="form-control mb-2 mt-1"
                                           placeholder="Телефон" required autofocus></p>
                                <button class="btn btn-lg btn-secondary btn-block mb-2" type="submit">Реєстрація
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <img src="/files/icon.svg" alt="" width="54" height="54">
    <a class="navbar-brand" href="/">Guitar Shop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="btn-dark nav-link" href="/helpinfo/">Допомога<span
                            class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="btn-dark nav-link" href="/helpinfo/searchinfo">Де нас знайти</a>
            </li>
            <li class="nav-item active">
                <a class="btn-dark nav-link" href="/helpinfo/aboutUs">Про нас</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="post" action="?search">
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Введіть щоб знайти" aria-label="Пошук">
            <button class="btn btn-dark my-2 my-sm-0" type="submit">Знайти</button>
        </form>
        <?= $User ?>
    </div>
</nav>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>

<?= $Content ?>

</body>

<footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2020 Guitar Shop</p>
</footer>
</html>