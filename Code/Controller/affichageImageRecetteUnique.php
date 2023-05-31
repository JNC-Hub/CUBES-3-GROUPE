<?php
require_once "../model/Connection.php";
require_once "../model/Recette.php";

// ID de la recette à afficher
//$idRecette = 2;

// Vérifier si l'ID de la recette est présent dans la requête
if (isset($_GET['idRecette'])) {
    // Récupérer l'ID de la recette depuis la requête
    $idRecette = $_GET['idRecette'];

    // $imageFileName = glob('../imageRecipe/' . $idRecette . '.*'); //Récupère le nom de fichier complet avec son extension (extensions différentes)
    // $imagePath = '../imageRecipe/' . $imageFileName[0];

    if ($idRecette->image !== null) {
        // Afficher l'image
        echo '<img src="../imageRecipe/' . $idRecette->image . '" width="300" height="200" />';
    } else {
        echo "Aucune image trouvée pour cette recette";
    }
} else {
    echo "ID de recette manquant dans la requête";
}
