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
            <form class="form-signin" method="post" action="/users/registration">
                <img class="mb-4" src="/files/icon.svg" alt="" width="64" height="64">
                <p>
                <h1 class="h3 mb-3 font-weight-normal">Реєстрація</h1></p>
                <h4 class="h5 mb-3 font-weight-normal text-danger text-left">
                    <ul>
                        <?php
                        if($Info != null)
                        foreach ($Info as $items):?>
                            <li><?=$items?></li>
                        <?php endforeach;?>
                    </ul>
                </h4>
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
                    <input type="password" name="password" id="inputPassword" class="form-control mb-2 mt-1"
                           placeholder="Password" required></p>
                <p class="mt-2 text-left">Повторіть пароль:
                    <input type="password" name="spassword" class="form-control mb-2 mt-1"
                           placeholder="Password" required></p>
                <p class="mt-1 text-left">Телефон:
                    <input type="tel" name="telephone" class="form-control mb-2 mt-1"
                           placeholder="Телефон" required autofocus></p>

                <button class="btn btn-lg btn-secondary btn-block mb-2" type="submit">Реєстрація</button>
            </form>
        </div>
        <div class="col">
        </div>
    </div>
</div>