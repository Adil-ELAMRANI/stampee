<?php
namespace App\Controllers;
use App\Providers\View;
class HomeController{
    public function index(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        $asset = $base . '/public';
        return View::render('stampee/index', [
            'base' => $base,
            'asset' => $asset,
            'guest' => !isset($_SESSION['utilisateur']),
            'session' => $_SESSION ?? []
        ]);
    }
}
