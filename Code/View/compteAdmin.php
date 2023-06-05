<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv=»Content-Type » content=»text/html; charset=utf-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/compteAdmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Les Voyageurs Gourmands</title>
</head>

<body>

    <header>
        <?php require_once 'Header.html' ?>
    </header>

    <div class="linkUtilisateur">

        <div>
            <a href="../Controller/getUtilisateurs.php" class="btn btn-light .btn-lg">G&eacute;rer les utilisateurs</a>
        </div>

        <div> <a href="../Controller/gestionRecipes.php" class="btn btn-light .btn-lg">Gérer les recettes <span id="spanCountRecipes"><?= $recipesAValidate ?></span></a>
        </div>

        <div> <a href="../Controller/logout.php" class="btn btn-light .btn-lg">Se d&eacute;connecter</a></div>

    </div>
    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModel" id="shareBtn">
        <svg xmlns=" http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
            <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z">
            </path>
        </svg>
        Partager
    </button>
    <div class="modal fade" id="myModel" aria-labelledby="myModelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModelLabel">Partager la recette</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center icons">
                        <a href="#" class="fs-5 d-flex align-items-center justify-content-center" id="shareFacebook">
                            <span class="fa fa-facebook"></span>
                        </a>
                        <!-- <a href="#" class="fs-5 d-flex align-items-center justify-content-center">
                                <span class="fa fa-instagram"></span>
                            </a> -->
                        <a href="#" class="fs-5 d-flex align-items-center justify-content-center" id="shareEmail">
                            <span class="fa fa-envelope"></span>
                        </a>
                        <a href="#" class="fs-5 d-flex align-items-center justify-content-center" id="shareLink">
                            <span class="fa fa-link"></span>
                        </a>
                    </div>
                    <div class="address-form">
                        <label for="address">Adresse de destinataire:</label>
                        <div class="input-group">
                            <input type="text" id="address" name="address" class="form-control" placeholder="Entrez votre adresse">
                            <div class="input-group-append">
                                <button type="submit" id="submitAddress" class="btn btn-primary">Envoyer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        <td><a href='#?&idbc=' <?= $vRecipe['idRecette'] ?>><?= $vRecipe['titre'] ?></a>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
<script src="../Js/compteAdminTableRecipe.js"></script>

</html>