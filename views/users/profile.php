<?php
/**
 * @var $Avatar string
 * @var $Name string
 * @var $Sname string
 * @var $Telephone string
 */
?>

<div class="modal" tabindex="-1" role="dialog">
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
                <?php if ($Avatar == null): ?>
                    <img src="/files/avatars/default.png" class="avatar img-thumbnail" id="avatar"
                         alt="avatar">
                <?php else: ?>
                    <img src="/files/avatars/<?= $Avatar ?>" class="avatar img-thumbnail" id="avatar"
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
                                <h4>Імя: <?=$Name?></h4>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <h4>Прізвище: <?=$Sname?></h4>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <h4>Телефон: <?=$Telephone?></h4>
                            </div>
                        </div>
                </div>
            </div><!--/tab-pane-->
        </div><!--/tab-content-->

    </div><!--/col-9-->
</div><!--/row-->