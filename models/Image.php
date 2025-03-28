<?php
namespace App\Models;

class Image extends CRUD
{
    protected $table = 'image';
    protected $primaryKey = 'id';
    protected $fillable = ['image_principale', 'timbre_id'];

    public function where($field, $value)
    {
        $sql = "SELECT * FROM $this->table WHERE $field = :value LIMIT 1";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':value', $value);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_OBJ);
    }
}