<?php
/**
 * Classe correspondant aux etapes
 */
use App\Db\DbConnection;

require_once "../Model/Connection.php";


class Etape
{   
    private $table = "Etape";
    private int $idEtape;

    private string $libEtape;
    
    public function __construct()
    {
        
    }

// les getters
    public function getIdEtape() :int
    {
        return $this->idEtape;
    }
        public function getLibEtape() :string
    {
        return $this->libEtape;
    }
    // les setters
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