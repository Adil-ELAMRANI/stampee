<?php

namespace App\Models;

use PDO;
use PDOException;

abstract class CRUD extends PDO
{
    protected $table;
    protected $primaryKey = 'id';
    protected $fillable = [];

    public function __construct()
    {
        try {
            parent::__construct('mysql:host=localhost;dbname=stampee;port=3306;charset=utf8', 'root', '');
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connexion échouée : ' . $e->getMessage());
        }
    }

    public function select($field = null, $order = 'ASC')
    {
        $field = $field ?? $this->primaryKey;
        $sql = "SELECT * FROM $this->table ORDER BY $field $order";
        return $this->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectId($value)
    {
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':id', $value);
        $stmt->execute();
        return $stmt->rowCount() === 1 ? $stmt->fetch(PDO::FETCH_OBJ) : false;
    }

    public function insert(array $data)    {
        $data = array_intersect_key($data, array_flip($this->fillable));
        $fields = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO $this->table ($fields) VALUES ($placeholders)";
        $stmt = $this->prepare($sql);

        foreach ($data as $key => $val) {
            $stmt->bindValue(":$key", $val);
        }

        return $stmt->execute() ? $this->lastInsertId() : false;
    }


    public function update($id, array $data){
        $data = array_intersect_key($data, array_flip($this->fillable));
        $fields = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
        $sql = "UPDATE $this->table SET $fields WHERE $this->primaryKey = :id";
        $stmt = $this->prepare($sql);
    
        foreach ($data as $key => $val) {
            $stmt->bindValue(":$key", $val);
        }
    
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
    

    public function delete($id)
    {
        if (!$this->selectId($id))
            return false;

        $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    public function unique($field, $value)
    {
        $sql = "SELECT * FROM $this->table WHERE $field = :val";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':val', $value);
        $stmt->execute();
        return $stmt->rowCount() > 0 ? $stmt->fetch(PDO::FETCH_OBJ) : false;
    }
}
