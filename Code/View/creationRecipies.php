<?php
require_once '../Controller/authentification.php';
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
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/creationRecipie.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <title>Je partage ma recette</title>
</head>

<body>

    <div class="container w-50 mt-4">
        <div class="text d-flex justify-content-center flex-column">
            <div class="text-center">
                <h1>Je partage ma recette</h1>
                <hr class="w-25 m-auto bg-dark">
            </div>
            <div class="text-center align-self-center">
                <span class="titleSpan">Les recettes seront visibles sur le site après validation de l'équipe
                    <strong>voyageurs gourmands</strong>.</span>
            </div>
        </div>

        <form action="" method="POST" autocomplete="off" id="formCreation">
            <div class="titleRecette my-4">
                <label for="titleRecette" class="form-label">Je choisis le titre de ma recette </label>
                <input type="text" name="titleRecette" id="titleRecette" class="form-control"
                    placeholder="Saisissez un titre" required>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="contient" class="form-label">Mon continent</label>
                    <select name="contient" id="select_contient" class="form-control" required>
                        <option></option>
                        <?php
                        foreach ($listContient as $continent) {
                            echo '<option value="' . $continent['idContinent'] . '">' . $continent['libContinent'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="pays" class="form-label">Mon Pays</label>
                    <select name="pays" id="select_pays" class="form-control" disabled>
                        <option></option>
                        <?php
                        foreach ($listPays as $pays) {
                            echo '<option value="' . $pays['idPays'] . '" data-label="' . $pays['idContinent'] . '">' . $pays['libPays'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="histoire my-4">
                <label for="histoire" class="form-label">Partagez avec nous une petite histoire/anecdote de votre
                    recette </label>
                <textarea class="form-control" id="histoire" rows="4" required maxlength="300"
                    placeholder="Votre histoire/anecdote"></textarea>
                <span class="float-end label label-default" id="countLength"></span>
            </div>
            <div class="image my-4">
                <div class="col-auto">
                    <label for="image" class="form-label me-2">Téléchargez une photo de votre recette</label>
                    <span class="text-danger small"> (Attention la taille de la photo ne doit pas dépasser 1M) </span>
                </div>
                <div class="frame">
                    <div class="dropzone">
                        <label for="file-input">
                            <div class="frame">
                                <div class="dropzone">
                                    <label for="file-input">
                                        <img src="http://100dayscss.com/codepen/upload.svg" class="upload-icon"
                                            id="image-preview" />
                                        <input type="file" class="upload-input" id="file-input"
                                            accept="image/png, image/gif, image/jpeg" />
                                        <span id="file-name"></span>
                                    </label>
                                </div>
                            </div>
                    </div>
                    <div class="nombrePersonne my-4">

                        <label for="nombrePersonne" class="form-label">
                            Pour combien de personnes cette recette est-elle adaptée ?</label>
                        <input type="number" name="nombrePersonne" min="1" id="nombrePersonne" class="col-auto"
                            placeholder=" Nombre personnes" required>

                    </div>
                    <div class="my-4">
                        <label class="form-label">Choisir les ingrédients </label>
                        <div class=" shadow p-3 mb-5 bg-white rounded">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="input-wrapper">
                                        <input class="form-control" id="quantite" name="quantite" type="number"
                                            min="0.1" />
                                        <span>Quantité</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-wrapper">

                                        <select class="form-control" id="unite" name="unite">
                                            <option></option>
                                            <?php
                                            foreach ($listUnites as $unite) {
                                                echo '<option value="' . $unite['idUniteMesure'] . '">' . $unite['libUniteMesure'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <span>Unité de mesure </span>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <select class="form-control ingredients" name="ingredients" id='existIngredient'>
                                        <option></option>
                                        <?php
                                        foreach ($listIngredients as $ingredient) {
                                            echo '<option value="' . $ingredient['idIngredient'] . '">' . $ingredient['libIngredient'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="my-4">
                                <span>Si l'ingrédient n'existe pas dans la liste des ingrédients, cliquez sur <button
                                        type="button" class="btn  btn-rounded" id="ajoutNewIngredient">Nouvel
                                        ingrédient</button></span>
                            </div>
                            <div>
                                <button type="button" class="btn btn-rounded d-grid gap-2 col-4 mx-auto"
                                    id="buttonAdIngredient">Ajouter ingrédient</button>
                            </div>
                        </div>
                        <div>
                            <div class="table-responsive" style="margin-top:10px">
                                <table class="table" id="dynamic_field_ingredient"></table>
                            </div>
                        </div>
                        <div class="etape my-4">
                            <label for="etape" class="form-label">Préparation de la recette </label>
                            <div class=" shadow p-3 mb-5 bg-white rounded">
                                <textarea class="form-control" id="etape" name="etape" rows="4"
                                    placeholder="Ajouter une étape"></textarea>
                                <div>
                                    <button type="button" class="btn btn-rounded d-grid gap-2 col-4 mx-auto"
                                        id="buttonAdEtape">Ajouter une étape</button>
                                </div>
                            </div>
                        </div>
                        <div class="repeatEtape">
                            <div class="table-responsive" style="margin-top:10px">
                                <table class="table  table-striped" id="dynamic_field_etape"></table>
                            </div>
                        </div>

                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="button" class="btn btn-success" id="submit">Envoyer votre recette</button>
                    </div>
        </form>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="../Js/creationRecipe.js"></script>
</body>

</html>