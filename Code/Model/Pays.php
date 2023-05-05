<?php
/**
 * Classe correspondant aux pays
 */
use App\Db\DbConnection;

require_once "../Model/Connection.php";


class Pays
{   
   
    private int $idPays;

    private string $libPays;
    
    private int $idContinent;
    public function __construct()
    {
        
    }

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
    public  function getListPays()
    {
     $db = DbConnection::getInstance();
     $requete = "SELECT * FROM pays ";
     $requetListpays =  $db->prepare($requete);
     $requetListpays->execute();
     $listPays = $requetListpays->fetchAll(PDO::FETCH_ASSOC);
     $db->close();
     return $listPays;
    
     
    }

}

?>