<?php
require_once "../Model/Connection.php";
require_once "../Model/Note.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $donnees = json_decode(file_get_contents("php://input"));
    error_log((print_r($_POST, TRUE)));
    // Récupérez les données 
    $idRecette = $donnees->idRecette;
    $idUtilisateur = $donnees->idUtilisateur;
    $ratingValue = $donnees->ratingValue;

    // Vérifiez si l'utilisateur a déjà noté cette recette
    $noteModel = new Note();
    $noteModel->idUtilisateur = $idUtilisateur;
    $noteModel->idRecette = $idRecette;
    $noteModel->note = $ratingValue;
    // si l'utilisateur a déjà noté cette recette, o, met a jour la note sinon on insére 
    $userRatedRecipe = $noteModel->checkIfUserRatedRecipe($idRecette, $idUtilisateur);
    if ($userRatedRecipe >= 1) {
        $noteModel->updateRating();
    } else {
        $noteModel->insertNote();
    }
}
