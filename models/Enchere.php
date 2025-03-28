<?php

namespace App\Models;

use App\Models\CRUD;

class Enchere extends CRUD{
    protected $table = 'enchere';
    protected $primaryKey = 'id';
    protected $fillable = [
        'coup_de_coeur',
        'date_debut',
        'date_fin',
        'prix_minimal',
        'timbre_id',
        'statut_enchere'
    ];

    public function all() {
        return $this->select();
    }
    
    public function find($id) {
        return $this->selectId($id);
    }
    
}
