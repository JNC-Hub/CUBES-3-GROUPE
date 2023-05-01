<?php

use App\Db\DbConnection;

require_once "../Model/Connection.php";

class Continent
{
    #Contienent//Propriétés
    private $table = "Continent";
    private int $idContinent;
    private string $libContinent;
  
    public function __construct()
    {
    }
   
   // les getters
   public function getIdContinent() :int
   {
       return $this->idContinent;
   }
       public function getLibContinent() :string
   {
       return $this->libContinent;
   }
//    controler l'acces aux propietes privéées d'un objet
   //  getters
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
   public static function getListContinent()
   {
    $db = DbConnection::getInstance();
    $requete = "SELECT * FROM continent" ;
    $requetListContinent =  $db->prepare($requete);
    $requetListContinent->execute();
    $listContinent = $requetListContinent->fetchAll(PDO::FETCH_ASSOC);
    $db->close();
    return $listContinent;
   
    
   }
}