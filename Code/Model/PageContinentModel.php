<?php
/**
 * Classe correspondant aux images
 */
use App\Db\DbConnection;

require_once "../model/Connection.php";

class ImageModel {
    private $db;
  
    public function __construct($db) {
      $this->db = $db;
    }
  
    public function getImages() {
      $stmt = $this->db->prepare("SELECT `image`FROM `recette` WHERE `idRecette`");
      $stmt->execute();
      return $stmt->fetchAll();
    }
  }


?>