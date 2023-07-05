<?php

require_once "Connection.php";

class Contenir
{
    #Contienent//Propriétés

    private int $idRecette = -1;
    private int $idIngredient = -1;
    private int $idUniteMesure = -1;
    private float $quantite = -1;

    public function __construct()
    {
    }

    //  getters
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
    public function insertContenirRelation()
    {
        $db = DbConnection::getInstance();

        $query = "INSERT INTO contenir (idRecette, idIngredient, idUniteMesure, quantite) VALUES (:idRecette, :idIngredient, :idUniteMesure, :quantite)";

        $stmt = $db->prepare($query);

        $stmt->bindParam(":idRecette", $this->idRecette);
        $stmt->bindParam(":idIngredient", $this->idIngredient);
        $stmt->bindParam(":idUniteMesure", $this->idUniteMesure);
        $stmt->bindParam(":quantite", $this->quantite);

        $stmt->execute();

        $db->close();
    }
    public function deleteRelation($idRecette)
    {
        $db = DbConnection::getInstance();

        $query = "DELETE FROM contenir WHERE idRecette = :idRecette";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":idRecette", $idRecette);
        $stmt->execute();
        $db->close();
    }
    public function getIngredientsRecipe($idRecette)
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT R.idRecette, C.quantite, I.libIngredient, UM.libUniteMesure, UM.idUniteMesure FROM contenir C
                    INNER JOIN recette R ON C.idRecette = R.idRecette
                    INNER JOIN ingredient I ON C.idIngredient = I.idIngredient
                    INNER JOIN unitemesure UM ON UM.idUniteMesure = C.idUniteMesure
                    WHERE R.idRecette = :idRecette");
        $stmt->bindValue(":idRecette", $idRecette);
        $stmt->execute();
        $ingredientsRecipe = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db->close();
        return $ingredientsRecipe;
    }
}
