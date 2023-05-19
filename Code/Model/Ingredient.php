<?php

/**
 * Classe correspondant aux ingérdients
 */

use App\Db\DbConnection;

require_once "Connection.php";

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
            $libIngredient = htmlspecialchars(strip_tags($this->libIngredient));

            $query = "INSERT INTO etape (libIngredient) VALUES (:libIngredient)";

            $stmt = $db->prepare($query);

            $stmt->bindParam(":libIngredient", $libIngredient);

            $stmt->execute();

            $db->close();
        }
    }
}
