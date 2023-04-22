<?php
/**
 * Classe correspondant aux pays
 */
use App\Db\DbConnection;

require_once "../model/Connection.php";

class Pays
{   
    private $table = "Pays";
    private int $idPays;

    private string $libPays;
    
    public function __construct()
    {
        
    }

// les getters
    public function getIdPays() :int
    {
        return $this->idPays;
    }
        public function getLibPays() :string
    {
        return $this->libPays;
    }
    // les setters
    public function setIdPays($idPays)
    {   
        $this->idPays= $idPays;

    }

    public function setLibPays($libPays)
    {
        if($libPays != ""){
            $this->libPays = $libPays;
        }

    }

}

?>