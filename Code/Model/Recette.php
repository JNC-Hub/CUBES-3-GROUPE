<?php

use App\Db\DbConnection;

require_once "Connection.php";

class Recette
{
    #region//Propriétés
    private int $idRecette;
    private DateTime $dateRecette;
    private string $titre;
    private int $nbPersonnes;
    private string $histoire;
    private string $image;
    private int $idStatut;
    private int $idUtilisateur;
    private int $idPays;
    #endregion

    #region//Constructeur
    public function __construct()
    {
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
        $dateRecette = $this->dateRecette;

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
}
