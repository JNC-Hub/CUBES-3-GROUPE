<?php
require_once '../Model/Recette.php';
require_once '../Model/Etape.php';
require_once '../Model/Contenir.php';
require_once '../Model/Note.php';

if (isset($_GET['idRecette'])) {

    //$idRecette = 3;
    $idRecette = $_GET['idRecette'];

    $recette = new Recette();
    $recette = $recette->getRecipe($idRecette);

    //Image de la recette
    $imageFile = glob('../imageRecipe/' . $idRecette . '.*');
    $image = $imageFile[0];

    $contenirIngredients = new Contenir();
    $ingredients = $contenirIngredients->getIngredientsRecipe($idRecette);

    $etapes = new Etape();
    $etapes = $etapes->getEtapesRecipe($idRecette);

    $note = new Note();
    $averageNote = $note->getNoteRecette($idRecette);

    require_once '../View/DetailRecette.php';
}
