<?php


namespace core;


class DBQuery
{
    protected $type;
    protected $filelds;
    protected $where;
    protected $tableName;
    public function __construct($tableName)
    {
        $this->tableName=$tableName;
        $this->type=null;
        $this->filelds='*';
        $this->where=[];

    }
    public function select($fiekds ='*'){
        $this->type='SELECT';
        $this->filelds=$fiekds;
        return $this;
    }
    public function where($condition){
        if(is_string($condition)){
         array_push($this->where, $condition);
        }
        if(is_array($condition)){
           $this->where=array_merge($this->where,$condition);
        }
return $this;
    }
    public function getSql(){
       switch ($this->type){
           case 'SELECT':
               if(is_string($this->filelds))
                   $fieldPart=$this->filelds;
               else
                   if(is_array($this->filelds)){
                    $fieldPart=implode(', ',$this->filelds);
                   }
                   else return null;
               $sql="SELECT {$fieldPart} FROM {$this->tableName}";
               if(!empty($this->where)){
                   $fildsList = array_keys($this->where);
                   $valuerList=array_values($this-where);
                   $whereComponents=[];
                   foreach ($fildsList as $item){
                       array_push($whereComponents,"{$item} = :{$item}");
                   }
                   $wherePart=implode(' AND ', $whereComponents);
                   $sql=$sql." WHERE {$wherePart}";
               }
                $params=[];
               foreach ($this->where as $key=>$item){
                   $params[':'.$key]=$item;
               }
               return ['sql'=>$sql,'params'=>$params];
               break;
       }
       echo $this->type;
       echo $this->filelds;
       return  null;
    }

}
































