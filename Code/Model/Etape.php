<?php

/**
 * Classe correspondant aux etapes
 */

use App\Db\DbConnection;

require_once "Connection.php";

class Etape
{
    private int $idEtape;

    private string $libEtape;

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

        $query = "INSERT INTO etape (libEtape) VALUES (:libEtape)";

        $stmt = $db->prepare($query);

        $stmt->bindParam(":libEtape", $libEtape);

        $stmt->execute();
        $idEtape = $db->lastInsertId();

        $db->close();

        $this->idEtape = $idEtape;

        return $this;
    }
}
