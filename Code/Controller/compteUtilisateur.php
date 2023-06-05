<?php
require_once '../Controller/authentification.php';
require_once '../Model/Utilisateur.php';

require_once("../Model/Recette.php");
require_once("../Model/Continent.php");
require_once("../Model/Pays.php");
require_once("../Model/StatutRecette.php");
$recette = new Recette();
if (isset($_SESSION['user'])) {
    $idUtilisateur = $_SESSION['user']['idUtilisateur'];
}
$listRecipesUser = $recette->getRecipesUser(intval($idUtilisateur));

require_once '../View/compteUtilisateur.php';
