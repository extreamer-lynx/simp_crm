<?php


namespace core;


class DBQuery
{
    protected $type;
    protected $filelds;
    protected $where;
    protected $tableName;
    protected $isOneRow;
    protected $insertingRow;
    protected $updatingRow;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->type = null;
        $this->filelds = '*';
        $this->where = [];
        $this->isOneRow = false;

    }

    public function select($fiekds = '*')
    {
        $this->type = 'SELECT';
        $this->filelds = $fiekds;
        return $this;
    }

    public function delete(){
        $this->type = 'DELETE';
        return $this;
    }

    public function where($condition)
    {
        if (is_string($condition)) {
            array_push($this->where, $condition);
        }
        if (is_array($condition)) {
            $this->where = array_merge($this->where, $condition);
        }
        return $this;
    }

    public function insert($row)
    {
        $this->type = 'INSERT';
        $this->insertingRow = $row;
        return $this;
    }

    public function one()
    {
        $this->isOneRow = true;
        return $this;
    }

    public function update($row)
    {
        $this->type = 'UPDATE';
        $this->updatingRow = $row;
        return $this;
    }

    protected function generateWherePath($where)
    {
        $fildsList = array_keys($where);
        $valuesList = array_values($where);
        $whereComponents = [];
        foreach ($fildsList as $item) {
            array_push($whereComponents, "{$item} = :{$item}");
        }
        $wherePart = implode(' AND ', $whereComponents);
        return $wherePart;
    }

    public function isOne()
    {
        return $this->isOneRow;
    }

    protected function generateParamsArray($row)
    {
        $params = [];
        foreach ($row as $key => $item)
        {
            $params[':' . $key] = $item;
        }
        return $params;
    }

    public function getSql()
    {
        switch ($this->type) {
            case 'UPDATE':
                $wherePart = $this->generateWherePath($this->where);
                $setPartArray = [];
                foreach ($this->updatingRow as $key => $value)
                {
                    array_push($setPartArray, $key.' = :'. $key);
                    $params[':'.$key] = $value;
                }
                foreach ($this->where as $key => $value)
                {
                    $params[':'.$key] = $value;
                }
                $setPartString = implode(' ,', $setPartArray);
                $sql = "UPDATE {$this->tableName} SET {$setPartString} WHERE {$wherePart}";
                return ['sql' => $sql, 'params' => $params];
                break;
            case 'DELETE':
                $wherePart = $this->generateWherePath($this->where);
                $sql = "DELETE FROM {$this->tableName} WHERE {$wherePart}";
                $params = $this->generateParamsArray($this->where);
                return ['sql' => $sql, 'params' => $params];
                break;
            case 'SELECT':
                if (is_string($this->filelds))
                    $fieldPart = $this->filelds;
                else
                    if (is_array($this->filelds))
                    {
                        $fieldPart = implode(', ', $this->filelds);
                    }
                    else
                        return null;
                $sql = "SELECT {$fieldPart} FROM {$this->tableName}";
                if (!empty($this->where)) {

                    $wherePart = $this->generateWherePath($this->where);
                    $sql = $sql . " WHERE {$wherePart}";
                }
                $params = $this->generateParamsArray($this->where);
                return ['sql' => $sql, 'params' => $params];
                break;
            case 'INSERT':
                $fieldsList = array_keys($this->insertingRow);
                $valuesList= array_values($this->insertingRow);
                $fieldsListString = implode(', ', $fieldsList);
                $valuesParamsList = [];
                $params = [];
                foreach ($this->insertingRow as $key => $item)
                {
                    array_push($valuesParamsList, ':'.$key);
                    $params[':' . $key] = $item;
                }
                $valuesListString = implode(', ', $valuesParamsList);
                $sql = "INSERT INTO {$this->tableName} ({$fieldsListString}) VALUES ({$valuesListString})";
                return ['sql' => $sql, 'params' => $params];
                break;
        }
        echo $this->type;
        echo $this->filelds;
        return null;
    }

}

