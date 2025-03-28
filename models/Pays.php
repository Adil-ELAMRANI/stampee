<?php
namespace App\Models;

class Pays extends CRUD{
    protected $table = 'pays';
    protected $primaryKey = 'id';
    protected $fillable = ['nom_pays'];
}
