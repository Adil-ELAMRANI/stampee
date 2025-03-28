<?php
namespace App\Models;

class EtatTimbre extends CRUD{
    protected $table = 'etat_timbre';
    protected $primaryKey = 'id';
    protected $fillable = ['etat'];
}