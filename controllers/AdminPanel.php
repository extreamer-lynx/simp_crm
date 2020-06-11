<?php


namespace controllers;


use core\Controller;
use models\Info;
use models\Products;
use models\User;

class AdminPanel extends Controller
{
    private $product;
    private $user;
    private $adminData;
    private $help;


    public function __construct()
    {
        $this->product = new Products();
        $this->user = new User();
        $this->help = new Info();
        $id = $this->getUser()['user_id'];
        global $core;
        $this->adminData = $core->getDB()->executeQuery((new \core\DBQuery('users'))->select('*')->where(['user_id' => $id])->one());
    }

    public function actionIndex()
    {
        if ($this->adminData['role'] == 'admin') {
            $categoryes = $this->product->getCategory();
            $categoryString = '';
            foreach ($categoryes as $category) {
                $categoryString = $categoryString . "
                        <option  name=\"{$category['name']}\">
                            {$category['ua_name']}
                        </option>
                    ";
            }
            $sells = $this->product->getSellsList();
            $us = $this->user->getProfiles();
            return $this->render('index', ['Category' => $categoryString . '', 'AccsList' => $us, 'SellsList' => $sells], ['Title' => 'Admin Панель']);
        }
    }

    //функції товару
    public function actionAddProd()
    {
        if ($this->isPost()) {
            if ($this->adminData['role'] == 'admin') {
                $post = $this->getFilter(['name', 'cost', 'description', 'category', 'count']);
                $res = $this->product->addProd($post);
                if(strlen($res) > 0) {
                    return $this->render('query', ['Res' => '<h1 id="resultQuery">' . json_encode(['success' => 0, 'text' => $res]) . '</h1>'],
                        ['Title' => 'Admin Панель']);
                }
                else
                {
                    return $this->render('query', ['Res' => '<h1 id="resultQuery">' . json_encode(['success' => 1, 'text' => 'Товар було додано']) . '</h1>'],
                        ['Title' => 'Admin Панель']);
                }
            }
        }
    }

    public function actionDelProd()
    {
        if ($this->isPost()) {
            if ($this->adminData['role'] == 'admin') {
                global $core;
                $query = new \core\DBQuery('products');
                $query->delete()->where(['id' => $_POST['id']]);
                $core->GetDB()->executeQuery($query);
                return $this->render('query', ['Res' => '<h1 id="resultQuery">'.json_encode(['success' => 1, 'text' => 'Товар було видалено']).'</h1>'],
                    ['Title' => 'Admin Панель']);

            }
        }
    }

    public function actionDeleteProd()
    {
        if ($this->isPost()) {
            if ($this->adminData['role'] == 'admin') {
                global $core;
                $query = new \core\DBQuery('users');
                $query->delete()->where(['user_id' => $_POST['id']]);
                $core->GetDB()->executeQuery($query);
                return $this->render('query', ['Res' => '<h1 id="resultQuery">'.json_encode(['success' => 1, 'text' => 'Користувача було видалено']).'</h1>'],
                    ['Title' => 'Admin Панель']);

            }
        }
    }

    public function actionChangeStatus()
    {
        if ($this->isPost()) {
            if ($this->adminData['role'] == 'admin') {
                $post = $this->postFilter(['id', 'status']);
                global $core;
                $query = new \core\DBQuery('sells');
                if($post['status'] == 0)
                {
                    $query->update(['status' => '1'])->where(['id_sell' => $post['id']]);
                    $core->GetDB()->executeQuery($query);
                }
                else
                {
                    $query->update(['status' => null])->where(['id_sell' => $post['id']]);
                    $core->GetDB()->executeQuery($query);
                }
                return $this->render('query', ['Res' => '<h1 id="resultQuery">'.json_encode(['success' => 1, 'text' => 'Статус Змінено']).'</h1>'],
                    ['Title' => 'Admin Панель']);

            }
        }
    }

    public function actionCategoryAdd()
    {
        if ($this->isPost()) {
            if ($this->adminData['role'] == 'admin') {
                $post = $this->postFilter(['name', 'ua_name']);
                if ($post['name'] == '' or $post['ua_name'] == '')
                {
                    return $this->render('query', ['Res' => '<h1 id="resultQuery">'.json_encode(['success' => 0, 'text' => 'Введіть данні']).'</h1>'],
                        ['Title' => 'Admin Панель']);
                }
                else
                {
                    $this->product->categoryAdd($post);
                    return $this->render('query', ['Res' => '<h1 id="resultQuery">'.json_encode(['success' => 1, 'text' => 'Категорію додано']).'</h1>'],
                        ['Title' => 'Admin Панель']);
                }
            }
        }
    }

    //Користувацькі функції
    public function actionCategoryDel()
    {
        if ($this->isPost()) {
            if ($this->adminData['role'] == 'admin') {
                $post = $this->postFilter(['name']);
                if ($post['name'] == '')
                {
                    return $this->render('query', ['Res' => '<h1 id="resultQuery">'.json_encode(['success' => 0, 'text' => 'Введіть данні']).'</h1>'],
                        ['Title' => 'Admin Панель']);
                }
                else
                {
                    $this->product->categoryDel($post);
                    return $this->render('query', ['Res' => '<h1 id="resultQuery">'.json_encode(['success' => 1, 'text' => 'Категорію додано']).'</h1>'],
                        ['Title' => 'Admin Панель']);
                }
            }
        }
    }


    //Змінити help
    public function actionChangeHelp()
    {
        if ($this->isPost()) {
            if ($this->adminData['role'] == 'admin') {

            }
        }
    }
}