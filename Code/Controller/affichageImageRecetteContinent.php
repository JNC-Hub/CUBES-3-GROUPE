<?php
require_once "../model/Connection.php";
require_once "../model/Recette.php";
require_once "../model/Continent.php";
require_once "../model/Pays.php";

// // Créer une instance de Recette
// $recette = new Recette();

// // Vérifier si l'ID du continent est présent dans la requête
// if (isset($_GET['idContinent'])) {
//     // Récupérer l'ID du continent depuis la requête
//     $idContinent = $_GET['idContinent'];

//     // Récupérer les recettes validées pour le continent spécifié
//     $recettesValidees = $recette->getAllvalidateRecipeByContinent($idContinent);
// } else {
//     // Récupérer toutes les recettes validées
//     $recettesValidees = $recette->getAllvalidateRecipe();
// }

// // Calculer le nombre de recettes validées
// $nombreRecettes = count($recettesValidees);

// // Calculer le nombre de lignes nécessaires
// $nombreLignes = ceil($nombreRecettes / 3);

// // Diviser le tableau de recettes validées en sous-tableaux de 3 recettes par ligne
// $lignesRecettesValidees = array_chunk($recettesValidees, 3);

// // Afficher les lignes et les vignettes
// foreach ($lignesRecettesValidees as $ligne) {
//     echo '<div class="row">';

//     foreach ($ligne as $recetteValidee) {
//         $idRecette = $recetteValidee['idRecette'];
//         //$imageRecette = $recetteValidee['image'];
//         $titreRecette = $recetteValidee['titre'];

//         echo '<div class="col-md-4">';
//         echo '<a href="../Controller/detailRecette.php?idRecette=' . $idRecette . '">';
//         echo '<img src="../imageRecipe/' . $idRecette . '" alt="' . $titreRecette . '" width="300" height="200" />';
//         echo '<h4>' . $titreRecette . '</h4>';
//         echo '</a>';
//         echo '</div>';
//     }

//     echo '</div>';
// }

// Créer une instance de Recette
$recette = new Recette();
$pays = new Pays();
$continent = new Continent();

// Vérifier si l'ID du continent est présent dans la requête
if (isset($_GET['idContinent'])) {
    // Récupérer l'ID du continent depuis la requête
    $idContinent = $_GET['idContinent'];

    $recettesValidees = $recette->getRecetteByContinent($idContinent);

    //     // Récupérer les recettes validées pour les pays du continent spécifié
    //     $recettesValidees = $recette->getAllvalidateRecipeByContinent($paysDuContinent);
    // } else {
    //     // Récupérer toutes les recettes validées
    //     $recettesValidees = $recette->getAllvalidateRecipe();
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

        echo '<div class="col-md-4">';
        echo '<a href="../Controller/detailRecette.php?idRecette=' . $idRecette . '">';
        echo '<img src="../imageRecipe/' . $idRecette . '" alt="' . $titreRecette . '" width="300" height="200" />';
        echo '<h4>' . $titreRecette . '</h4>';
        echo '<p>Pays: ' . $nomPays . '</p>';
        echo '</a>';
        echo '</div>';
    }

    echo '</div>';
}
