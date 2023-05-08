<?php

/**
 * Classe correspondant aux ingérdients
 */

use App\Db\DbConnection;

require_once "../Model/Connection.php";

class Ingredient
{
    private $table = "ingredient";
    private int $idIngredient;

    private string $libIngredient;

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
        if (isset($this->$pParam)) {
            $this->$pParam = $pValue;
        } else {
            throw new Exception("Parametre inconnu : " . $pParam);
        }
    }
    public  function getListIngredients()
    {
        $db = DbConnection::getInstance();
        $requete = "SELECT * FROM " . $this->table;
        $requetListIngredient =  $db->prepare($requete);
        $requetListIngredient->execute();
        $listIngredients = $requetListIngredient->fetchAll(PDO::FETCH_ASSOC);
        $db->close();
        return $listIngredients;
    }
}
