<?php
require_once '../Controller/authentification.php';
require_once("../Model/Recette.php");
require_once("../Model/Continent.php");
require_once '../Model/Utilisateur.php';
$recette = new Recette();
$listRecipesAvalider = $recette->getAllRecipeStatutAValider();

require_once '../View/gestionRecipies.php';
