<?php
namespace App\Controllers;

use App\Models\Utilisateur;
use App\Providers\View;
use App\Providers\Validator;

class AuthController {
    public function index() {
        return View::render('auth/index');
    }

    public function store($data) {
        $validator = new Validator;
        $validator->field('nom_utilisateur', $data['nom_utilisateur'])->email()->min(2)->max(50);
        $validator->field('mot_de_passe', $data['mot_de_passe'])->min(6)->max(255);

        if ($validator->isSuccess()) {
            $user = new Utilisateur;
            if ($user->checkUser($data['nom_utilisateur'], $data['mot_de_passe'])) {
                return View::redirect('utilisateur');
            } else {
                $errors['message'] = 'Identifiants incorrects.';
                return View::render('auth/index', ['errors' => $errors, 'utilisateur' => $data]);
            }
        } else {
            return View::render('auth/index', ['errors' => $validator->getErrors(), 'utilisateur' => $data]);
        }
    }

    public function delete() {
        session_destroy();
        return View::redirect('login');
    }
}
