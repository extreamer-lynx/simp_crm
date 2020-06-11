<?php


namespace models;

use core\DBQuery;

class Info extends \core\Model
{
    public function GetInfo($key)
    {
        global $core;
        $query = new \core\DBQuery('helpinfo');
        $res = $core->getDB()->executeQuery($query->select('content')->where(['name' => $key])->one());
        return $res['content'];
    }

    public function GetCoordinates($key)
    {
        global $core;
        $query = new \core\DBQuery('helpinfo');
        $res = $core->getDB()->executeQuery($query->select('coordinates')->where(['name' => $key])->one());
        return $res['coordinates'];
    }
}