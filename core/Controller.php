<?php


namespace core;

/**
*Базовий клас для всіх контролерів
 *@package  core
 */
class Controller
{
    public function render($vieaName,$localParams=null,$globalParans=null)
    {
$tpl=new Template();
if(is_array($localParams))
$tpl->setParams($localParams);
if(!is_array($globalParans))
    $globalParans=[];
$moduleName=strtolower((new \ReflectionClass($this))->getShortName());
$globalParans['Content']=$tpl->render("./views/{$moduleName}/{$vieaName}.php");
return $globalParans;
    }

}