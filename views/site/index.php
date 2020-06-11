<?php
/**
 * @var $Category string
 * @var $Lable string
 * @var $Product string
 */
?>
<div class="container-fluid">
    <div class="row">
       <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="sidebar-sticky p t-3 pb-2">
                <ul class="nav flex-column ">
                    <?=$Category?>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2" id="label"><?=$Lable?></h1>
            </div>

            <div class="row" id="products">
                <?=$Product?>
            </div>
        </main>
    </div>
</div>