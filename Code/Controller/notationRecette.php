<?php
require_once "../model/Connection.php";
require_once "../model/Note.php";

// Vérifiez si la requête est une requête AJAX
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Vérifiez si l'action spécifique est définie (par exemple, enregistrer la note)
    if (isset($_POST['action']) && $_POST['action'] === 'enregistrer_note') {
        // Récupérez les données de la requête AJAX
        $recipeId = $_POST['idRecette'];
        $userId = $_POST['idUtilisateur'];
        $rating = $_POST['note'];

        // Créez une instance de la classe Note pour gérer l'enregistrement de la note
        $note = new Note();
        $note->idRecette = $idRecette;
        $note->idUtilisateur = $idUtilisateur;
        $note->note = $note;

        // Enregistrez la note en base de données
        $note->insertNote();

        // Répondez avec un message de succès
        echo json_encode(['success' => true, 'message' => 'Note enregistrée avec succès.']);
        exit;
    }
}
