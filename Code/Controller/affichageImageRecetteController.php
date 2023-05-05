<?php
require_once "../model/Connection.php";
require_once "../model/Recette.php";

// ID de la recette à afficher
$idRecette = 4;

$imageRecette = new Recette();
$imageRecette->image = $imageRecette->getImageById($idRecette);

echo '<img src="http://projetcubes3/' . $imageRecette->image . '" width="300" height="200" />';
