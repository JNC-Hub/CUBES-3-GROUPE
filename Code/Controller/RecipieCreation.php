<?php
require_once 'authentification.php';
require_once '../Model/Utilisateur.php';
require_once('../Model/Continent.php');
require_once('../Model/Pays.php');
require_once('../Model/UniteMesure.php');
require_once('../Model/Ingredient.php');
$listContient = Continent::getListContinent();
$pays = new Pays();
$listPays = $pays->getListPays();
$listUnite = new UniteMesure();
$listUnites = $listUnite->getListUniteMesure();
$ingredients = new Ingredient();
$listIngredients = $ingredients->getListIngredients();

require_once("../View/creationRecipies.php");
