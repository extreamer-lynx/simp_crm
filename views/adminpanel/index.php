<?php
/**
 * @var $Avatar string
 * @var $Result string
 * @var $Category string
 * @var $AccsList string
 * @var $SellsList string
 */
?>
<style>
    a:hover {
        text-decoration: none;
    }

</style>

<!--<script src="/files/scripts/admin/dataUp.js"></script>-->
<script src="/files/scripts/admin/fileCreate.js"></script>
<script src="/files/scripts/admin/formsend.js"></script>

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

<div class="container bootstrap snippet pt-1">
    <div class="row">
        <div class="col">
            <div class="nav nav-tabs p-2 " role="tablist">
                <a href="#sells" class="text-dark nav-item nav-link active"
                   aria-controls="sells" role="tab"
                   data-toggle="tab">Замовлення</a></li>
                <a href="#settingsProducts" class="text-dark nav-item nav-link"
                   aria-controls="settingsProducts" role="tab"
                   data-toggle="tab">Керування товарами</a></li>
                <a href="#settingsUsers" class="text-dark nav-item nav-link"
                   aria-controls="settingsUsers" role="tab"
                   data-toggle="tab">Керування користувачами</a></li>
            </div>


            <div class="tab-content">

                <!--Sells-->
                <div class="tab-pane active" id="sells">
                    <form class="form" id="sells">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">ID Користувача</th>
                                <th scope="col">ID Продукту</th>
                                <th scope="col">Дата замовлення</th>
                                <th scope="col">Статус</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?=$SellsList?>
                            </tbody>
                        </table>
                    </form>
                </div>

                <!--Products-->
                <div class="tab-pane" id="settingsProducts">
                    <div class="nav nav-tabs p-2 " role="tablist">
                        <a href="#addProduct" class="text-dark nav-item nav-link active"
                           aria-controls="sells" role="tab"
                           data-toggle="tab">Додати товар</a></li>
                        <a href="#settingsActual" class="text-dark nav-item nav-link"
                           aria-controls="settingsActual" role="tab"
                           data-toggle="tab">Керування існуючими</a></a>
                    </div>

                    <br>
                    <div class="tab-content active">
                        <!--helpSettings-->
                        <div class="tab-pane active" id="addProduct">
                            <form id="addProduct">
                                <div class="row">

                                    <div class="col-sm-3"><!--left col-->
                                        <div class="text-center">
                                            <img src="/files/product/default.png" class="avatar img-thumbnail"
                                                 id="avatar"
                                                 alt="avatar">
                                            <br>
                                            <h4>Завантажити фото товару</h4>
                                            <input type="file"
                                                   class="js-photos mt-3 text-center center-block file-upload">
                                            <br>
                                            <div id="progressStatus"></div>
                                            <br>

                                            <br>
                                        </div>
                                        </hr><br>
                                    </div><!--/col-3-->
                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <div class="col-xs-6">
                                                <label for="text"><h4>Назва</h4></label>
                                                <input type="text" class="form-control" name="name" id="text"
                                                       placeholder="Назва товару" title="Введіть назву товару.">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-6">
                                                <label for="text"><h4>Ціна</h4></label>
                                                <input type="text" class="form-control" name="cost"
                                                       placeholder="Ціна товару" title="Кількість.">
                                            </div>
                                        </div>
                                        <div class="form-group" id="thatsCategory">
                                            <label for="exampleFormControlSelect1"><h4>Категорія</h4></label>
                                            <select class="form-control" name="category" id="categoryFrom">
                                                <?= $Category ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-6">
                                                <label for="password21"><h4>Кількість на складі</h4></label>
                                                <input type="text" class="form-control" name="count" id="count"
                                                       placeholder="Кількість" title="Кількість.">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1"><h4>Описання</h4></label>
                                            <textarea class="form-control" name="description"
                                                      id="exampleFormControlTextarea1"
                                                      rows="3"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <br>
                                                <button class="btn btn-lg btn-secondary pull-right" type="submit"><i
                                                            class="glyphicon glyphicon-ok-sign"></i> Зберегти
                                                </button>
                                                <input class="btn btn-lg" type="reset"><i
                                                        class="glyphicon glyphicon-repeat"></i>
                                                </input>
                                            </div>
                                        </div>
                                    </div>
                            </form>

                            <br>
                        </div>
                    </div>
                    <div class="tab-pane" id="settingsActual">
                        <div class="row">
                            <div class="col-xs-12">
                                <form class="form" id="categoryAdd">
                                    <br>
                                    <h5>Додати категорію</h5>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1"><h6>Назва</h6></label>
                                        <input type="text" class="form-control" name="name"
                                               id="exampleFormControlTextarea1"
                                               rows="3"></input>
                                        <br>
                                        <label for="exampleFormControlTextarea1"><h6>Назва на англійському</h6>
                                        </label>
                                        <input type="text" class="form-control" name="ua_name"
                                               id="exampleFormControlTextarea1"
                                               rows="3"></input>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <br>
                                            <button class="btn btn-lg btn-secondary pull-right" type="submit"><i
                                                        class="glyphicon glyphicon-ok-sign"></i> Зберегти
                                            </button>
                                            <input class="btn btn-lg" type="reset"><i
                                                    class="glyphicon glyphicon-repeat"></i>
                                            </input>
                                        </div>
                                    </div>
                                </form>
                                <br>
                                <br>
                                <form class="form" id="categoryDel">
                                    <br>
                                    <h5>Видалити категорію</h5>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1"><h6>Назва на англійському</h6>
                                        </label>
                                        <input type="text" class="form-control" name="name"
                                               id="exampleFormControlTextarea1"
                                               rows="3"></input>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <br>
                                            <button class="btn btn-lg btn-secondary pull-right" type="submit"><i
                                                        class="glyphicon glyphicon-ok-sign"></i> Видалити
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-xs-12 pl-4">
                                <form class="form" id="delProd">
                                    <br>
                                    <h5>Видалити товар</h5>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1"><h6>ID товару</h6></label>
                                        <input type="text" class="form-control" name="id"
                                               id="exampleFormControlTextarea1"
                                               rows="3"></input>

                                    </div>

                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <br>
                                            <button class="btn btn-lg btn-secondary pull-right" type="submit"><i
                                                        class="glyphicon glyphicon-ok-sign"></i> Видалити
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--Users-->
            <div class="tab-pane " id="settingsUsers">
                <form id="userList" class="form">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Імя</th>
                            <th scope="col">Прізвище</th>
                            <th scope="col">Номер</th>
                            <th scope="col">Дія</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?= $AccsList ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div><!--/tab-content-->
    </div><!--/col-9-->
</div><!--/row-->
</div>