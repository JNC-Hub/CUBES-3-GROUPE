<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/PageContinent.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>PageContinent</title>
    <header>
        <?php
    include_once "../View/Header.html"
    ?>
    </header>
</head>

<body>

    <?php foreach ($lignesRecettesValidees as $ligne) : ?>
    <div class="row" id="pageContinent">
        <?php foreach ($ligne as $recetteValidee) :
        $idRecette = $recetteValidee['idRecette'];
        $idPays = $recetteValidee['idPays'];
        $titreRecette = $recetteValidee['titre'];
        // Récupérer le nom du pays
        $nomPays = $pays->getLibPays($idPays);
      ?>

        <div class="col-md-4">
            <a href="../Controller/detailRecette.php?idRecette=<?= $idRecette ?>" class="link-no-style">
                <?php
            $images = glob('../imageRecipe/' . $idRecette . '.*');
            $image = $images[0];
            ?>
                <div class="d-flex flex-column align-items-center">
                    <img src="<?= $image ?>" alt="<?= $titreRecette ?>" width="300" height="200" />
                    <div class="col-md-6">
                        <h4 class="custom-title "><?= ucfirst($titreRecette) ?></h4>
                        <p><?= $nomPays ?></p>
                        <div class="col-md-6">
                            <?php
                  // Récupérer la note de la recette
                  $averageNote = $note->getNoteRecette($idRecette);

                  // Afficher les étoiles en fonction de la note
                  if (isset($averageNote) && $averageNote != '') {
                    $roundedNote = round($averageNote, 2);
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
            </a>
        </div>

        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>

    <footer>
        <?php include_once "../View/footer.html" ?>
    </footer>
</body>

</html>