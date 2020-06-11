<?php
/**
 * @var $Info string
 */
?>

<div class="container">
    <div class="row align-items-center">
        <div class="col">
        </div>
        <div class="col text-center mt-5 pt-5">
            <form class="form-signin" method="post" action="/users/login">
                <img class="mb-4" src="/files/icon.svg" alt="" width="64" height="64">
                <h1 class="h3 mb-3 font-weight-normal">Ввійти</h1>
                <h4 class="h5 mb-3 font-weight-normal text-danger"><?=$Info?></h4>
                <label for="inputEmail" class="sr-only">Логін</label>
                <input type="email" id="inputEmail" name="login" class="form-control" placeholder="Логін" required autofocus>
                <label for="inputPassword" class="sr-only">Пароль</label>
                <input type="password" id="inputPassword" name="password" class="form-control mb-4" placeholder="Пароль" required>
                <div class="container">
                    <div class="row row-cols-1 row-cols-sm-2 ">
                        <div class="col"><button class="btn btn-lg btn-secondary btn-block" type="submit">Ввійти</button></div>
                        <div class="col"><a class="btn btn-lg btn-secondary btn-block" href="/users/registration">Реєстрація</a></div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col">
        </div>
    </div>
</div>