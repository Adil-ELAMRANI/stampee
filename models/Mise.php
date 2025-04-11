<?php
namespace App\Models;

use PDO;

class Mise extends CRUD
{
    protected $table = 'mise';
    protected $primaryKey = 'id';

    protected $fillable = ['montant_mise', 'date', 'utilisateur_id', 'enchere_id'];

    public function getAllByEnchere($enchereId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM mise WHERE enchere_id = :enchere_id ORDER BY date DESC");
        $stmt->execute(['enchere_id' => $enchereId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDerniereMise($enchereId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM mise WHERE enchere_id = :enchere_id ORDER BY montant_mise DESC LIMIT 1");
        $stmt->execute(['enchere_id' => $enchereId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getMisesUtilisateur($utilisateurId)
    {
        $sql = "SELECT m.*, e.date_fin, t.nom as nom_timbre, t.image_principale 
                FROM mise m 
                JOIN enchere e ON m.enchere_id = e.id 
                JOIN timbre t ON e.timbre_id = t.id 
                WHERE m.utilisateur_id = :utilisateur_id 
                ORDER BY m.date DESC";
        
        $stmt = $this->prepare($sql);
        $stmt->execute(['utilisateur_id' => $utilisateurId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getMiseGagnante($enchereId)
    {
        $sql = "SELECT m.*, u.nom as nom_utilisateur 
                FROM mise m 
                JOIN utilisateur u ON m.utilisateur_id = u.id 
                WHERE m.enchere_id = :enchere_id 
                ORDER BY m.montant_mise DESC 
                LIMIT 1";
        
        $stmt = $this->prepare($sql);
        $stmt->execute(['enchere_id' => $enchereId]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function verifierMontantValide($montant, $enchereId)
    {
        // Vérifier si le montant est supérieur à la dernière mise
        $derniereMise = $this->getDerniereMise($enchereId);
        if ($derniereMise && $montant <= $derniereMise['montant_mise']) {
            return false;
        }

        // Vérifier si le montant est supérieur au prix plancher
        $enchere = (new Enchere)->selectId($enchereId);
        if ($montant < $enchere->prix_plancher) {
            return false;
        }

        return true;
    }
}