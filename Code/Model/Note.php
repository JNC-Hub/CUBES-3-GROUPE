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

        $query = "INSERT INTO noter (idRecette, idUtilisateur, note) VALUES (:idRecette, :idUtilisateur, :note)";

        $stmt = $db->prepare($query);

        $stmt->bindValue(":idRecette", $this->idRecette);
        $stmt->bindValue(":idUtilisateur", $this->idUtilisateur);
        $stmt->bindValue(":note", $this->note);

        $stmt->execute();

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

        $db->close();

        return $count;
    }

    public function getNoteRecette($idRecette)
    {
        $db = DbConnection::getInstance();

        $query = "SELECT AVG(note) FROM noter WHERE idRecette = :idRecette";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":idRecette", $idRecette);
        $stmt->execute();

        $averageNote = $stmt->fetchColumn();
        error_log($query);
        $db->close();

        return $averageNote;
    }

    public function updateRating()
    {
        $db = DbConnection::getInstance();

        $query = "UPDATE noter SET note = :note WHERE idRecette = :idRecette AND idUtilisateur = :idUtilisateur";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":idRecette", $this->idRecette);
        $stmt->bindValue(":idUtilisateur", $this->idUtilisateur);
        $stmt->bindValue(":note", $this->note);

        $stmt->execute();

        $db->close();
    }
    public function deleteNote($idRecette)
    {
        $db = DbConnection::getInstance();

        $query = "DELETE FROM note WHERE idRecette = :idRecette";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":idRecette", $idRecette);
        $stmt->execute();
        $db->close();
    }
}
