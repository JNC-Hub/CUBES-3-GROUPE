<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/cssRecetteD.css">
    <link rel="stylesheet" type="text/css" href="../css/affichageEtoile.css">
    <link rel="stylesheet" type="text/css" href="../css/etoileNote.css">
    <title>Détail Recette</title>

</head>

<body>

    <?php
    require_once "Header.html";
    ?>

    <div class="position-relative">

        <h1><?= htmlspecialchars($recette->titre) ?></h1>

        <img src="<?= $image ?>" id="img1">

        <?php
        $averageNote = $note->getNoteRecette($idRecette);
        // Afficher les étoiles en fonction de la note
        $starRating = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= round($averageNote)) {
                $starRating .= '<i class="fas fa-star"></i>'; // Étoile pleine
            } else {
                $starRating .= '<i class="far fa-star"></i>'; // Étoile vide
            }
        }
        ?>

        <p>Note : <span class="star-rating"><?php echo $starRating; ?></span></p>

        <p>Continent : <?= htmlspecialchars($recette->libContinent) ?> </p>
        <p>Pays : <?= htmlspecialchars($recette->libPays) ?></p>

        <h2 id="title1">Histoire / Anecdote sur la recette :</h2>
        <p class="text-justify" id="blocktext1"><?= htmlspecialchars($recette->histoire) ?></p>

        <h2 id="title5">Liste des ingrédients :</h2>
        <?php
        foreach ($ingredients as $ingredient) : ?>
            <p class="text-justify" id="ListI">
                <?= htmlspecialchars($ingredient->quantite) . ' ' . strtolower(htmlspecialchars($ingredient->libUniteMesure)) . ' ' . strtolower(htmlspecialchars($ingredient->libIngredient)) ?>
            </p>
        <?php endforeach; ?>

        <h2 id="bigtitle">Préparation</h2>

        <?php
        $numeroEtape = 0;
        foreach ($etapes as $etape) : ?>
            <h3 id="title2">Etape <?= $numeroEtape += 1 ?> :</h3>
            <p class="text-justify" id="blocktext2"> <?= htmlspecialchars($etape->libEtape) ?></p>
        <?php endforeach; ?>

        <a href="../Controller/pdfRecipe.php?idRecette=<?= $recette->idRecette ?>" target="_blank" class="btn btn-light" id="linkpdf">Téléchargez la recette !</a>
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
                                <input type="email" id="address" name="address" class="form-control" placeholder="Entrez votre adresse" required>
                                <div class="input-group-append">
                                    <button type="submit" id="submitAddress" class="btn btn-primary">Envoyer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="../Controller/login.php" class="btn btn-light">Connectez-vous et donnez votre avis !</a>

    </div>
</body>

<footer>

    <?php
    require_once "footer.html";
    ?>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
<script src="../Js/partageRecipe.js"></script>

</html>