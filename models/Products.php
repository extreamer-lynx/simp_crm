<?php


namespace models;


class Products
{
    public function getCategory()
    {
        global $core;
        return $core->GetDB()->executeQuery((new \core\DBQuery('category'))->select('*'));
    }

    public function getOneCategory($name)
    {
        global $core;
        return $core->GetDB()->executeQuery((new \core\DBQuery('category'))->select('*')->where(['ua_name' => $name])->one());
    }

    public function getOneEngCategory($name)
    {
        global $core;
        return $core->GetDB()->executeQuery((new \core\DBQuery('category'))->select('*')->where(['name' => $name])->one());
    }

    public function addPhoto()
    {
        $user = $this->controller->getUser();
        if ($user['avatar'] != null) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/avatars/' . $user['avatar']);
        }
        global $core;
        $photos = $_FILES['photos'];
        $file = null;
        $destPath = $_SERVER['DOCUMENT_ROOT'] . '/files/product/';
        foreach ($photos['name'] as $key => $name) {
            $tempName = $photos['tmp_name'][$key];
            $type = substr($name, strpos($name, "."), strlen($name));
            $destName = $destPath . $user['user_id'] . $type;

            move_uploaded_file($tempName, $destName);

            $file = $user['user_id'] . $type;

            $core->GetDB()->executeQuery((new \core\DBQuery('contacts'))->update(['avatar' => $file])->where(['user_id' => $user['user_id']]));
        }
        clearstatcache();

        return json_encode(array(
            'success' => 1,
            'photo' => "/files/avatars/" . $file
        ));
    }

    public function categoryAdd($post)
    {
        global $core;
        $core->GetDB()->executeQuery((new \core\DBQuery('category'))->insert($post));
    }

    public function categoryDel($post)
    {
        global $core;
        $core->GetDB()->executeQuery((new \core\DBQuery('category'))->delete()->where($post));
    }

    public function addProd($params)
    {
        if(count($params) == 5)
        {
            global $core;
            $query = new \core\DBQuery('products');
            $productId = $this->maxProducts() + 1;
            $cat = $this->getOneCategory($params['category']);
            $core->GetDB()->executeQuery($query->insert(['id' => $productId, 'name' => $params['name'], 'cost' => $params['cost'],
                'description' => $params['description'], 'category' => $cat['name'], 'count' => $params['count']]));
            $paramImg = ['id' => $productId, 'image' => null];
            $this->uploadPhoto($paramImg);
            return null;
        }
        else
        {
            return 'Не всі параметри введені';
        }
    }

    private function uploadPhoto($post)
    {
        if ($post['image'] != null) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/product/' . $post['image']);
        }
        global $core;
        $photos = $_FILES['photos'];
        $file = null;
        $destPath = $_SERVER['DOCUMENT_ROOT'] . '/files/product/';
        foreach ($photos['name'] as $key => $name) {
            $tempName = $photos['tmp_name'][$key];
            $type = substr($name, strpos($name, "."), strlen($name));
            $destName = $destPath . $post['id'] . $type;

            move_uploaded_file($tempName, $destName);

            $file = $post['id'] . $type;

            $core->GetDB()->executeQuery((new \core\DBQuery('products'))->update(['image' => $file])->where(['id' => $post['id']]));
        }
        clearstatcache();

        return json_encode(array(
            'success' => 1,
            'photo' => "/files/product/" . $file
        ));

    }

    private function maxProducts()
    {
        global $core;
        $query = new \core\DBQuery('products');
        $res = $core->getDB()->executeQuery($query->select('COUNT(*)')->one())['COUNT(*)'];
        return $res;
    }

    public function getProduct($id)
    {
        global $core;
        return $core->GetDB()->executeQuery((new \core\DBQuery('products'))->select('*')->where(['id' => $id])->one());
    }

    public function getAllProduct()
    {
        global $core;
        return $core->GetDB()->executeQuery((new \core\DBQuery('products'))->select('*'));
    }

    public function getProductByCategory($cat)
    {
        global $core;
        return $core->GetDB()->executeQuery((new \core\DBQuery('products'))->select('*')->where(['category' => $cat]));
    }

    private function maxSell()
    {
        global $core;
        $query = new \core\DBQuery('sells');
        return $core->getDB()->executeQuery($query->select('COUNT(*)')->one())['COUNT(*)'];
    }

    public function buyAction($param)
    {
        global $core;
        $query = new \core\DBQuery('sells');
        $productId = $this->maxSell() + 1;
        $core->GetDB()->executeQuery($query->insert(['id_sell' => $productId, 'user_id' => $param['user_id'], 'id_products' => $param['id_products'],
            'date' => date("m.d.y")]));
        return null;
    }

    public function getProductByName($name)
    {
        global $core;
        return $core->GetDB()->executeQuery((new \core\DBQuery('products'))->select("*")->where(['name'=> $name]));

    }

    public function getSellsList()
    {
        global $core;
        $usTable = $core->GetDB()->executeQuery((new \core\DBQuery('sells'))->select("*"));
        $usTableString = '';
        foreach ($usTable as $sells) {
            if($sells['status'] == null or $sells['status'] == '')
            {
                $stat = ['text' => "Не Виконано", 'stat' => '0'];
            }
            else
                $stat = ['text' => "Виконано", 'stat' => '1'];
            $usTableString = $usTableString . "                            <tr>
                                <th scope=\"row\">{$sells['id_sell']}</th>
                                <td>{$sells['user_id']}</td>
                                <td>{$sells['id_products']}</td>
                                <td>{$sells['date']}</td>
                                <td>{$stat['text']}</td>
                                <td> <input type=\"button\" class=\"btn btn-dark\" id=\"changeStatus\" onclick=\"chngStat({$sells['id_sell']},{$stat['stat']})\" value=\"Змінити статус\"></td>
                            </tr>";

        }
        return $usTableString;
    }

}