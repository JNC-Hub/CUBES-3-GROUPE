<?php
require_once "../Model/Connection.php";
require_once "../Model/Recette.php";
require_once "../Model/Continent.php";
require_once "../Model/Pays.php";
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
        $roundedNote = round($averageNote, 2);
        $images = glob('../imageRecipe/' . $idRecette . '.*');
        $image = $images[0];

        echo '<div class="col-md-4">';
        echo '<a href="../Controller/detailRecette.php?idRecette=' . $idRecette . '">';
        echo '<img src="' . $image . '"  alt="' . $titreRecette . '" width="300" height="200" />';
        echo '<h4>' . $titreRecette . '</h4>';
        echo '<p> ' . $nomPays . '</p>';
        echo '</a>';
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
    }

    echo '</div>';
}
