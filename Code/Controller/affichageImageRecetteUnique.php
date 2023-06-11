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
    $roundedNote = round($averageNote, 2);
    $images = glob('../imageRecipe/' . $idRecette . '.*');
    $image = $images[0];
    echo '<div class="row">';
    echo '<div class="col-md-4">';
    echo '<a href="../Controller/detailRecette.php?idRecette=' . $idRecette . '">';
    echo '<img src="' . $image . '" alt="' . $titreRecette . '" width="300" height="200" />';
    echo '<h4>' . $titreRecette . '</h4>';
    echo '<p> ' . $nomPays . '</p>';
    echo '</a>';
    echo '<div class="d-flex justify-content-center">';
    // Afficher les étoiles en fonction de la note
    for ($i = 1; $i <= 5; $i++) {
        $starClass = ($i <= $roundedNote) ? 'filled' : 'empty';

        if ($i < $roundedNote + 1 && $i + 0.5 > $roundedNote) {
            echo '<span class="star half-filled ' . $starClass . '"><i class="fas fa-star-half-alt"></i></span>';
        } else {
            echo '<span class="star ' . $starClass . '"><i class="fas fa-star"></i></span>';
        }
    }
    echo '</div>';

    echo '</div>';
    echo '</div>';
} else {
    echo 'Aucune recette publiée pour le moment.';
}
