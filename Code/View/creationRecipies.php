<?php
require_once('../Model/Continent.php');
require_once('../Model/Pays.php');
$listContient = Continent::getListContinent();
$pays = new Pays();
$listPays = $pays->getListPays();

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
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

        <form action="Controller/creationRecipies.php" method="POST" autocomplete="off">
            <div class="titleRecette my-4">
                <label for="titleRecette" class="form-label">Je choisis le titre de ma recette </label>
                <input type="text" name="titleRecette" id="titleRecette" class="form-control" placeholder="Saisissez un titre" required>
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
                <textarea class="form-control" id="histoire" rows="4" required maxlength="300" placeholder="Votre histoire/anecdote"></textarea>
                <span class="float-end label label-default" id="countLength"></span>
            </div>
            <!-- <div class="image my-4">
                <label for="image" class="form-label">Téléchargez une photo de votre recette</label>
                <div class="frame">
                    <div class="center">
                        <div class="dropzone">
                            <img src="http://100dayscss.com/codepen/upload.svg" class="upload-icon" />
                            <input type="file" class="upload-input" />
                        </div>

                    </div>
                </div>
            </div> -->
            <button class="btn btn-success">Envoyer votre recette</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="../Js/creationRecipe.js"></script>
</body>

</html>