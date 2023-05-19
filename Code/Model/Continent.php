<?php

use App\Db\DbConnection;

require_once "Connection.php";

class Continent
{
    #Contienent//Propriétés
    private $table = "Continent";
    private int $idContinent;
    private string $libContinent;

    public function __construct()
    {
    }

    //  getters
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
    public static function getListContinent()
    {
        $db = DbConnection::getInstance();
        $requete = "SELECT * FROM continent";
        $requetListContinent =  $db->prepare($requete);
        $requetListContinent->execute();
        $listContinent = $requetListContinent->fetchAll(PDO::FETCH_ASSOC);
        $db->close();
        return $listContinent;
    }
}
