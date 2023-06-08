<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv=»Content-Type » content=»text/html; charset=utf-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/compteUtilisateur.css">
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
        <div><a href="../Controller/gestionProfil.php" class="btn btn-light .btn-lg">Mes informations personnelles</a>
        </div>
        <div><a href="../Controller/RecipieCreation.php" class="btn btn-light .btn-lg">Publier une recette</a></div>
        <div><a href="../Controller/logout.php" class="btn btn-light .btn-lg">Se déconnecter</a></div>
    </div>

    <div class="titleTab">
        <div class="text-center">
            <h2>Liste de mes recettes publiées</h2>
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
                    <th scope="col">Pays</th>
                    <th scope="col">Statut de la recette</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listRecipesUser as $recipeUser) {
                    $date = new DateTime($recipeUser['dateRecette']);
                    $dateRecipe = $date->format("d/m/Y");
                    $continent = new Continent();
                    $libContinent = $continent->getIngredientFromIdPays($recipeUser['idPays']);
                    $pays = new Pays();
                    $libPays = $pays->getLibPays($recipeUser['idPays']);
                    $statutRecipe = new StatutRecette();
                    $statutResipeUser = $statutRecipe->getLibStautFromId($recipeUser['idStatut']);
                ?>
                <tr>
                    <td><a
                            href="../Controller/detailRecette.php?idRecette=<?= intval($recipeUser['idRecette']) ?>"><?= $recipeUser['titre'] ?></a>
                    </td>

                    <td><?= $dateRecipe ?></td>
                    <td><?= $libContinent ?></td>
                    <td><?= $libPays ?></td>
                    <td><?= $statutResipeUser ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<footer>
    <?php require_once 'footer.html' ?>
</footer>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>

</html>