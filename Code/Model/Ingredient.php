<?php
/**
 * Classe correspondant aux ingérdients
 */
use App\Db\DbConnection;

require_once "../model/Connection.php";

class Ingredient
{   
    private $table = "Ingredient";
    private int $idIngredient;

    private string $libIngredient;
    
    public function __construct()
    {
        
    }

// les getters
    public function getIdIngredient() :int
    {
        return $this->idIngredient;
    }
        public function getLibIngredient() :string
    {
        return $this->libIngredient;
    }
    // les setters
    public function setIdIngredient($idIngredient)
    {   
        $this->idIngredient = $idIngredient;

    }

    public function setLibIngredient($libIngredient)
    {
        if($libIngredient != ""){
            $this->libIngredient = $libIngredient;
        }

    }

}

?>