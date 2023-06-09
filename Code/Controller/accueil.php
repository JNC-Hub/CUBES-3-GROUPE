<?php
require_once "../Model/Connection.php";
require_once "../Model/Recette.php";
require_once "../Model/Pays.php";
require_once "../Model/Note.php";

// Créer une instance de Recette
$recette = new Recette();
$pays = new Pays();
$note = new Note();

// Récupérer toutes les recettes triées par date de publication décroissante
$recettesValidees = $recette->getRecettesById();

// Obtenir la dernière recette publiée (la première du tableau)
$recetteValidee = reset($recettesValidees);

// Vérifier si une recette est disponible
if ($recetteValidee) {
    $idRecette = $recetteValidee['idRecette'];
    $idPays = $recetteValidee['idPays'];
    $titreRecette = $recetteValidee['titre'];

    // Récupérer le nom du pays
    $nomPays = $pays->getLibPays($idPays);

    // Récupérer la note de la recette
    $averageNote = $note->getNoteRecette($idRecette);

    $images = glob('../imageRecipe/' . $idRecette . '.*');
    $image = $images[0];
} else {
    echo 'Aucune recette publiée pour le moment.';
}

require_once '../View/accueil.php';
