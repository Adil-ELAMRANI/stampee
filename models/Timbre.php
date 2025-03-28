<?php
namespace App\Models;

class Timbre extends CRUD
{
    protected $table = 'timbre';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nom', 'description', 'annee', 'image', 'pays_id', 'certification_id', 'etat_timbre_id', 'utilisateur_id'
    ];

    public function find($id) {
        return $this->selectId($id);
    }
}

