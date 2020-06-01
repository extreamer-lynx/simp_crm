<?php


namespace core;


class DB
{
    protected $PDO;
    public function __construct($server,$userName,$userPassword,$databaseName)
    {
$this->PDO=new \PDO("mysql:host={$server};dbname={$databaseName}",$userName,$userPassword);
    }
    public function  executeQuery(DBQuery $query){
        $resultSQL=$query->getSql();
        $statement=$this->PDO->prepare($resultSQL['sql']);
        $statement->execute($resultSQL['params']);
       return $statement->fetchAll();
    }

}