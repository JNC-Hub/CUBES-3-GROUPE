<?php
/**
 * Classe correspondant aux unités  des mesures
 */
use App\Db\DbConnection;

require_once "../Model/Connection.php";


class UniteMesure
{   
    private $table = "UniteMesure";
    private int $idUniteMesure;

    private string $libUniteMesure;
    
    public function __construct()
    {
        
    }

// les getters
    public function __get($pParam){
        if(isset($this->$pParam)){
            return $this->$pParam;
        } else {
            throw new Exception("Parametre inconnu : ".$pParam);
        }
        
    }
        // les setters

    public function __set($pParam, $pValue){
        if(isset($this->$pParam)){
            $this->$pParam = $pValue;
        } else {
            throw new Exception("Parametre inconnu : ".$pParam);
        }
    }

}

?>