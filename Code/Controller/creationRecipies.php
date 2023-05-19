<?php
require_once("../Model/Recette.php");
require_once("../Model/Ingredient.php");
require_once("../Model/Etape.php");
$etapeInstance = new Etape();
$ingredientInstance = new Ingredient();
$recetteInstance = new Recette();

// inserer les etapes + recupereation des id 
// decoder le json car 
$insertedIdsEtape = array();
$dataEtape = json_decode($_POST['etapes'], true);
foreach ($dataEtape as $objectEtape) {
    $etape = trim($objectEtape["etape"]);
    error_log($etape);
    $etapeInstance->libEtape = $etape;
    $etapeInstance->insertEtape();
    $insertedIdsEtape[] = $etapeInstance->idEtape;
}
$dataIngredient = json_decode($_POST['ingredients'], true);
$insertedIdsIngredient = array();
foreach ($dataIngredient as $objectIngredient) {

    $quantite = $objectIngredient['quantite'];
    $unite = $objectIngredient['unite'];
    $ingredient = $objectIngredient['ingredient'];
    $ingredientInstance->insertIngredient($ingredient);
    $insertedIdsIngredient[] = $ingredientInstance->idIngredient;
}
