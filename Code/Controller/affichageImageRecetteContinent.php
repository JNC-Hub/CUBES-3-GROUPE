<?php
require_once "../model/Connection.php";
require_once "../model/Recette.php";

// Créer une instance de Recette
$recette = new Recette();

// Récupérer toutes les recettes validées
$recettesValidees = $recette->getAllvalidateRecipe();
//var_dump($recettesValidees);

// Calculer le nombre de recettes validées
$nombreRecettes = count($recettesValidees);

// Calculer le nombre de lignes nécessaires
$nombreLignes = ceil($nombreRecettes / 3);

// Diviser le tableau de recettes validées en sous-tableaux de 3 recettes par ligne
$lignesRecettesValidees = array_chunk($recettesValidees, 3);
//echo "Boucle foreach";
// Afficher les lignes et les vignettes
foreach ($lignesRecettesValidees as $ligne) {
    echo '<div class="row">';
    //echo "Boucle foreach";

    foreach ($ligne as $recetteValidee) {
        $idRecette = $recetteValidee['idRecette'];
        $imageRecette = $recetteValidee['image'];
        $titreRecette = $recetteValidee['titre'];

        echo '<div class="col-md-4">';
        echo '<a href="detail_recette.php?idRecette=' . $idRecette . '">';
        echo '<img src="../imageRecipe/' . $imageRecette . '" alt="' . $titreRecette . '" width="300" height="200" />';
        echo '<h4>' . $titreRecette . '</h4>';
        echo '</a>';
        echo '</div>';

        // // Ajoutez le code ici pour afficher les données des recettes
        // echo "Image : " . $imageRecette . "<br>";
        // echo "Titre : " . $titreRecette . "<br>";
        // var_dump($idRecette);
        // var_dump($imageRecette);
        // var_dump($titreRecette);
    }

    echo '</div>';
}
