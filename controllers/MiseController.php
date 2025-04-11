<?php
namespace App\Controllers;

use App\Models\Mise;
use App\Models\Enchere;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class MiseController
{
    public function __construct()
    {
        Auth::session();
    }

    public function index()
    {
        if (!isset($_SESSION['utilisateur'])) {
            header('Location: /login');
            exit;
        }

        $mises = (new Mise)->getMisesUtilisateur($_SESSION['utilisateur']['id']);
        return View::render('mise/index', compact('mises'));
    }

    public function store()
    {
        if (!isset($_SESSION['utilisateur'])) {
            header('Location: /login');
            exit;
        }

        $data = [
            'montant_mise' => $_POST['montant_mise'],
            'date' => date('Y-m-d H:i:s'),
            'utilisateur_id' => $_SESSION['utilisateur']['id'],
            'enchere_id' => $_POST['enchere_id']
        ];

        $validator = new Validator($data, [
            'montant_mise' => 'required|numeric|min:1',
            'enchere_id' => 'required|numeric'
        ]);

        if (!$validator->isValid()) {
            $_SESSION['errors'] = $validator->getErrors();
            header('Location: /enchere/' . $data['enchere_id']);
            exit;
        }

        $mise = new Mise();
        
        // Vérifier si le montant est valide
        if (!$mise->verifierMontantValide($data['montant_mise'], $data['enchere_id'])) {
            $_SESSION['errors'] = ['montant_mise' => 'Le montant doit être supérieur à la dernière mise et au prix plancher'];
            header('Location: /enchere/' . $data['enchere_id']);
            exit;
        }

        // Vérifier si l'enchère est toujours active
        $enchere = (new Enchere)->selectId($data['enchere_id']);
        if (strtotime($enchere->date_fin) < time()) {
            $_SESSION['errors'] = ['enchere' => 'Cette enchère est terminée'];
            header('Location: /enchere/' . $data['enchere_id']);
            exit;
        }

        $mise->insert($data);
        $_SESSION['success'] = 'Votre mise a été enregistrée avec succès';
        header('Location: /enchere/' . $data['enchere_id']);
        exit;
    }

    public function mesMises()
    {
        if (!isset($_SESSION['utilisateur'])) {
            header('Location: /login');
            exit;
        }

        $mises = (new Mise)->getMisesUtilisateur($_SESSION['utilisateur']['id']);
        return View::render('mise/mes-mises', compact('mises'));
    }
}