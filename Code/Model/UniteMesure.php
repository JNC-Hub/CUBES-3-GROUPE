<?php
/**
 * Classe correspondant aux unités  des mesures
 */
use App\Db\DbConnection;

require_once "../model/Connection.php";

class UniteMesure
{   
    private $table = "UniteMesure";
    private int $idUniteMesure;

    private string $libUniteMesure;
    
    public function __construct()
    {
        
    }

// les getters
    public function getIdUniteMesure() :int
    {
        return $this->idUniteMesure;
    }
        public function getLibUniteMesure() :string
    {
        return $this->libUniteMesure;
    }
    // les setters
    public function setIdUniteMesure($idUniteMesure)
    {   
        $this->idUniteMesure = $idUniteMesure;

    }

    public function setLibUniteMesure($libUniteMesure)
    {
        if($libUniteMesure != ""){
            $this->libUniteMesure = $libUniteMesure;
        }

    }

}

?>