<?php
/**
 * Classe correspondant aux etapes
 */
use App\Db\DbConnection;

require_once "../model/Connection.php";

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
    public function setIdEtape($idEtape)
    {   
        $this->idEtape = $idEtape;

    }

    public function setLibEtape($libEtape)
    {
        if($libEtape != ""){
            $this->libEtape = $libEtape;
        }

    }

}

?>