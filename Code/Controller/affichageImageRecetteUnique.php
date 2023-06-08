<?php
require_once "../model/Connection.php";
require_once "../model/Recette.php";
require_once "../model/Continent.php";
require_once "../model/Pays.php";
require_once "../Model/Note.php";

// Créer une instance de Recette
$recette = new Recette();
$pays = new Pays();
$continent = new Continent();
$note = new Note();

// Vérifier si l'ID du continent est présent dans la requête
if (isset($_GET['idContinent'])) {
    // Récupérer l'ID du continent depuis la requête
    $idContinent = $_GET['idContinent'];

    $recettesValidees = $recette->getRecetteByContinent($idContinent);
}

// Calculer le nombre de recettes validées
$nombreRecettes = count($recettesValidees);

// Calculer le nombre de lignes nécessaires
$nombreLignes = ceil($nombreRecettes / 3);

// Diviser le tableau de recettes validées en sous-tableaux de 3 recettes par ligne
$lignesRecettesValidees = array_chunk($recettesValidees, 3);

// Afficher les lignes et les vignettes
foreach ($lignesRecettesValidees as $ligne) {
    echo '<div class="row">';

    foreach ($ligne as $recetteValidee) {
        $idRecette = $recetteValidee['idRecette'];
        $idPays = $recetteValidee['idPays'];
        $titreRecette = $recetteValidee['titre'];

        // Récupérer le nom du pays
        $nomPays = $pays->getLibPays($idPays);

        // Récupérer la note de la recette
        $averageNote = $note->getNoteRecette($idRecette);

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
    }

    echo '</div>';
}
