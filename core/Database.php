<?php

class Database{
    private static $instance = null;
    private $pdo, $query, $error = false, $results, $count = 0;

    private function __construct(){
        try{
            $this->pdo = new PDO('mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME, Config::DB_USER, Config::DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die('Could not connect to database.' . $e->getMessage());
        }
    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function query($sql, $params = []){
        $this->error = false;
        if($this->query = $this->pdo->prepare($sql)){
            $x = 1;
            if(count($params)){
                foreach($params as $param){
                    $this->query->bindValue($x, $param);
                    $x++;
                }
            }
            if($this->query->execute()){
                $this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
                $this->count = $this->query->rowCount();
            }else{
                $this->error = true;
            }
        }
        return $this;
    }

    public function find($table, $params = []){
        $field = (isset($params['field'])) ? $params['field'] : '*';
        $join = (isset($params['join'])) ? $params['join'] : '';
        $condition = (isset($params['condition'])) ? $params['condition'] : '';
        $order = (isset($params['order'])) ? $params['order'] : '';
        $limit = (isset($params['limit'])) ? $params['limit'] : '';
        
        $sql = "SELECT {$field} FROM {$table} {$join} {$condition} {$order} {$limit}";
        if(!$this->query($sql)->error()){
            return $this;
        }
    }

    public function first(){
        return (!empty($this->results)) ? $this->results[0] : [];
    }

    public function last(){
        return (!empty($this->results)) ? $this->results[$this->count - 1] : [];
    }

    public function error(){
        return $this->error;
    }

    public function count(){
        return $this->count;
    }

    public function results(){
        return $this->results;
    }

    public function get($table, $where){
        return $this->query("SELECT * FROM {$table} WHERE {$where}");
    }

    public function insert($table, $fields = []){
        $fieldString = '';
        $valueString = '';
        $values = [];

        foreach($fields as $field => $value){
            $fieldString .= '`' . $field . '`,';
            $valueString .= '?,';
            $values[] = $value;
        }

        $fieldString = rtrim($fieldString, ',');
        $valueString = rtrim($valueString, ',');

        $sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";

        if(!$this->query($sql, $values)->error()){
            return true;
        }
        return false;
    }

    public function update($table, $id, $fields = []){
        $fieldString = '';
        $values = [];

        foreach($fields as $field => $value){
            $fieldString .= ' ' . $field . ' = ?,';
            $values[] = $value;
        }

        $fieldString = trim($fieldString);
        $fieldString = rtrim($fieldString, ',');

        $sql = "UPDATE {$table} SET {$fieldString} WHERE id = {$id}";

        if(!$this->query($sql, $values)->error()){
            return true;
        }
        return false;
    }

    public function delete($table, $id){
        $sql = "DELETE FROM {$table} WHERE id = {$id}";

        if(!$this->query($sql)->error()){
            return true;
        }
        return false;
    }
}