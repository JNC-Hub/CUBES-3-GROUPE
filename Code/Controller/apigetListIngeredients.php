<?php

// Header ouvre l'api à tous les sources pour y acceder (*)
header("Access-Control-Allow-Origin: *");
// contenu de reponse json
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
// la durée de vie de la requete
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // On inclut les fichiers de configuration et d'accès aux données
    require_once "../Model/Connection.php";
    require_once "../Model/Ingredient.php";

    // On instancie les produits
    $ingredient = new Ingredient();

    // On récupère les informations envoyées
    try {

        echo json_encode($ingredient->getListIngredients());
    } catch (Exception $e) {
        // On envoie un code 503
        http_response_code(503);
    }

    // On encode en json et on envoie

} else {
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
