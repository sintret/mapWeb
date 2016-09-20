<?php

/*
 * @author : Andy Fitria
 * <sintret@gmail.com>
 * simple pdo class
 * http://sintret.com
 */


include 'Db.php';

class Model {

    public $connect;
    public $statement;
    public $selectFrom;
    public $where;
    public $limit;
    public $arrayWhere;
    public $orderBy;
    public static $methods = ['where', 'find', 'limit', 'statement'];

    public function __construct()
    {
        return $this->connect = Db::instance();
    }

    public function find($table)
    {
        $this->selectFrom = "select * from `$table` ";
    }

    public function where($array = [])
    {
        if (count($array)) {
            $where = ' WHERE ';
            foreach ($array as $k => $v) {
                $where .= $k . '= :' . $k;
            }

            $this->where = $where . ' ';
            $this->arrayWhere = $array;
        }
    }

    public function orderBy($orderBy = NULL)
    {
        if (!empty($orderBy)) {
            $this->orderBy = ' order by ' . $orderBy . ' ';
        }
    }

    public function statement($statement = NULL)
    {
        if (empty($statement))
            return $this->selectFrom . $this->where . $this->orderBy . $this->limit;
        else
            return $statement;
    }

    public function one()
    {
        $this->limit = " LIMIT 1 ";
        $row = $this->connect->prepare($this->statement());
        if (count($this->arrayWhere)) {
            foreach ($this->arrayWhere as $k => $v) {
                $row->bindParam(":" . $k, $v);
            }
        }
        $row->execute();

        return $row->fetch(\PDO::FETCH_OBJ);
    }

    public function all()
    {
        $row = $this->connect->prepare($this->statement());
        if (count($this->arrayWhere)) {
            foreach ($this->arrayWhere as $k => $v) {
                $row->bindParam(":" . $k, $v);
            }
        }
        $row->execute();

        return $row->fetchAll(\PDO::FETCH_OBJ);
    }

}
