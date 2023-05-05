<?php

use App\Db\DbConnection;

require_once "../Model/Connection.php";

class Recette
{
    #region//Propriétés
    public int $idRecette;
    public DateTime $dateRecette;
    public string $titre;
    public int $nbPersonnes;
    public string $histoire;
    public string $image;
    #endregion

    #region//Constructeur
    // public function __construct(DateTime $dateRecette, string $titre, int $nbPersonnes, string $histoire, string $image)
    // {
    //     $this->dateRecette = $dateRecette;
    //     $this->titre = $titre;
    //     $this->nbPersonnes = $nbPersonnes;
    //     $this->histoire = $histoire;
    //     $this->image = $image;
    // }
    #endregion

    #region//Méthodes

    #endregion

    // fonction de recupération
    public function getImageById($idRecette) {
        // création de la connexion à la base de données
        $db = DbConnection::getInstance();
        
        // préparation de la requête
        $stmt = $db->prepare("SELECT image FROM recette WHERE idRecette = :idRecette ORDER BY dateRecette");

        // liaison des paramètres
        $stmt->bindParam(":idRecette", $idRecette);

        // exécution de la requête
        $stmt->execute();

        // récupération du résultat
        $result = $stmt->fetch(PDO::FETCH_COLUMN);

        $db->close();
        // retour du chemin d'accès de l'image
        return $result;
        
    }
}