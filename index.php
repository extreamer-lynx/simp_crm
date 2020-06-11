<?php
include ('./config/config.php');
include ('./core/Core.php');
$core=\core\Core::detInstance();
$core->init();
$core->run();
$core->done();