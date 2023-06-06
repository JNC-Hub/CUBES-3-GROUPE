<?php
require_once "../model/Connection.php";
require_once "../model/Note.php";

class NoteController
{
    public function index()
    {
        // Votre logique de contrôleur ici

        // Vérifiez si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérez les données du formulaire
            $idRecette = $_POST['idRecette'];
            $idUtilisateur = $_POST['idUtilisateur'];
            $note = $_POST['note'];

            // Vérifiez si l'utilisateur a déjà noté cette recette
            $noteModel = new Note();
            $userRated = $noteModel->checkIfUserRatedRecipe($idRecette, $idUtilisateur);

            if ($userRated) {
                // L'utilisateur a déjà noté cette recette, mettez à jour la note
                $noteModel->updateRating($idRecette, $idUtilisateur, $note);
            } else {
                // L'utilisateur n'a pas encore noté cette recette, insérez une nouvelle note
                $noteModel->idRecette = $idRecette;
                $noteModel->idUtilisateur = $idUtilisateur;
                $noteModel->note = $note;
                $noteModel->insertNote();
            }

            // Redirigez l'utilisateur vers la page de la recette ou affichez un message de confirmation, etc.
            header('<a href="../Controller/detailRecette.php?idRecette=' . $idRecette . '">');
            exit();
        }

        // Si le formulaire n'a pas été soumis, récupérez les valeurs dynamiquement
        $idRecette = isset($_GET['idRecette']) ? $_GET['idRecette'] : '';
        $idUtilisateur = isset($_GET['idUtilisateur']) ? $_GET['idUtilisateur'] : '';

        // Chargez la vue du formulaire de notation
        include '../View/attributionNoteEtoile.php';
    }
}
