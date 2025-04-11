<?php

namespace App\Controllers;

use App\Models\Utilisateur;
use App\Models\Privilege;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class UtilisateurController
{
    public function __construct()
    {
        Auth::session();
        // Auth::privilege();
    }

    public function index()
    {
        $utilisateurs = (new Utilisateur)->all();
        return View::render('utilisateur/index', ['utilisateurs' => $utilisateurs]);
    }

    public function create()
    {
        $privileges = (new Privilege)->select('privilege');
        return View::render('utilisateur/create', [
            'utilisateur' => [],
            'privileges' => $privileges,
            'errors' => []
        ]);
    }

    public function store($data)
    {
        $validator = new Validator;

        $validator->field('nom', $data['nom'])->min(2)->max(50);
        $validator->field('email', $data['email'])->required()->email()->unique('Utilisateur');
        $validator->field('mot_de_passe', $data['mot_de_passe'])->required()->min(6)->max(255);
        $validator->field('nom_utilisateur', $data['nom_utilisateur'])->min(2)->max(50)->email()->unique('Utilisateur');
        $validator->field('adresse', $data['adresse'])->min(2)->max(100);
        // echo $data['privilege_id'];
        // $validator->field('privilege_id', $data['privilege_id'])->required()->int();

        if ($validator->isSuccess()) {
            $utilisateur = new Utilisateur;
            $data['mot_de_passe'] = $utilisateur->hashPassword($data['mot_de_passe']);
            $utilisateur->insert($data);
            return View::redirect('utilisateur');
        }

        return View::render('utilisateur/create', [
            'errors' => $validator->getErrors(),
            'utilisateur' => $data,
            'privileges' => (new Privilege)->select('privilege')
        ]);
    }

    public function edit($query)
    {
        $utilisateur = (new Utilisateur)->find($query['id']);
        $privileges = (new Privilege)->select('privilege');
        return View::render('utilisateur/edit', compact('utilisateur', 'privileges'));
    }

    public function update($data)
    {
        $validator = new Validator;

        $validator->field('nom', $data['nom'])->min(2)->max(50);
        $validator->field('email', $data['email'])->email()->max(100);
        $validator->field('adresse', $data['adresse'])->min(2)->max(100);
        $validator->field('privilege_id', $data['privilege_id'])->required()->int();

        if ($validator->isSuccess()) {
            $utilisateur = new Utilisateur;
            if (!empty($data['mot_de_passe'])) {
                $data['mot_de_passe'] = $utilisateur->hashPassword($data['mot_de_passe']);
            } else {
                unset($data['mot_de_passe']);
            }
            $utilisateur->update($data['id'], $data);
            return View::redirect('utilisateur');
        }

        return View::render('utilisateur/edit', [
            'utilisateur' => $data,
            'privileges' => (new Privilege)->select('privilege'),
            'errors' => $validator->getErrors()
        ]);
    }

    public function delete($query)
    {
        (new Utilisateur)->delete($query['id']);
        return View::redirect('utilisateur');
    }
}
