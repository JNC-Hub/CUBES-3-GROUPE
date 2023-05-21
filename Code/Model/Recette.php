<?php

use App\Db\DbConnection;

require_once "Connection.php";

class Recette
{
    #region//Propriétés
    private int $idRecette = -1;
    private DateTime $dateRecette;
    private string $titre = "";
    private int $nbPersonnes = -1;
    private string $histoire = "";
    private int $idStatut = -1;
    private int $idUtilisateur = -1;
    private int $idPays = -1;
    #endregion

    #region//Constructeur
    public function __construct()
    {
        $this->dateRecette = new DateTime();
    }
    public function __get($pParam)
    {
        if (isset($this->$pParam)) {
            return $this->$pParam;
        } else {
            throw new Exception("Parametre inconnu : " . $pParam);
        }
    }
    // les setters

    public function __set($pParam, $pValue)
    {
        if (isset($pParam)) {
            $this->$pParam = $pValue;
        } else {
            throw new Exception("Parametre inconnu : " . $pParam);
        }
    }
    public function insertRecipie()
    {
        $db = DbConnection::getInstance();

        $titre = htmlspecialchars(strip_tags($this->titre));
        $nbPersonnes = htmlspecialchars(strip_tags($this->nbPersonnes));
        $histoire = htmlspecialchars(strip_tags($this->histoire));
        $idUtilisateur = $this->idUtilisateur;
        $idPays = $this->idPays;
        $dateRecette = $this->dateRecette->format('Y-m-d H:i:s');

        $query = "INSERT INTO recette (dateRecette, titre, nbPersonnes, histoire, idUtilisateur, idStatut, idPays) 
                  VALUES (:dateRecette, :titre, :nbPersonnes, :histoire, :idUtilisateur, 1, :idPays)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":dateRecette", $dateRecette);
        $stmt->bindParam(":titre", $titre);
        $stmt->bindParam(":nbPersonnes", $nbPersonnes);
        $stmt->bindParam(":histoire", $histoire);
        $stmt->bindParam(":idUtilisateur", $idUtilisateur);
        $stmt->bindParam(":idPays", $idPays);

        $stmt->execute();

        $idRecette = $db->lastInsertId();

        $db->close();

        $this->idRecette = $idRecette;
        return $this;
    }

    // fonction de recupération
    // public function getImageById($idRecette)
    // {
    //     // création de la connexion à la base de données
    //     $db = DbConnection::getInstance();

    //     // préparation de la requête
    //     $stmt = $db->prepare("SELECT image FROM recette WHERE idRecette = :idRecette ORDER BY dateRecette");

    //     // liaison des paramètres
    //     $stmt->bindParam(":idRecette", $idRecette);

    //     // exécution de la requête
    //     $stmt->execute();

    //     // récupération du résultat
    //     $result = $stmt->fetch(PDO::FETCH_COLUMN);

    //     $db->close();
    //     // retour du chemin d'accès de l'image
    //     return $result;
    // }
}