<?php
require_once 'authentification.php';
require_once '../Model/Utilisateur.php';
require_once("../Model/Recette.php");
require_once("../Model/Continent.php");
require_once("../Model/Recette.php");
$recette = new Recette();
$lisValidateRecipe = $recette->getAllValidateRecipes();
$recipesAValidate = count($recette->getAllRecipeStatutAValider());

//Vérifie que l'utilisateur connecté est bien administrateur
if ($_SESSION['user_idRole'] == 1) {
    require_once '../View/compteAdmin.php';
} else {
    header('Location: ../index.php');
}
