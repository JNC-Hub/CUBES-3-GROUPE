<?php

/**
 * Classe correspondant aux ingérdients
 */

use App\Db\DbConnection;

require_once "Connection.php";

class Ingredient
{
    private $table = "ingredient";
    private int $idIngredient = -1;

    private string $libIngredient = "";

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
    public  function isExistIngredient($libIngredient)
    {
        $libIngredient = htmlspecialchars(strip_tags($libIngredient));
        $listIngredient = $this->getListIngredients();
        foreach ($listIngredient as $ingredient) {
            if ($libIngredient === $ingredient['libIngredient']) {
                return true;
            }
        }
        return false;
    }
    public function insertIngredient($libIngredient)
    {
        $db = DbConnection::getInstance();
        if (!$this->isExistIngredient($libIngredient)) {
            $libIngredient = htmlspecialchars(strip_tags($libIngredient));

            $query = "INSERT INTO ingredient (libIngredient) VALUES (:libIngredient)";

            $stmt = $db->prepare($query);

            $stmt->bindParam(":libIngredient", $libIngredient);

            $stmt->execute();
            $idIngredient = $db->lastInsertId();
            $db->close();
            return  $idIngredient;
        }
    }
    public function getIdIngredientFromLib($lib)
    {
        $db = DbConnection::getInstance();
        $query = "SELECT idIngredient FROM " . $this->table . " WHERE libIngredient = :lib";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":lib", $lib);
        $stmt->execute();
        $idIngredient = $stmt->fetchColumn();
        $db->close();
        return $idIngredient;
    }
}
