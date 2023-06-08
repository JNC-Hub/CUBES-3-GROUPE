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

    echo '<div class="row">';
    echo '<div class="col-md-4">';
    echo '<a href="../Controller/detailRecette.php?idRecette=' . $idRecette . '">';
    echo '<img src="../imageRecipe/' . $idRecette . '" alt="' . $titreRecette . '" width="300" height="200" />';
    echo '<h4>' . $titreRecette . '</h4>';
    echo '<p> ' . $nomPays . '</p>';

    // Afficher les étoiles en fonction de la note
    $starRating = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= round($averageNote)) {
            $starRating .= '<i class="fas fa-star"></i>'; // Étoile pleine
        } else {
            $starRating .= '<i class="far fa-star"></i>'; // Étoile vide
        }
    }
    echo '<p>Note: <span class="star-rating">' . $starRating . '</span></p>';

    // echo '<p>Note: ' . $averageNote . '</p>';
    echo '</a>';
    echo '</div>';
    echo '</div>';
} else {
    echo 'Aucune recette publiée pour le moment.';
}
