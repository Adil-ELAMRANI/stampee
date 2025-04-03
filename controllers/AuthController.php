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
        // Vérifier si une session est déjà active avant de la démarrer
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $validator = new Validator;
        $validator->field('nom_utilisateur', $data['nom_utilisateur'])->min(2)->max(50);
        $validator->field('mot_de_passe', $data['mot_de_passe'])->min(6)->max(255);

        if ($validator->isSuccess()) {
            $user = new Utilisateur;

            $utilisateur = $user->checkUser($data['nom_utilisateur'], $data['mot_de_passe']);
            if ($utilisateur) {
                session_regenerate_id();
                // Stocker les infos utiles dans la session
                $_SESSION['utilisateur'] = [
                    'id' => $utilisateur->id,
                    'nom' => $utilisateur->nom,
                    'privilege_id' => $utilisateur->privilege_id
                ];
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOT_ADDR']);

                // Correction de la redirection

                return View::redirect('');
            } else {
                $errors['message'] = 'Identifiants incorrects.';
                return View::render('auth/index', ['errors' => $errors, 'utilisateur' => $data]);
            }
        } else {
            return View::render('auth/index', [
                'errors' => $validator->getErrors(),
                'utilisateur' => $data
            ]);
        }
    }

    public function delete() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_unset();
        session_destroy();
        $base = str_replace('//', '/', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'));
        return View::redirect(url: ''); 
    }
}
