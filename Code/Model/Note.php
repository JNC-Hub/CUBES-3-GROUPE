<?php

/**
 * Classe correspondant aux notes
 */

require_once "Connection.php";

class Note
{
    private $idUtilisateur;
    private $note;
    private $idRecette;

    public function __construct()
    {
    }

    // les getters

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
    public function insertNote()
    {
        $db = DbConnection::getInstance();

        $note = htmlspecialchars(strip_tags($this->libEtape));

        $query = "INSERT INTO noter (idRecette, idUtilisateur, note) VALUES (:idRecette, :idUtilisateur, :note)";

        $stmt = $db->prepare($query);

        $stmt->bindValue(":idRecette", $this->idRecette);
        $stmt->bindValue(":idUtilisateur", $this->idUtilisateur);
        $stmt->bindValue(":note", $this->note);

        $stmt->execute();
        $idEtape = $db->lastInsertId();

        $db->close();

        return $this;
    }
    public function checkIfUserRatedRecipe($idRecette, $idUtilisateur)
    {
        $db = DbConnection::getInstance();

        $query = "SELECT COUNT(*) FROM noter WHERE idRecette = :idRecette AND idUtilisateur = :idUtilisateur";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":idRecette", $idRecette);
        $stmt->bindValue(":idUtilisateur", $idUtilisateur);
        $stmt->execute();

        $count = $stmt->fetchColumn();

        $db = null;

        return ($count > 0);
    }

    public function getNoteRecette($idRecette)
    {
        $db = DbConnection::getInstance();

        $query = "SELECT AVG(note) FROM noter WHERE idRecette = :idRecette";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":idRecette", $idRecette);
        $stmt->execute();

        $averageNote = $stmt->fetchColumn();

        $db = null;

        return $averageNote;
    }

    public function updateRating($idRecette, $idutilisateur, $note)
    {
        $db = DbConnection::getInstance();

        $query = "UPDATE noter SET note = :note WHERE idRecette = :idRecette AND idUtilisateur = :idUtilisateur";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":note", $note);
        $stmt->bindValue(":idRecette", $idRecette);
        $stmt->bindValue(":idUtilisateur", $idutilisateur);
        $stmt->execute();

        $db = null;
    }
}
