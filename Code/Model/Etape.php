<?php

/**
 * Classe correspondant aux etapes
 */

use App\Db\DbConnection;

require_once "Connection.php";

class Etape
{
    private int $idEtape = -1;

    private string $libEtape = "";
    private int $idRecette = -1;

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
    public function insertEtape()
    {
        $db = DbConnection::getInstance();

        $libEtape = htmlspecialchars(strip_tags($this->libEtape));

        $query = "INSERT INTO etape (libEtape, idRecette) VALUES (:libEtape, :idRecette)";

        $stmt = $db->prepare($query);

        $stmt->bindParam(":libEtape", $libEtape);
        $stmt->bindParam(":idRecette", $this->idRecette);

        $stmt->execute();
        $idEtape = $db->lastInsertId();

        $db->close();

        $this->idEtape = $idEtape;

        return $this;
    }
    public function deleteRecipe($idRecette)
    {
        $db = DbConnection::getInstance();

        $query = "DELETE FROM etape WHERE idRecette = :idRecette";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":idRecette", $idRecette);
        $stmt->execute();
        $db->close();
    }

    public function getEtapesRecipe($idRecette)
    {

        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT *
                                FROM Etape E
                                WHERE idRecette = :idRecette");
        $stmt->bindValue(":idRecette", $idRecette);
        $stmt->execute();
        $etapes = $stmt->fetchAll(PDO::FETCH_CLASS, 'Etape');
        $db->close();
        return $etapes;
    }
}
