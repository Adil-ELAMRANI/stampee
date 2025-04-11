<?php
namespace App\Providers;
use App\Providers\View;

class Auth {
    static public function session(){
        if($_SESSION['fingerPrint'] == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'])){
            return true;
        }
        return View::redirect('');
    }

    static public function privilege($id){
        if($_SESSION['privilege_id'] == $id){
            return true;
        }
        return View::redirect('');
    }
}
