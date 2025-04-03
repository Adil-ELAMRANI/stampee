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
        'prix_minimale',
        'timbre_id',
        'statut_enchere'
    ];


    // Méthode personnalisée avec jointure
    public function allWithTimbre()
    {
        $sql = "SELECT enchere.*, timbre.nom AS timbre_nom
                FROM enchere
                JOIN timbre ON timbre.id = enchere.timbre_id
                ORDER BY enchere.id DESC";

        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }

    public function all() {
        return $this->select();
    }
    
    public function find($id) {
        return $this->selectId($id);
    }
    
}
