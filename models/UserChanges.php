<?php


namespace models;


use core\Controller;
use core\Model;

class UserChanges extends Model
{
    private $controller;
    private $user;

    public function __construct()
    {
        $this->controller = new Controller();
        $this->user = new \models\User();
    }

    public function uploadFile()
    {
        $user = $this->controller->getUser();
        if ($user['avatar'] != null) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/files/avatars/' . $user['avatar']);
        }
        global $core;
        $photos = $_FILES['photos'];
        $file = null;
        $destPath = $_SERVER['DOCUMENT_ROOT'] . '/files/avatars/';
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

    public function changePass($user)
    {
        $post = $this->controller->postFilter(['oldpassword', 'password', 'password2']);
        $cookies = $this->controller->formFilter($_COOKIE, ['login', 'key']);
        global $core;
        $result = $core->GetDB()->executeQuery((new \core\DBQuery('users'))->select('*')->where(['user_id' => $user['user_id'], 'login' => $cookies['login']])->one());
        if (is_array($result)) {
            if ($post['password'] == $post['password2']) {
                $str = md5($post['oldpassword'].$result['salt']);
                if ($result['password'] == $str) {
                    $newSalt = $this->generateSalt();
                    $core->GetDB()->executeQuery((new \core\DBQuery('users'))->update(['password' => md5($post['password'] . $newSalt), 'salt' => $newSalt])->where(['user_id' => $user['user_id']]));
                    return json_encode(array(
                        'success' => 1,
                        'text' => 'Пароль зміненно'));
                } else {
                    return json_encode(array(
                        'success' => 1,
                        'text' => 'Старий пароль введено невірно'));
                }
            } else {
                return json_encode(array(
                    'success' => 1,
                    'text' => 'Нові паролі не збігаються'));
            }

        } else {
            return json_encode(array(
                'success' => 1,
                'text' => 'Невідома помилка. Перезайдіть будь-ласка!'));
        }

    }

    public function changeContacts($user)
    {
        $addContainer = [];
        $post = $this->controller->postFilter(['name', 'sname', 'email', 'telephone']);
        $cookies = $this->controller->formFilter($_COOKIE, ['login', 'key']);
        global $core;
        $result = $core->GetDB()->executeQuery((new \core\DBQuery('users'))->select('*')->where(['user_id' => $user['user_id'], 'login' => $cookies['login']])->one());
        if (is_array($result)) {
            foreach ($post as $key => $value) {
                if($value != '' or $value != null)
                {
                    $addContainer[$key] = $value;
                }
            }
            if (count($addContainer) == 0)
            {
                return '<h1 id="result">'.json_encode(array(
                    'success' => 0,
                    'text' => 'Введіть якесь значення щоб змінити!')).'</h1>';

            }
            else
            {
                $err = [];
                if ($addContainer['telephone'] != 0 or $addContainer['telephone'] != '')
                {
                    $err = $this->telCheck($addContainer);
                }
                if ($addContainer['name'] != 0 or $addContainer['name'] != '')
                {
                   $err = array_merge( $err ,$this->namesCheck($post['name'], $user['sname']));
                }
                if ($addContainer['sname'] != 0 or $addContainer['sname'] != '')
                {
                    $err = array_merge($err , $this->namesCheck($post['name'], $user['sname']));
                }
                if ($addContainer['login'] != 0 or $addContainer['login'] != '')
                {
                    if ($this->user->UserCheck($post['login'])['COUNT(*)'] > 0) {
                        array_push($err, "Користувач з таким логіном вже існує");
                    }
                }
                if(count($err) == 0)
                {
                    $core->GetDB()->executeQuery((new \core\DBQuery('contacts'))->update($addContainer)->where(['user_id' => $user['user_id']]));
                    return '<h1 id="result">'.json_encode(array(
                        'success' => 1,
                        'text' => 'Данні додано в систему!')).'</h1>';

                }
                else
                {
                    return '<h1 id="result">'.json_encode(array(
                            'success' => 0,
                            'text' => $err)).'</h1>';
                }
            }

        } else {
            return '<h1 id="result">'.json_encode(array(
                'success' => 0,
                'text' => 'Невідома помилка. Перезайдіть будь-ласка!')).'</h1>';

        }

    }

    private function telCheck($addContainer)
    {
        $err = [];
        if($this->user->TelCheck($addContainer['telephone'])['COUNT(*)'] > 0)
        {
            $err[] = 'Данний телефон вже є в системі!';
        }
        elseif(strlen($addContainer['telephone']) <= 8 or strlen($addContainer['telephone']) <= 12)
        {
            $err[] = 'Телефон повинне бути не меньше 8-х символів і не більше 12!';
        }

        return $err;
    }

    private function namesCheck($name, $sname)
    {
        $err = [];
        if($this->user->NamesCheck($name,$sname)['COUNT(*)'] > 0)
        {
            $err[] = 'Данний користувач вже є в системі!';
        }

        if (strlen($name) <= 1 or strlen($name) > 15) {

            $err[] = "Імя повинне бути не меньше 1-х символів і не більше 15";

        }

        if (strlen($sname) <= 1 or strlen($sname) > 20) {

            $err[] = "Прізвище повинне бути не меньше 1-х символів і не більше 20";

        }

        return $err;
    }


    public function generateSalt()
    {
        $salt = '';
        $saltLength = 8;
        for ($i = 0; $i < $saltLength; $i++) {
            $salt .= chr(mt_rand(33, 126));
        }
        return $salt;
    }


}