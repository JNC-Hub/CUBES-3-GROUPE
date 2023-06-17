<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/cssRecetteD.css">
    <title>Détail Recette</title>

</head>

<body>

    <?php
    require_once "Header.html";
    ?>

    <div class="position-relative">
        <h1 id="RecetteTitle"><?= htmlspecialchars($recette->titre) ?></h1>
        <img src="<?= $image ?>" id="img1">
        <div id="StarRating" class="d-flex justify-content-center">
            <?php
            if (isset($roundedNote) && $roundedNote != '') {
                for ($i = 1; $i <= 5; $i++) {
                    $starClass = ($i <= $roundedNote) ? 'filled' : 'empty';

                    if ($i < $roundedNote + 1 && $i + 0.5 > $roundedNote) {
                        echo '<span class="star half-filled ' . $starClass . '"><i class="fas fa-star-half-alt"></i></span>';
                    } else {
                        echo '<span class="star ' . $starClass . '"><i class="fas fa-star"></i></span>';
                    }
                }
            }

            ?>
        </div>

        <p id="Continent">Continent : <?= htmlspecialchars($recette->libContinent) ?> </p>
        <p id="Pays">Pays : <?= htmlspecialchars($recette->libPays) ?></p>

        <h2 id="title1">Histoire / Anecdote sur la recette :</h2>
        <p class="text-justify" id="blocktext1"><?= htmlspecialchars($recette->histoire) ?></p>

        <h2 id="title5">Liste des ingrédients :</h2>
        <?php
        foreach ($ingredients as $ingredient) : ?>
            <p class="text-justify" id="ListI">
                <?= htmlspecialchars($ingredient->quantite) . ' ' . strtolower(htmlspecialchars($ingredient->libUniteMesure)) . ' ' . strtolower(htmlspecialchars($ingredient->libIngredient)) ?>
            </p>
        <?php endforeach; ?>

        <h2 id="titleh2">Préparation</h2>

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
                                <img src="../Images/logoFacebook.png" id="facebook">
                            </a>
                            <a href=" #" class="fs-5 d-flex align-items-center justify-content-center" id="shareEmail">
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

        <?php
        if (isset($_SESSION['user'])) {
        ?>
            <input type="hidden" name="idRecette" value="<?= $recette->idRecette ?>">
            <input type="hidden" name="idUtilisateur" value="<?= $_SESSION['user']['idUtilisateur'] ?>">
            <div class="row">
                <h4 class="rating-stars text-center mt-2 mb-4">

                    <span>Notez la recette : </span>
                    <span class="rating-star" data-rating="1">&#9733;</span>
                    <span class="rating-star" data-rating="2">&#9733;</span>
                    <span class="rating-star" data-rating="3">&#9733;</span>
                    <span class="rating-star" data-rating="4">&#9733;</span>
                    <span class="rating-star" data-rating="5">&#9733;</span>

                </h4>
            </div>
        <?php } else { ?>
            <a href="../Controller/login.php" class="btn btn-light">Connectez-vous et donnez votre avis !</a>
        <?php } ?>
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