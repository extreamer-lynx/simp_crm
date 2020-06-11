<?php


namespace controllers;


use core\Controller;
use core\Model;

class Users extends Controller
{
    protected $Model;
    protected $Profile;

    public function __construct()
    {
        $this->Model = new \models\User();
        $this->Profile = new \models\UserChanges();
    }

    public function actionIndex()
    {
        return ['Title' => 'lol'];
    }

    public function actionLogin()
    {
        if ($this->isPost()) {
            $post = $this->postFilter(['login', 'password']);
            $res = $this->Model->Autentaficate($post['login'], $post['password']);

            if ($res == null) {
                return $this->render('login',
                    [],
                    ['Title' => 'Вхід | Guitar Shop', 'User' => 'logined']);
            } else
                return $this->render('login',
                    ['Info' => $res],
                    ['Title' => 'Вхід | Guitar Shop']);
        } elseif ($this->isGet()) {
            $get = $this->getFilter(['act']);
            if ($get['act'] == 'logout') {
                $this->Model->closeSession();
                return $this->render('login',
                    ['Info' => '<script>window.location.href = "/users/login"</script>'],
                    ['Title' => 'Вхід | Guitar Shop',
                        'User' => "        <button class=\"btn btn-dark my-2 my-lg-0 ml-sm-3 authorizer\" onclick='" . '$("#myModal").modal("show")' . "'>
            Зайти/Реєстрація
        </button>"]);
            } else
                return $this->render('login',
                    [],
                    ['Title' => 'Вхід | Guitar Shop']);
        }
    }


    public function actionRegistration()
    {
        if ($this->isPost()) {
            $post = $this->postFilter(['login', 'password', 'name', 'sname', 'spassword', 'telephone']);
            if ($this->Model->Registrate($post) != null)
                return $this->render('registration',
                    ['Info' => $this->Model->Registrate($post)],
                    ['Title' => 'Реєстрація | Guitar Shop']);
            else {

                $res = $this->Model->Autentaficate($post['login'], $post['password']);
                if ($res == null) {
                    return $this->render('login',
                        [],
                        ['Title' => 'Вхід | Guitar Shop', 'User' => 'logined']);
                }
            }
        } elseif ($this->isGet()) {
            return $this->render('registration',
                [],
                ['Title' => 'Реєстрація | Guitar Shop']);
        }
    }

    public function actionProfile()
    {
        $id = '';
        if (count($_GET) == 1) {
            $user = $this->getUser();
            $content = $this->Model->getProfile($user['user_id']);
            return $this->render('profile',
                ['Avatar' => $content['avatar'], 'Name' => $content['name'],
                    'Sname' => $content['sname'], 'Telephone' => $content['telephone']],
                ['Title' => 'Профіль | Guitar Shop']);
        } else {
            foreach ($_GET as $key => $value) {
                if ($key == 'id') {
                    $id = $value;
                }
            }

            if($id != null or $id != '') {
                $content = $this->Model->getProfile($id);
                return $this->render('profile',
                    ['Avatar' => $content['avatar'], 'Name' => $content['name'],
                        'Sname' => $content['sname'], 'Telephone' => $content['telephone']],
                    ['Title' => 'Профіль | Guitar Shop']);
            }
            if($id == 0)
            {
                $user = $this->getUser();
                $content = $this->Model->getProfile($user['user_id']);
                return $this->render('profile',
                    ['Avatar' => $content['avatar'], 'Name' => $content['name'],
                        'Sname' => $content['sname'], 'Telephone' => $content['telephone']],
                    ['Title' => 'Профіль | Guitar Shop']);
            }
        }
    }

    public function actionChange()
    {
        $user = $this->getUser();

        if ($this->isPost()) {
            if ($user == null) {
                $this->render('change');
            } else {
                if ($_GET['act'] == 'upload') {
                    return ['Content' => '<h1 id="result">' . $this->Profile->uploadFile() . '</h1>'];
                } elseif ($_GET['act'] == 'pass') {
                    return ['Content' => '<h1 id="result">' . $this->Profile->changePass($user) . '</h1>'];
                } elseif ($_GET['act'] == 'contacts') {
                    $res = $this->Profile->changeContacts($user);
                    return ['Content' => $res];
                } else
                    return $this->render('change', ['Avatar' => $user['avatar']], ['Title' => 'Редагування | Guitar Shop']);
            }
        } elseif ($this->isGet())
            return $this->render('change', ['Avatar' => $user['avatar']], ['Title' => 'Редагування | Guitar Shop']);
    }

}