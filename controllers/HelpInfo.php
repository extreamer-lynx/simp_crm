<?php


namespace controllers;


use core\Controller;

class HelpInfo extends Controller
{

    public function __construct()
    {
        $this->Model = new \models\Info();
    }

    public function actionAboutUs(){

        return $this->render('index',
            [
            'Head' => 'Про нас',
            'Info'=> $this->Model->GetInfo('aboutus')
            ], ['Title'=>'Guitar Shop | Про нас']
        );
    }

    public function actionIndex(){

        return $this->render('index',
            [
                'Head' => 'Допомога',
                'Info'=> $this->Model->GetInfo('help')
            ], ['Title'=>'Guitar Shop | Допомога']
        );
    }

    public function actionSearchInfo(){

        return $this->render('searchinfo',
            [
                'Head' => 'Де нас знайти',
                'Info'=> $this->Model->GetInfo('findus'),
                'Coordinates' => $this->Model->GetCoordinates('findus')
            ],['Title'=>'Guitar Shop | Де нас знайти']
        );
    }
}