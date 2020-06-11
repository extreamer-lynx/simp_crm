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
        $result=$query->getSql();
        $statement=$this->PDO->prepare($result['sql']);
        $statement->execute($result['params']);
        if($query->isOne())
            return $statement->fetch(\PDO::FETCH_ASSOC);
        else
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

}