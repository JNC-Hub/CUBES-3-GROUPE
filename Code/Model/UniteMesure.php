<?php

/**
 * Classe correspondant aux unités  des mesures
 */

use App\Db\DbConnection;

require_once "Connection.php";

class UniteMesure
{
    private $table = "uniteMesure";
    private int $idUniteMesure;

    private string $libUniteMesure;

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
    public  function getListUniteMesure()
    {
        $db = DbConnection::getInstance();
        $requete = "SELECT * FROM " . $this->table;
        $requetListUnite =  $db->prepare($requete);
        $requetListUnite->execute();
        $listUnite = $requetListUnite->fetchAll(PDO::FETCH_ASSOC);
        $db->close();
        return $listUnite;
    }
    public function getIdUniteMesureFromLib($lib)
    {
        $db = DbConnection::getInstance();
        $query = "SELECT idUniteMesure FROM " . $this->table . " WHERE libUniteMesure = :lib";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":lib", $lib);
        $stmt->execute();
        $unite = $stmt->fetchColumn();
        $db->close();
        return $unite;
    }
}
