<?php


namespace core;

use http\Header;
use models\UserSession;

/**
 *Базовий клас для всіх контролерів
 * @package  core
 */
class Controller
{
    public function render($vieaName, $localParams = null, $globalParans = null)
    {
        $tpl = new Template();
        if (is_array($localParams))
            $tpl->setParams($localParams);
        if (!is_array($globalParans))
            $globalParans = ['User' => null];
        if ($globalParans['User'] == null) {
            $globalParans += ['User' => $this->sessionParams()];
        }
        elseif($globalParans['User'] == 'logined')
        {
            $globalParans['User'] = '<script>window.location.href = "/#"</script>';
        }
        $moduleName = strtolower((new \ReflectionClass($this))->getShortName());
        $globalParans['Content'] = $tpl->render("./views/{$moduleName}/{$vieaName}.php");
        return $globalParans;
    }

    public function sessionParams()
    {
        $cookies = $this->formFilter($_COOKIE, ['login', 'key']);
        if (strlen($cookies['login']) == 0 or strlen($cookies['key']) == 0) {
            return "        <button class=\"btn btn-dark my-2 my-lg-0 ml-sm-3 authorizer\" onclick='" . '$("#myModal").modal("show")' . "'>
            Зайти/Реєстрація
        </button>";
        } else {
            global $core;
            $us = new \models\UserSession();
            $param = $us->sessionCheck($cookies);
            if (is_array($param)) {
                $user = $core->GetDB()->executeQuery(((new \core\DBQuery('contacts'))->select('*')->where(['user_id' => $param['user_id']])->one()));
                $adm = null;
                if($param['role'] == 'admin')
                {
                    $adm = "<a class=\"dropdown-item\" href=\"/adminpanel\">Адмін Панель</a>";
                }
                else
                {
                    $adm = null;
                }
                return "                <div class=\"nav-item dropdown btn btn-dark\">
                    <a class=\"nav-link dropdown-toggle text-light\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                        {$user['name']} {$user['sname']}
                    </a>
                    <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
                        {$adm}
                        <a class=\"dropdown-item\" href=\"/users/profile\">Профіль</a>
                        <a class=\"dropdown-item\" href=\"/users/change\">Редагування профілю</a>
                        <div class=\"dropdown-divider\"></div>
                        <a class=\"dropdown-item\" href='" . '/users/login?act=logout' . "'>Вийти</a>
                    </div>
                </div>";
            } else {
                $us->dropSession();

                return "        <button class=\"btn btn-dark my-2 my-lg-0 ml-sm-3 authorizer\" onclick='" . '$("#myModal").modal("show")' . "'>
            Зайти/Реєстрація
        </button>";
            }
        }
    }

    public function getUser()
    {
        $cookies = $this->formFilter($_COOKIE, ['login', 'key']);
        global $core;
        $us = new \models\UserSession();
        $param = $us->sessionCheck($cookies);
        if (is_array($param)) {
            return $core->GetDB()->executeQuery(((new \core\DBQuery('contacts'))->select('*')->where(['user_id' => $param['user_id']])->one()));
        }
        else return null;
    }


    public function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    public
    function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    /**
     * Фільтр форм від інєкцій в БД
     * @param $array array
     * @param $keys array
     * @return array Відфільтрований массив
     */

    public
    function formFilter($array, $keys)
    {
        $res = [];
        foreach ($array as $key => $value) {
            if (in_array($key, $keys))
                $res[$key] = $value;
        }
        return $res;
    }

    /**
     * Фільтрація масиву пост-змінних
     * @param $keys Ключі які потрібно залишити
     * @return array Відфільтрований массив
     */

    public
    function postFilter($keys)
    {
        return $this->formFilter($_POST, $keys);
    }

    public function getFilter($keys)
    {
        return $this->formFilter($_GET, $keys);
    }
}