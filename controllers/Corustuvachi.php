<?php


namespace controllers;


class Corustuvachi
{
    public function actionIndex(){


        return $result=[
            'Title'=>'Користувачі',
            'Content'=>'Перелік користувачів'
        ];
    }
}