<?php


namespace controllers;

use core\Controller;

/**
*/
class News extends Controller
{
    public function actionIndex(){

    return $this->render('index',['count'=>10],['Title'=>'Новини'],['info'=>"<h1>цікаві новини</h1><br> <div class='content'>гшкуцнкшгцу</div>"]);

    }
   public function actionList(){
      // echo "<h1>цікаві новини</h1><br> <div class='content'>гшкуцнкшгцу</div>";
   }

}