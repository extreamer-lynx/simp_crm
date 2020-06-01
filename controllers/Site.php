<?php


namespace controllers;


class Site
{
public function actionIndex(){
    $result=[
        'Title'=>'Заголовок',
        'Content'=>'Контент'
    ];
return $result;
}
}