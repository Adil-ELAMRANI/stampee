<?php
namespace App\Models;

class Certification extends CRUD{
    protected $table = 'certification';
    protected $primaryKey = 'id';
    protected $fillable = ['statut_certification'];
}
