<?php


namespace models;


use core\DB;
use core\Model;

class UserSession extends Model
{
    public function createSession($user)
    {

        $key = $this->generateSalt().time();

        setcookie('login', $user['login'], time()+60*60*24*30, '/');
        setcookie('key', $key, time()+60*60*24*30, '/');

        global $core;
        $query = new \core\DBQuery('users');
        $core->getDB()->executeQuery($query->update(['cookie' => $key])->where(['login' => $user['login'], 'password' => $user['password']]));
        return null;
    }

    public function sessionCheck($cookies)
    {
        global $core;
        $query = new \core\DBQuery('users');
        $res = $core->getDB()->executeQuery($query->select('*')->where(['login' => $cookies['login'], 'cookie' => $cookies['key']]));
        if(count($res) == 1)
        {
            return $res[0];
        }
        else
            return 0;
    }

    public function dropSession()
    {
        setcookie('login', '', time(), '/');
        setcookie('key', '', time(), '/');
    }

    public function generateSalt()
    {
        $salt = '';
        $saltLength = 10;
        for($i=0; $i<$saltLength; $i++) {
            $salt .= chr(mt_rand(33,126));
        }
        return $salt;
    }
}