<?php
namespace App\Models;

use App\Models\CRUD;

class Utilisateur extends CRUD{
    protected $table = "utilisateur";
    protected $primaryKey = "id";
    protected $fillable = ['nom', 'email', 'mot_de_passe', 'nom_utilisateur', 'adresse', 'privilege_id'];


    public function find($id) {
        return $this->selectId($id);
    }
    

    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    public function all()
    {
        $sql = "SELECT u.*, p.privilege FROM utilisateur u INNER JOIN privilege p ON u.privilege_id = p.id";
        return $this->query($sql)->fetchAll(\PDO::FETCH_OBJ);
    }

    /*public function checkUser($username, $password) {
        // Récupération de l'utilisateur (objet stdClass)
        $user = $this->unique('nom_utilisateur', $username);
    
        if ($user) {
            $hash = $user->mot_de_passe;
    
            // Vérification du mot de passe
            if (password_verify((string)$password, (string)$hash)) {
                session_regenerate_id(true);
    
                $_SESSION['id'] = $user->id;
                $_SESSION['nom_utilisateur'] = $user->nom_utilisateur;
                $_SESSION['privilege_id'] = $user->privilege_id;
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
    
                return true;
            }
        }
    
        return false;
    }*/
    
    public function checkUser($username, $password) {
        // Récupération de l'utilisateur (objet stdClass)
        $user = $this->unique('nom_utilisateur', $username);
    
        if ($user && password_verify((string)$password, (string)$user->mot_de_passe)) {
            return $user; // Renvoie l’objet utilisateur pour traitement dans le contrôleur
        }
    
        return false;
    }    

    public function getUsersWithPrivileges() {
        $sql = "SELECT user.id, nom_utilisateur, user.email, privilege.name AS privilege_name 
                FROM user 
                JOIN privilege ON user.privilege_id = privilege.id";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }
    
    
    
}


