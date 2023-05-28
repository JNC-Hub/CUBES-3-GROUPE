<?php

use App\Db\DbConnection;

require_once "Connection.php";

class Recette
{
    #region//Propriétés
    private int $idRecette = -1;
    private DateTime $dateRecette;
    private string $titre = "";
    private int $nbPersonnes = -1;
    private string $histoire = "";
    private int $idStatut = -1;
    private int $idUtilisateur = -1;
    private int $idPays = -1;
    #endregion

    #region//Constructeur
    public function __construct()
    {
        $this->dateRecette = new DateTime();
    }
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
    public function insertRecipie()
    {
        $db = DbConnection::getInstance();

        $titre = htmlspecialchars(strip_tags($this->titre));
        $nbPersonnes = htmlspecialchars(strip_tags($this->nbPersonnes));
        $histoire = htmlspecialchars(strip_tags($this->histoire));
        $idUtilisateur = $this->idUtilisateur;
        $idPays = $this->idPays;
        $dateRecette = $this->dateRecette->format('Y-m-d H:i:s');

        $query = "INSERT INTO recette (dateRecette, titre, nbPersonnes, histoire, idUtilisateur, idStatut, idPays) 
                  VALUES (:dateRecette, :titre, :nbPersonnes, :histoire, :idUtilisateur, 1, :idPays)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":dateRecette", $dateRecette);
        $stmt->bindParam(":titre", $titre);
        $stmt->bindParam(":nbPersonnes", $nbPersonnes);
        $stmt->bindParam(":histoire", $histoire);
        $stmt->bindParam(":idUtilisateur", $idUtilisateur);
        $stmt->bindParam(":idPays", $idPays);

        $stmt->execute();

        $idRecette = $db->lastInsertId();

        $db->close();

        $this->idRecette = $idRecette;
        return $this;
    }

    // fonction de recupération
    // public function getImageById($idRecette)
    // {
    //     // création de la connexion à la base de données
    //     $db = DbConnection::getInstance();

    //     // préparation de la requête
    //     $stmt = $db->prepare("SELECT image FROM recette WHERE idRecette = :idRecette ORDER BY dateRecette");

    //     // liaison des paramètres
    //     $stmt->bindParam(":idRecette", $idRecette);

    //     // exécution de la requête
    //     $stmt->execute();

    //     // récupération du résultat
    //     $result = $stmt->fetch(PDO::FETCH_COLUMN);

    //$db->close();
    // retour du chemin d'accès de l'image
    //return $result;
    // }

    public function getRecipe($idRecette)
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT * From recette WHERE idRecette = :idRecette");
        $stmt->bindValue(":idRecette", $idRecette);
        $stmt->execute();
        $recipe = $stmt->fetch(PDO::FETCH_OBJ);
        $db->close();
        return $recipe;
    }

    public function getIngredientsRecipe($idRecette)
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT C.quantite, I.libIngredient, UM.libUniteMesure FROM contenir C
                    INNER JOIN recette R ON C.idRecette = R.idRecette
                    INNER JOIN ingredient I ON C.idIngredient = I.idIngredient
                    INNER JOIN unitemesure UM ON UM.idUniteMesure = C.idUniteMesure
                    WHERE R.idRecette = :idRecette");
        $stmt->bindValue(":idRecette", $idRecette);
        $stmt->execute();
        $ingredientsRecipe = $stmt->fetchAll(PDO::FETCH_CLASS, 'Recette');
        $db->close();
        return $ingredientsRecipe;
    }

    public function getAllRecipeStatutAValider()
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT * FROM recette WHERE idStatut=1 ORDER BY idRecette DESC ");
        $stmt->execute();
        $recipeAValider = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $db->close();
        return $recipeAValider;
    }
    public function validateRecipe($idRecette)
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("UPDATE recette SET idStatut = 2 WHERE idRecette = :idRecette");
        $stmt->bindValue(":idRecette", $idRecette);
        $stmt->execute();
        $db->close();
    }
    public function rejectRecipe($idRecette)
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("UPDATE recette SET idStatut = 3 WHERE idRecette = :idRecette");
        $stmt->bindValue(":idRecette", $idRecette);
        $stmt->execute();
        $db->close();
    }
    public function getAllValidateRecipes()
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT * FROM recette WHERE idStatut=2 ORDER BY idRecette DESC ");
        $stmt->execute();
        $validateRecipe = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $db->close();
        return $validateRecipe;
    }
    public function deleteRecipe($idRecette)
    {
        $db = DbConnection::getInstance();

        $query = "DELETE FROM recette WHERE idRecette = :idRecette";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":idRecette", $idRecette);
        $stmt->execute();
        $db->close();
    }
    public function getRecipesUser($idUtilisateur)
    {
        $db = DbConnection::getInstance();

        $query = "SELECT * FROM recette WHERE idUtilisateur= :idUtilisateur ORDER BY idRecette DESC ";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":idUtilisateur", $idUtilisateur);
        $stmt->execute();
        $RecipesUser = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $db->close();
        return $RecipesUser;
    }
}
