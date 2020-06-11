<?php


namespace controllers;

use core\Controller;

class Site extends Controller
{
    private $Products;

    public function __construct()
    {
        $this->Products = new \models\Products();
    }

    public function actionIndex()
    {
        $categoryString = $this->categoryRender($this->Products->getCategory());
        if ($this->isGet()) {
            $get = $this->getFilter(['category']);
            if($get['category'] != null)
            {
                $category = $this->Products->getOneEngCategory($get['category']);
                $ret = $this->renderProducts($this->Products->getProductByCategory($get['category']));
                return $this->render('index', ['Category' => $categoryString, 'Lable' => $category['ua_name'], 'Product' => $ret]
                    , ['Title' => 'Guitar Shop']);

            }

            $ret = $this->renderProducts($this->Products->getAllProduct());
            return $this->render('index', ['Category' => $categoryString, 'Lable' => 'Нові товари', 'Product' => $ret], ['Title' => 'Guitar Shop']);
        }
        if($this->isPost())
        {
            $post = $this->postFilter(['search']);
            if($post['search'] != null)
            {
                $ret = $this->renderProducts($this->Products->getProductByName($post['search']));
                return $this->render('index', ['Category' => $categoryString, 'Lable' => 'Пошук по запиту '.$post['search'], 'Product' => $ret]
                    , ['Title' => 'Guitar Shop']);
            }
        }
    }

    private function categoryRender($categoryes)
    {
        $categoryString = '';
        foreach ($categoryes as $category) {
            $categoryString = $categoryString . "<li class=\"nav-item \">
                        <a id=\"categoryButton\" class=\"nav-link text-dark btn\" href=\"?category={$category['name']}\">
                            <span data-feather=\"layers\" ></span>
                            {$category['ua_name']}
                        </a>
                    </li>";
        }
        return $categoryString;
    }

    public function actionProduct()
    {
        if ($this->isGet()) {
            $id = $this->getFilter(['id']);
            if ($id == null) {
                $product = $this->Products->getProduct(1);
                $product['category'] = $this->Products->getOneEngCategory($product['category'])['ua_name'];
                return $this->render('product', $product, ['Title' => $product['name'] . ' | Guitar Shop']);
            } else {
                $product = $this->Products->getProduct($id['id']);
                $product['category'] = $this->Products->getOneEngCategory($product['category'])['ua_name'];
                return $this->render('product', $product, ['Title' => $product['name'] . ' | Guitar Shop']);
            }
        }
    }

    private function renderProducts($prod)
    {
        $res = '';
        foreach ($prod as $product) {
            $res = $res . "<div class=\"product col-md-3 col-sm-4 col-xs-12\">
    <div class=\"img-wrapper justify-content-center text-center mt-3\"><img class=\"avatar img-thumbnail\" src=\"/files/product/{$product['image']}\">
    </div>
    <div class=\"product-name name-wrapper mt-2\">{$product['name']}</div>
    <div class=\"product-cost cost-wrapper mt-2\"><strong>Ціна: {$product['cost']}</strong></div>
    <p class=\"mt-2\"><a href=\"/products/about/11\">
            <a class=\"btn btn-secondary \" href=\"/site/product?id={$product['id']}\">Детальніше</a>
        </a></p>
</div>";
        }
        return $res;
    }

    public function actionBuy()
    {
        if ($this->isGet()) {
            $id = $this->getFilter(['id']);
            $user = $this->getUser();
            if ($id['id'] != null) {
                if (count($user) != null) {
                    $this->Products->buyAction(['user_id' => $user['user_id'], 'id_products' => $id['id']]);
                    return $this->render('query', ['Res' => '<h1 id="resultQuery">' . json_encode(['success' => 1, 'text' => 'Заказ зроблено']) . '</h1>'], ['Title' => 'Guitar Shop']);
                }
            }

            return $this->render('query', ['Res' => '<h1 id="resultQuery">' . json_encode(['success' => 1, 'text' => 'Помилка']) . '</h1>'], ['Title' => 'Guitar Shop']);
        }
    }
}