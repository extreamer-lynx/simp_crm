<?php
/**
 * @var $Avatar string
 * @var $Result string
 */
?>
<style>
    a:hover {
        text-decoration: none;
    }

</style>
<script src="/files/scripts/fileOut.js"></script>
<script src="/files/scripts/formsend.js"></script>
<div class="modal" id="resultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Результат</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $Result ?>
            </div>
            <div class="modal-footer">
                <a type="submit" id="buttonResult" class="btn btn-secondary" data-dismiss="modal">Закрити</a>
            </div>
        </div>
    </div>
</div>

<div class="container bootstrap snippet pt-3">
    <div class="row">
        <div class="col-sm-3"><!--left col-->
            <div class="text-center">
                <?php if ($Avatar == null): ?>
                    <img src="/files/avatars/default.png" class="avatar img-thumbnail" id="avatar"
                         alt="avatar">
                <?php else: ?>
                    <img src="/files/avatars/<?= $Avatar ?>" class="avatar img-thumbnail" id="avatar"
                         alt="avatar">
                <?php endif; ?>
                <br>
                <h4>Завантажити аватар</h4>
                <form id="sendPhoto" method="post">
                    <input type="file" class="js-photos mt-3 text-center center-block file-upload">
                    <br>
                    <div id="progressStatus"></div>
                    <br>
                    <button type="submit" class="mt-3 btn btn-secondary">Змінити</button>
                </form>
                <br>
            </div>
            </hr><br>
        </div><!--/col-3-->
        <div class="col-sm-9">
            <div class="nav nav-tabs p-2 " role="tablist">
                <a href="#settings" class="text-dark nav-item nav-link active"
                   aria-controls="settings" role="tab"
                   data-toggle="tab">Налаштування контактів</a></a>
                <a href="#settingsPass" class="text-dark nav-item nav-link"
                   aria-controls="settingsPass" role="tab"
                   data-toggle="tab">Зміна пароля</a></li>
            </div>

            <div class="tab-content">
                <div class="tab-pane active" id="settings">
                    <form class="form" id="changeContentForm">
                        <br>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="first_name"><h4>Імя</h4></label>
                                <input type="text" class="form-control" name="name" id="first_name" placeholder="Імя"
                                       title="Введіть імя.">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="last_name"><h4>Прізвище</h4></label>
                                <input type="text" class="form-control" name="sname" id="last_name"
                                       placeholder="Прізвище" title="Введіть прізвище.">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="mobile"><h4>Телефон</h4></label>
                                <input type="text" class="form-control" name="telephone" id="mobile"
                                       placeholder="Телефон"
                                       title="Телефон.">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="email"><h4>Email</h4></label>
                                <input type="email" class="form-control" name="login" id="email"
                                       placeholder="you@email.com" title="enter your email.">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <button class="btn btn-lg btn-secondary pull-right" type="submit"><i
                                            class="glyphicon glyphicon-ok-sign"></i> Зберегти
                                </button>
                                <input class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i>
                                </input>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="settingsPass">
                    <form class="form" id="formPass">
                        <br>
                        <h2>Зміна паролю</h2>
                        <br>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="password"><h4>Старий пароль</h4></label>
                                <input type="password" class="form-control" name="oldpassword" id="password"
                                       placeholder="Старий пароль" title="Введіть пароль.">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="password"><h4>Пароль</h4></label>
                                <input type="password" class="form-control" name="password" id="password"
                                       placeholder="Новий пароль" title="Введіть пароль.">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="password2"><h4>Підтвердіть пароль</h4></label>
                                <input type="password" class="form-control" name="password2" id="password2"
                                       placeholder="Підтвердіть пароль" title="Підтвердіть пароль.">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <button class="btn btn-lg btn-secondary pull-right" type="submit"><i
                                            class="glyphicon glyphicon-ok-sign"></i> Зберегти
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!--/tab-pane-->
        </div><!--/tab-content-->
    </div><!--/col-9-->
</div><!--/row-->