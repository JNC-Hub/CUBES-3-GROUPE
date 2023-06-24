<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv=»Content-Type » content=»text/html; charset=utf-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/accueil.css">
    <link rel="stylesheet" type="text/css" href="../css/PageContinent.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Les Voyageurs Gourmands</title>
</head>

<body>

    <header>
        <?php require_once 'Header.html' ?>
    </header>

    <div class="contentAccueil">

        <div class="presentation">
            <p>Bienvenue sur le site des <b>Voyageurs Gourmands</b>, votre guide de r&eacute;f&eacute;rence pour
                explorer le monde des desserts et des p&acirc;tisseries !</p>
            <p>Passionn&eacute;s par la d&eacute;couverte de nouvelles saveurs, recettes et cultures culinaires, notre
                site propose &agrave; tous les gourmands de partager
                les meilleurs desserts et p&acirc;tisseries du monde entier, de l'Am&eacute;rique du Sud &agrave;
                l'Asie, en passant par l'Europe et l'Afrique.</p>
            <p>Notre communaut&eacute; de Voyageurs Gourmands partage ses recettes, ainsi qu'une histoire ou anecdote
                sur ces recettes, afin de satisfaire votre palais sucr&eacute; et
                votre curiosit&eacute;.</p>
            <p>Rejoignez-nous pour un voyage gourmand inoubliable !</p>
        </div>

        <!-- <div class="lastRecipeAccueil">
            <?php include_once "../Controller/affichageImageRecetteUnique.php"; ?>
            <img src="../Controller/affichageImageRecetteUnique.php" alt="Image recette">
            <h1>Titre recette</h1>
        </div>
    </div> -->

        <div class="lastRecipeAccueil">
            <div class="row">
                <div class="col-md-4">
                    <a href="../Controller/detailRecette.php?idRecette=<?= $idRecette  ?>">
                        <?php
                        $images = glob('../imageRecipe/' . $idRecette . '.*');
                        $image = $images[0];
                        ?>
                        <div class="d-flex flex-column align-items-center">
                            <img src="<?= $image ?>" alt="<?= $titreRecette ?>" width="300" height="200" />
                            <h4><?= $titreRecette ?></h4>
                            <p><?= $nomPays ?></p>
                            <div class="d-flex justify-content-center">
                                <?php
                                $averageNote = $note->getNoteRecette($idRecette);
                                $roundedNote = round($averageNote, 2);
                                // Afficher les étoiles en fonction de la note

                                if (isset($roundedNote) && $roundedNote != '') {

                                    $intpart = floor($roundedNote);

                                    // Obtenir la partie décimale
                                    $fraction = $roundedNote - $intpart;

                                    // Le classement est sur 5
                                    // Déterminer combien d'étoiles doivent être vides
                                    $unrated = 5 - ceil($roundedNote);

                                    // Afficher les étoiles pleines
                                    for ($i = 0; $i < $intpart; $i++) {
                                        echo '<span class="star filled"><i class="fas fa-star"></i></span>';
                                    }

                                    // Afficher l'étoile à moitié remplie, si nécessaire
                                    if ($fraction > 0) {
                                        echo '<span class="star half-filled"><i class="fas fa-star-half-alt"></i></span>';
                                    }

                                    // Afficher les étoiles vides, si nécessaire
                                    for ($j = 0; $j < $unrated; $j++) {
                                        echo '<span class="star empty empty-yellow"><i class="far fa-star"></i></span>';
                                    }
                                }
                                ?>

                            </div>
                        </div>
                </div>
            </div>
            </a>
        </div>
    </div>

    <div class="linkAccueil">
        <a href="../Controller/RecipieCreation.php" class="btn btn-light .btn-lg">Toi aussi, partage ta recette !</a>
    </div>

    <footer>
        <?php require_once 'footer.html' ?>
    </footer>

</body>

</html>