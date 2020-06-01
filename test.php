<?php
include ('./config/config.php');
include ('./core/DB.php');
include ('./core/DBQuery.php');
$query=new \core\DBQuery('users');
$query->select()->where([]);
$db=new \core\DB($CMSConfig['Database']['Server'],$CMSConfig['Database']['User'],$CMSConfig['Database']['Password'],$CMSConfig['Database']['Database']);
$res=$db->executeQuery($query);
var_dump($res);