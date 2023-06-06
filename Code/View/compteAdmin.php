<?php
require_once '../Controller/authentification.php';
require_once("../Model/Recette.php");
require_once("../Model/Continent.php");
require_once("../Model/Recette.php");
require_once '../Model/Utilisateur.php';
$recette = new Recette();
$lisValidateRecipe = $recette->getAllValidateRecipes();
$recipesAValidate = count($recette->getAllRecipeStatutAValider());
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv=»Content-Type » content=»text/html; charset=utf-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/compteAdmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Les Voyageurs Gourmands</title>
</head>

<body>

    <header>
        <?php require_once 'Header.html' ?>
    </header>

    <div class="linkUtilisateur">
        <div><a href="../Controller/getUtilisateurs.php" class="btn btn-light .btn-lg">G&eacute;rer les utilisateurs</a>
        </div>
        <div> <a href="../Controller/logout.php" class="btn btn-light .btn-lg">Se d&eacute;connecter</a></div>
        <div> <a href="../Controller/gestionRecipes.php" class="btn btn-light .btn-lg">Gestion des
                recettes <span id="spanCountRecipes"><?= $recipesAValidate ?></span></a>
        </div>
    </div>
    <div class="titleTab">
        <div class="text-center">
            <h2>Liste des Recettes Validées</h2>
            <hr class="w-25 m-auto bg-dark">
        </div>
    </div>
    <div class="table-container">
        <table class="table">
            <thead class="table-bordered">
                <tr>
                    <th scope="col">Nom de la recette</th>
                    <th scope="col">Date</th>
                    <th scope="col">Continent</th>
                    <th scope="col">Emis par</th>
                    <th scope="col">supprimer la recette</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lisValidateRecipe as $vRecipe) {
                    $date = new DateTime($vRecipe['dateRecette']);
                    $dateRecipe = $date->format("d/m/Y");
                    $continent = new Continent();
                    $libContinent = $continent->getIngredientFromIdPays($vRecipe['idPays']);
                    $utilisateur = new Utilisateur();
                    $recipeUtilisateur = $utilisateur->getUtilisateur($vRecipe['idUtilisateur']);

                ?>
                <tr>
                    <td><a href="" <?= $vRecipe['idRecette'] ?>><?= $vRecipe['titre'] ?></a>
                    </td>
                    <td><?= $dateRecipe ?></td>
                    <td><?= $libContinent ?></td>
                    <td><?= $recipeUtilisateur->nom . ' ' . $recipeUtilisateur->prenom  ?></td>
                    <td <?php echo "deleteRecipe='" . $vRecipe['idRecette'] . "'" ?>><i class="fa fa-trash"></i>
                    </td>

                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <footer>
        <?php require_once 'footer.html' ?>
    </footer>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
<script src="../Js/compteAdminTableRecipe.js"></script>

</html>