<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/PageContinent.css">
  <link rel="stylesheet" type="text/css" href="../css/affichageEtoile.css">
  <link rel="stylesheet" type="text/css" href="../css/etoileNote.css">
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
    <div class="row">

      <?php foreach ($ligne as $recetteValidee) :
        $idRecette = $recetteValidee['idRecette'];
        $idPays = $recetteValidee['idPays'];
        $titreRecette = $recetteValidee['titre'];
        // Récupérer le nom du pays
        $nomPays = $pays->getLibPays($idPays);

        // Récupérer la note de la recette
        $averageNote = $note->getNoteRecette($idRecette);
      ?>

        <div class="col-md-4">
          <a href="../Controller/detailRecette.php?idRecette=<?= $idRecette  ?>">
            <img src="../imageRecipe/<?= $idRecette ?> " alt="<?= $titreRecette ?>" width="300" height="200" />
            <h4><?= $titreRecette ?></h4>
            <p><?= $nomPays ?></p>

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