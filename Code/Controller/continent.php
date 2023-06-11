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
    // Calculer le nombre de recettes validées
    $nombreRecettes = count($recettesValidees);

    // Calculer le nombre de lignes nécessaires
    $nombreLignes = ceil($nombreRecettes / 3);

    // Diviser le tableau de recettes validées en sous-tableaux de 3 recettes par ligne
    $lignesRecettesValidees = array_chunk($recettesValidees, 3);

    require_once '../View/continent.php';
}
