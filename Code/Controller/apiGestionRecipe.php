<?php
header("Access-Control-Allow-Origin: *");
// contenu de reponse json
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
// la durée de vie de la requete
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $donnees = json_decode(file_get_contents("php://input"));
    require_once("../Model/Recette.php");
    require_once("../Model/Contenir.php");
    require_once("../Model/Etape.php");
    require_once("../Model/Note.php");
    $recette = new Recette();
    $contenir = new Contenir();
    $etape = new Etape();
    $note = new Note();
    if ($donnees->mode == 'validate') {
        $recette->validateRecipe(intval($donnees->idRecette));
    }
    if ($donnees->mode == 'reject') {
        $recette->rejectRecipe(intval($donnees->idRecette));
    }
    if ($donnees->mode == 'delete') {
        $etape->deleteRecipe(intval($donnees->idRecette));
        $contenir->deleteRelation(intval($donnees->idRecette));
        $rating = $note->getNoteRecette($donnees->idRecette);
        if ($rating != null) {
            $note->deleteNote($donnees->idRecette);
        }
        $recette->deleteRecipe(intval($donnees->idRecette));
    }
}
