<?php

use App\Db\DbConnection;

require_once "Connection.php";

class StatutRecette
{
    #region//Propriétés
    private int $idStatut;
    private string $libStatut;
    #endregion

    #region//Constructeur
    public function __construct()
    {
    }
    //  getters
    public function __get($pParam)
    {
        if (isset($pParam)) {
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
    public function getLibStautFromId($idStatut)
    {
        $db = DbConnection::getInstance();

        $query = "SELECT libStatut FROM statutRecette WHERE idStatut = :idStatut";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":idStatut", $idStatut);
        $stmt->execute();
        $libStatut = $stmt->fetchColumn();
        $db->close();
        return $libStatut;
    }
}
