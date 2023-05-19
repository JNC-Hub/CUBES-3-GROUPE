<?php

use App\Db\DbConnection;

require_once "Connection.php";

class Contenir
{
    #Contienent//Propriétés

    private int $idRecette;
    private int $idIngredient;
    private int $idUniteMesure;
    private float $quantite;

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
}
