<?php
/**
 * @var $image string
 * @var $name string
 * @var $category string
 * @var $cost string
 * @var $count string
 * @var $description string
 * @var $id string
 */
?>

<script src="/files/scripts/buyQuery.js"></script>

<div class="modal" tabindex="-1" role="dialog" id="resultModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Результат</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрити</button>
            </div>
        </div>
    </div>
</div>

<div class="container bootstrap snippet pt-3">
    <div class="row">
        <div class="col-sm-3"><!--left col-->
            <div class="text-center mt-3">
                <?php if ($image == null): ?>
                    <img src="/files/avatars/default.png" class="avatar img-thumbnail" id="avatar"
                         alt="avatar">
                <?php else: ?>
                    <img src="/files/product/<?= $image ?>" class="avatar img-thumbnail" id="avatar"
                         alt="avatar">
                <?php endif; ?>
                <br>
            </div>
            </hr><br>
        </div><!--/col-3-->
        <div class="tab-content">
            <div class="tab-pane active" id="settings">
                <br>
                <div class="form-group">
                    <div class="col-xs-6">
                        <h3><?=$name?></h3>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-6">
                        <h4>Категорія: <?=$category?></h4>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-6">
                        <h4>Ціна: <?=$cost?></h4>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-6">
                        <h4>Кількість: <?=$count?></h4>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-6">
                        <a id="buyButton" href="/site/buy?id=<?=$id?>" class="btn btn-secondary">Заказать</a>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-6">
                        <h4>Описання: <?=$description?></h4>
                    </div>
                </div>
            </div>
        </div><!--/tab-pane-->
    </div><!--/tab-content-->

</div><!--/col-9-->
</div><!--/row-->