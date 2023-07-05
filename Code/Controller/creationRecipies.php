<?php
require_once('authentification.php');
require_once("../Model/Recette.php");
require_once("../Model/Ingredient.php");
require_once("../Model/Etape.php");
require_once("../Model/Contenir.php");
require_once("../Model/UniteMesure.php");
require_once("../Model/Note.php");
// Header ouvre l'api à tous les sources pour y acceder (*)
header("Access-Control-Allow-Origin: *");
// contenu de reponse json
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // on récupére id utulisateur pour le stocker dans table recette
    if (isset($_SESSION['user'])) {
        $idUtilisateur = $_SESSION['user']['idUtilisateur'];
    }
    // on instancie les classes
    $etapeInstance = new Etape();
    $ingredientInstance = new Ingredient();
    $recetteInstance = new Recette();
    $relationContenir = new Contenir();
    $uniteInstance = new UniteMesure();
    $note = new Note();
    // on décode le data (car elle est sous forme json)

    $recetteInstance->titre = $_POST['title'];
    $recetteInstance->nbPersonnes =  intval($_POST['nombrePersonne']);
    $recetteInstance->histoire = $_POST['histoire'];
    $recetteInstance->idUtilisateur = intval($idUtilisateur);
    $recetteInstance->idPays = intval($_POST['pays']);
    $recetteInstance->insertRecipie();
    $idRecette = $recetteInstance->idRecette;

    $dataIngredient = json_decode($_POST['ingredients'], true);
    foreach ($dataIngredient as $objectIngredient) {

        $quantite = $objectIngredient['quantite'];
        $uniteLib = $objectIngredient['unite'];
        $ingredient = $objectIngredient['ingredient'];
        //  mettre l'ingredient en maj avant le verifier et le stocker 
        $ingredient = strtolower($ingredient);
        $ingredient = ucfirst($ingredient);

        $idIngredient = $ingredientInstance->insertIngredient($ingredient);

        $idIngredient =  $ingredientInstance->getIdIngredientFromLib($ingredient);

        $relationContenir->idIngredient = $idIngredient;
        if ($uniteLib == "") {
            $uniteLib = ' ';
        }
        $unite = $uniteInstance->getIdUniteMesureFromLib($uniteLib);
        $relationContenir->idUniteMesure = $unite;
        $relationContenir->quantite =  (float) $quantite;
        $relationContenir->idRecette = $idRecette;
        $relationContenir->insertContenirRelation();
    }
    // inserer les etapes + recupereation des id 
    // decoder le json car on recoit un json 

    $dataEtape = json_decode($_POST['etapes'], true);
    foreach ($dataEtape as $objectEtape) {
        $etape = trim($objectEtape["etape"]);
        $etapeInstance->libEtape = $etape;
        $etapeInstance->idRecette = $idRecette;
        $etapeInstance->insertEtape();
    }

    if (isset($_FILES['img_book']) && $_FILES['img_book']['error'] === UPLOAD_ERR_OK) {
        error_log(("test"));
        // DIRECTORY_SEPARATOR selon linux / ou \
        $targetDirectory = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'imageRecipe';
        $imageType = pathinfo($_FILES['img_book']['name'], PATHINFO_EXTENSION);
        $targetFileName = $idRecette . '.' . $imageType;
        // nom fichier avec lid recette pour la récupération
        $targetPath = $targetDirectory . DIRECTORY_SEPARATOR . $targetFileName;
        $sourceFilePath = $_FILES['img_book']['tmp_name'];

        // Check if the source file exists
        if (file_exists($sourceFilePath)) {
            echo 'Source file exists.';
        } else {
            echo 'Source file does not exist.';
            error_log(("Source file does not exist"));
        }

        // Validate the target file path
        if (is_dir($targetDirectory)) {
            echo 'Target directory is valid .';
        } else {
            echo 'Target directory is not valid.';
        }
        if (is_writable($targetDirectory)) {
            echo 'Target directory is not writable.';
        } else {
            echo 'Target directory is not  writable.';
        }

        // Attempt to move the uploaded file if the source file exists and the target directory is valid
        if (file_exists($sourceFilePath) && is_dir($targetDirectory) && is_writable($targetDirectory)) {
            if (move_uploaded_file($sourceFilePath, $targetPath)) {
                echo 'Success';
            } else {
                echo 'Error moving the file: ' . error_get_last()['message'];
            }
        } else {
            echo 'Invalid source file or target directory';
        }
    } else {
        echo 'Image file upload error';
    }
}
// header('Location: ../Controller/compteUtilisateur.php');