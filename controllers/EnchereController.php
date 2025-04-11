<?php

namespace App\Controllers;

use App\Models\Enchere;
use App\Models\Timbre;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class EnchereController{
    public function __construct(){
        Auth::session();
    }

    public function index(){
        $encheres = (new Enchere)->allWithTimbre();
        return View::render('enchere/index', compact('encheres'));
    }

    public function create(){
        //var_dump($_GET);
        //die();
        $timbres = (new Timbre)->select('nom');
        return View::render('enchere/create', [
            'enchere' => [],
            'timbres' => $timbres,
            'errors' => []
        ]);
    }

    public function store($data){
        $validator = new Validator;

        $validator->field('date_debut', $data['date_debut'])->required();
        $validator->field('date_fin', $data['date_fin'])->required();
        $validator->field('prix_minimale', $data['prix_minimale'])->required()->numeric();
        $validator->field('timbre_id', $data['timbre_id'])->required()->int();

        // Champ coup de cœur (checkbox) si non coché, il n’est pas dans $data
        $data['coup_de_coeur'] = isset($data['coup_de_coeur']) ? 1 : 0;

        // Champ statut_enchere : optionnel, on applique une valeur par défaut
        $data['statut_enchere'] = isset($data['statut_enchere']) ? (int)$data['statut_enchere'] : 1;

        if ($validator->isSuccess()) {
            $enchere = new Enchere;
            $enchere->insert($data);
            return View::redirect('enchere');
        }

        // Afficher à nouveau le formulaire avec les erreurs
        return View::render('enchere/create', [
            'errors' => $validator->getErrors(),
            'enchere' => $data,
            'timbres' => (new Timbre)->select('nom')
        ]);
    }

    public function edit($query){
        $enchere = (new Enchere)->find($query['id']);
        $timbres = (new Timbre)->select('nom');

        return View::render('enchere/edit', compact('enchere', 'timbres'));
    }

    public function update($data){
        $validator = new Validator;

        $validator->field('date_debut', $data['date_debut'])->required();
        $validator->field('date_fin', $data['date_fin'])->required();
        $validator->field('prix_minimale', $data['prix_minimale'])->required()->numeric();
        $validator->field('timbre_id', $data['timbre_id'])->required()->int();

        $data['coup_de_coeur'] = isset($data['coup_de_coeur']) ? 1 : 0;
        $data['statut_enchere'] = isset($data['statut_enchere']) ? (int)$data['statut_enchere'] : 1;

        if ($validator->isSuccess()) {
            (new Enchere)->update($data['id'], $data);
            return View::redirect('enchere');
        }

        return View::render('enchere/edit', [
            'errors' => $validator->getErrors(),
            'enchere' => $data,
            'timbres' => (new Timbre)->select('nom')
        ]);
    }

    public function delete($query){
        (new Enchere)->delete($query['id']);
        return View::redirect('enchere');
    }
}
