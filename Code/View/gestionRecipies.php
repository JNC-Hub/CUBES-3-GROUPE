<?php
require_once '../Controller/authentification.php';
require_once("../Model/Recette.php");
require_once("../Model/Continent.php");
require_once '../Model/Utilisateur.php';
$recette = new Recette();
$listRecipesAvalider = $recette->getAllRecipeStatutAValider();
?>
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv=»Content-Type » content=»text/html; charset=utf-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/gestionRecipes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Les Voyageurs Gourmands</title>
</head>

<body>

    <header>
        <?php require_once 'Header.html' ?>
    </header>

    <div>
        <div><a href="../Controller/compteAdmin.php"><img src="../Images/back-arrow.png" alt="Go back" class="imgLogin"></a></div>
    </div>

    <div class="titleTab">
        <div class="text-center">
            <h2>Liste des recettes non validées</h2>
            <hr class="w-25 m-auto bg-dark">
        </div>
    </div>

    <div class="table-container">
        <table class="table table-hover">
            <thead class="table-bordered">
                <tr>
                    <th scope="col">Nom de la recette</th>
                    <th scope="col">Date</th>
                    <th scope="col">Continent</th>
                    <th scope="col">Emis par</th>
                    <th scope="col">Valider la recette</th>
                    <th scope="col">Refuser la recette</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listRecipesAvalider as $recipeAV) {
                    $date = new DateTime($recipeAV['dateRecette']);
                    $dateRecipe = $date->format("d/m/Y");
                    $continent = new Continent();
                    $libContinent = $continent->getIngredientFromIdPays($recipeAV['idPays']);
                    $utilisateur = new Utilisateur();
                    $recipeUtilisateur = $utilisateur->getUtilisateur($recipeAV['idUtilisateur']);

                ?>
                    <tr>
                        <td><a href='#?&idbc=' <?= $recipeAV['idRecette'] ?>><?= $recipeAV['titre'] ?></a>
                        </td>
                        <td><?= $dateRecipe ?></td>
                        <td><?= $libContinent ?></td>
                        <td><?= $recipeUtilisateur->nom . ' ' . $recipeUtilisateur->prenom  ?></td>
                        <td <?php echo "validateRecipe='" . $recipeAV['idRecette'] . "'" ?>><button type="button" class="btn" id="validateRecipeButton">Valider</button></td>
                        <td <?php echo "rejectRecipe='" . $recipeAV['idRecette'] . "'" ?>><button type="button" class="btn" id="RejectRecipeButton">Refuser</button></td>

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <header>
        <?php require_once 'Footer.html' ?>
    </header>

</body>

<script src="../Js/gestionRecipes.js"></script>

</html>