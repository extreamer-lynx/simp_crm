<?php

namespace models;

use core\DBQuery;
use core\Model;

class User extends \core\Model
{
    public function Autentaficate($login, $password)
    {
        global $core;
        $query = new \core\DBQuery('users');
        if ($this->UserCheck($login)['COUNT(*)'] > 0) {
            $res = $core->getDB()->executeQuery($query->select('*')->where(['login' => $login])->one());
            if ($res['password'] == md5($password . $res['salt'])) {
                (new UserSession())->createSession(['login' => $login, 'password' => md5($password . $res['salt'])]);
                return null;
            }
            return 'Неправильний пароль';
        }
        return 'Неправильний Email чи пароль';
    }

    public function UserCheck($login)
    {
        global $core;
        $query = new \core\DBQuery('users');
        return $core->getDB()->executeQuery($query->select('COUNT(*)')->where(['login' => $login])->one());
    }

    public function NamesCheck($name, $sname)
    {
        global $core;
        $query = new \core\DBQuery('contacts');
        return $core->getDB()->executeQuery($query->select('COUNT(*)')->where(['name' => $name, 'sname' => $sname])->one());
    }

    public function TelCheck($tel)
    {
        global $core;
        $query = new \core\DBQuery('contacts');
        return $core->getDB()->executeQuery($query->select('COUNT(*)')->where(['telephone' => $tel])->one());
    }

    /**
     *  Перевірка параметрів регістрації
     * @param $post array
     * @return array
     */

    public function CheckOnErrors(array $post)
    {
        $err = array();

        if ($this->NamesCheck($post['name'], $post['sname'])['COUNT(*)'] > 0) {

            $err[] = "Користувач з таким іменем вже існує";

        }

        if (strlen($post['name']) <= 1 or strlen($post['name']) > 15) {

            $err[] = "Імя повинне бути не меньше 1-х символів і не більше 15";

        }

        if (strlen($post['sname']) <= 1 or strlen($post['sname']) > 20) {

            $err[] = "Прізвище повинне бути не меньше 1-х символів і не більше 20";

        }

        if ($this->UserCheck($post['login'])['COUNT(*)'] > 0) {

            $err[] = "Користувач з таким логіном вже існує";

        }

        if ($post['password'] != $post['spassword']) {
            $err[] = "Паролі не збігаються";
        }

        if (strlen($post['telephone']) <= 8) {
            $err[] = "Номер телефона не може бути менше 8 символів";
        }

        if ($this->TelCheck($post['telephone'])['COUNT(*)'] > 0) {

            $err[] = "Користувач з таким номером телелона вже існує";

        }

        return $err;
    }

    public function Registrate($post)
    {
        $err = $this->CheckOnErrors($post);
        if (count($err) == 0) {
            global $core;
            $query = new \core\DBQuery('users');
            $salt = $this->generateSalt();
            $userId = $this->maxUsers() + 1;
            $query->insert(['login' => $post['login'],
                'password' => md5($post['password'] . $salt),
                'salt' => $salt, 'user_id' => $userId]);
            $res = $core->getDB()->executeQuery($query);
            if (count($res) == 0) {
                $contactQuery = new \core\DBQuery('contacts');
                $core->getDB()->executeQuery(
                    $contactQuery->insert(['user_id' => $userId,
                        'name' => $post['name'], 'sname' => $post['sname'],
                        'telephone' => preg_replace("#[^0-9]#", "", $post['telephone'])]));
                return null;
            } else
                return $err[] = 'Неочікувана помилка! зверніться до адміністратора';
        } else {
            return $err;
        }
    }

    /**
     * Генерування ключа розшифрування паролю
     * @return string
     */

    private function maxUsers()
    {
        global $core;
        $query = new \core\DBQuery('users');
        return $core->getDB()->executeQuery($query->select('COUNT(*)')->one())['COUNT(*)'];
    }

    private function generateSalt()
    {
        $salt = '';
        $saltLength = 8;
        for ($i = 0; $i < $saltLength; $i++) {
            $salt .= chr(mt_rand(33, 126));
        }
        return $salt;
    }

    public function closeSession()
    {
        return (new UserSession())->dropSession();
    }

    public function getProfile($id)
    {
        global $core;
        return $core->GetDB()->executeQuery((new \core\DBQuery('contacts'))->select('*')->where(['user_id' => $id])->one());
    }

    public function getProfiles()
    {
        global $core;
        $usTable = $core->GetDB()->executeQuery((new \core\DBQuery('contacts'))->select("*"));
        $usTableString = '';
        foreach ($usTable as $users) {
            $usTableString = $usTableString . "                            <tr>
                                <th scope=\"row\">{$users['user_id']}</th>
                                <td>{$users['name']}</td>
                                <td>{$users['sname']}</td>
                                <td>{$users['telephone']}</td>
                                <td> <input type=\"button\" class=\"btn btn-dark\" id=\"deleteUser\" onclick=\"delUser({$users['user_id']})\" value=\"Видалити\"></td>
                            </tr>";

        }
        return $usTableString;
    }


}