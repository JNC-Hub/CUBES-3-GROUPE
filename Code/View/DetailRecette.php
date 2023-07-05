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
    <div class="container w-50 mt-4">
        <div class="text d-flex justify-content-center flex-column">
            <div class="text-center">
                <h1><?= ucfirst($recette->titre) ?></h1>
                <hr class="w-25 m-auto bg-dark">
            </div>
            <div class=" align-self-center">
                <div id="StarRating" class="d-flex justify-content-center">
                    <?php
                    if (isset($roundedNote) && $roundedNote != '') {
                        // Convertir le nombre en format décimal avec une seule décimale
                        $number = number_format($roundedNote, 1);

                        // Obtenir la partie entière du nombre
                        $intpart = floor($roundedNote);

                        // Obtenir la partie décimale
                        $fraction = $number - $intpart;

                        // Le classement est sur 5
                        // Déterminer combien d'étoiles doivent être vides
                        $unrated = 5 - ceil($number);

                        // Afficher les étoiles pleines
                        if ($intpart <= 5) {
                            for ($i = 0; $i < $intpart; $i++) {
                                echo '<span class="star filled"><i class="fas fa-star"></i></span>';
                            }
                        }

                        // Afficher l'étoile à moitié remplie, si nécessaire
                        if ($fraction == 0.5) {
                            echo '<span class="star half-filled "><i class="fas fa-star-half-alt"></i></span>';
                        }

                        // Afficher les étoiles vides, si nécessaire
                        if ($unrated > 0) {
                            for ($j = 0; $j < $unrated; $j++) {
                                echo '<span class="star empty empty-yellow"><i class="far fa-star"></i></span>';
                            }
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <img class="mx-auto d-block" src="<?= $image ?>" id="img1">
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col">
                    <h2 id="histoire">Histoire / Anecdote sur la recette :</h2>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="gray-box">
                                    <p><?= $recette->histoire ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="pays">
                            <h2 class="d-inline">Pays :</h2>
                            <span class="col-auto d-inline" id="lib">
                                <?= $recette->libPays ?>
                            </span>
                        </div>
                    </div>
                    <div id="continent" class="row mt-2">
                        <div class="col">
                            <h2 class="d-inline">Continent :</h2>
                            <span class="col-auto d-inline" id="lib">
                                <?= $recette->libContinent ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text d-flex justify-content-center flex-column">
        <div class="text-center">
            <h2>Liste des ingrédients de la recette: </h2>
            <hr class="w-25 m-auto bg-dark">
        </div>
        <div class=" align-self-center">
            <div class="justify-content-center">
                <?php
                foreach ($ingredients as $ingredient) : ?>
                    <p class="gray-box1">
                        <?= htmlspecialchars($ingredient->quantite) . ' ' . strtolower(htmlspecialchars($ingredient->libUniteMesure)) . ' ' . strtolower(htmlspecialchars($ingredient->libIngredient)) ?>
                    </p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="text d-flex justify-content-center flex-column">
        <div class="text-center">
            <h2>Préparation: </h2>
            <hr class="w-25 m-auto bg-dark">
        </div>
        <div class=" align-self-center">
            <div class="justify-content-center">
                <?php
                $numeroEtape = 0;
                foreach ($etapes as $etape) : ?>
                    <h3>Etape <?= $numeroEtape += 1 ?> :</h3>
                    <p class="gray-box"> <?= htmlspecialchars($etape->libEtape) ?></p>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
    <div class="justify-content-center text-center">
        <a href="../Controller/pdfRecipe.php?idRecette=<?= $recette->idRecette ?>" target="_blank" class="btn btn-light" id="linkpdf"> <i class="fas fa-download"></i> Téléchargez la recette !</a>
        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#myModel" id="shareBtn">
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
                <h4 class="rating-stars">

                    <span>Notez la recette : </span>
                    <span class="rating-star" data-rating="1">&#9733;</span>
                    <span class="rating-star" data-rating="2">&#9733;</span>
                    <span class="rating-star" data-rating="3">&#9733;</span>
                    <span class="rating-star" data-rating="4">&#9733;</span>
                    <span class="rating-star" data-rating="5">&#9733;</span>

                </h4>
            </div>
        <?php } else { ?>
            <a href="../Controller/login.php" class="btn btn-light"> <i class="fas fa-sign-in-alt"></i> Connectez-vous et
                donnez votre avis !</a>
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