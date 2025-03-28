<?php

namespace App\Controllers;

use App\Models\Enchere;
use App\Models\Timbre;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class EnchereController
{
    public function __construct()
    {
        Auth::session();
    }

    public function index()
    {
        $encheres = (new Enchere)->all();
        return View::render('enchere/index', compact('encheres'));
    }

    public function create()
    {
        $timbrerow = (new Timbre)->select('nom'); 
        return View::render('enchere/create', [
            'enchere' => [],
            'timbrerow' => $timbrerow,
            'errors' => []
        ]);
    }

    public function store($data)
    {
        $validator = new Validator;
        $validator->field('date_debut', $data['date_debut'])->required();
        $validator->field('date_fin', $data['date_fin'])->required();
        $validator->field('prix_minimal', $data['prix_minimal'])->required()->numeric();
        $validator->field('timbre_id', $data['timbre_id'])->required()->int();
        $validator->field('statut_enchere', $data['statut_enchere'])->required()->int();

        if ($validator->isSuccess()) {
            $enchere = new Enchere;
            $enchere->insert($data);
            return View::redirect('enchere');
        }

        return View::render('enchere/create', [
            'errors' => $validator->getErrors(),
            'enchere' => $data,
            'timbrerow' => (new Timbre)->select('nom')
        ]);
    }

    public function edit($query)
    {
        $enchere = (new Enchere)->find($query['id']);
        $timbrerow = (new Timbre)->select('nom');
        return View::render('enchere/edit', compact('enchere', 'timbrerow'));
    }

    public function update($data)
    {
        $validator = new Validator;
        $validator->field('date_debut', $data['date_debut'])->required();
        $validator->field('date_fin', $data['date_fin'])->required();
        $validator->field('prix_minimal', $data['prix_minimal'])->required()->numeric();
        $validator->field('timbre_id', $data['timbre_id'])->required()->int();
        $validator->field('statut_enchere', $data['statut_enchere'])->required()->int();

        if ($validator->isSuccess()) {
            (new Enchere)->update($data['id'], $data);
            return View::redirect('enchere');
        }

        return View::render('enchere/edit', [
            'errors' => $validator->getErrors(),
            'enchere' => $data,
            'timbrerow' => (new Timbre)->select('nom')
        ]);
    }

    public function delete($query)
    {
        (new Enchere)->delete($query['id']);
        return View::redirect('enchere');
    }
}
