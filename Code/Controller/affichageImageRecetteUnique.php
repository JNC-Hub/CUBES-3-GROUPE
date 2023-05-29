<?php
require_once "../model/Connection.php";
require_once "../model/Recette.php";

// ID de la recette à afficher
//$idRecette = 2;

// Vérifier si l'ID de la recette est présent dans la requête
if (isset($_GET['idRecette'])) {
    // Récupérer l'ID de la recette depuis la requête
    $idRecette = $_GET['idRecette'];

    $imageRecette = new Recette();
    $imageRecette->image = $imageRecette->getImageById($idRecette);

    if ($imageRecette->image !== null) {
        // Afficher l'image
        echo '<img src="../imageRecipe/' . $imageRecette->image . '" width="300" height="200" />';
    } else {
        echo "Aucune image trouvée pour cette recette";
    }
} else {
    echo "ID de recette manquant dans la requête";
}
