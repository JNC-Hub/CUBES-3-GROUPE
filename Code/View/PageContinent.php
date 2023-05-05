<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../Style/PageContinent.css">
  <title>PageContinent</title>
</head>

<header>
  <p>
    Le header va apparaitre ici
  </p>
</header>

<body>
  <p> Ici vont apparaitre les images des recettes </p>

  <div class="boutonImpressionPdf">

    <input type="button" value="Imprimer2" onclick="window.print();">

  </div>

  <div>
    <?php
    include_once "../Controller/impressionPdf.php";
    ?>

  </div>

  <div class="image-container">
    <?php
    $files = glob('../Ressources/imagesRecettes/*.{jpg,jpeg,png,gif}', GLOB_BRACE); // Récupération des noms de fichiers d'images
    $count = count($files); // Comptage du nombre d'images

    echo '<div class="image-row">'; // Ouverture de la première ligne d'images

    for ($i = 0; $i < $count; $i++) {
      echo '<div class="image-cell">'; // Ouverture de la cellule d'image
      echo '<img src="' . $files[$i] . '">'; // Affichage de chaque image avec une largeur de 300 pixels
      echo '</div>'; // Fermeture de la cellule d'image

      // Si le numéro d'image est divisible par 3 (i.e. on a affiché 3 images), on ferme la ligne et on en ouvre une nouvelle
      if (($i + 1) % 4 == 0) {
        echo '</div><div class="image-row">';
      }
    }

    echo '</div>'; // Fermeture de la dernière ligne d'images
    ?>
  </div>

  <div>
    toto
    <img src="<?= $imageRecette->image ?>" alt="">
    tutu
  </div>
  <!-- Option 2 -->
  <div>
    <img src="<?php echo $imageRecette->image ?>" alt="">
  </div>

  <div>

    <img src="<?= $imageRecette->image; ?>" alt="buggggg">

  </div>

  <div>
    <img src="<?php $imageRecette->image; ?>" alt="" title="<?php $img_name; ?>" width="300" height="200" class="img-responsive" />
    <p><strong><?php $img_name; ?></strong></p>
  </div>

  <div class="image-container">
    <?php if ($params['image'] !== null) : ?>
      <div class="image-cell">
        <img src="<?= $imageRecette->image ?>" alt="">
      </div>
    <?php else : ?>
      <p>Aucune image trouvée pour cette recette</p>
    <?php endif; ?>
  </div>

  <?php
  include_once "../Controller/affichageImageRecetteController.php";
  ?>
  <!-- Boucle à travers les résultats de la requête pour afficher chaque image -->
  <div class="image-container">
    <?php

    foreach ($images as $image) : ?>
      <div class="image-cell">
        <img src="<?= $imageRecette->image ?>" alt="">
      </div>
    <?php endforeach; ?>

  </div>

</body>

<footer>

  <p>
    Le footer va apparaitre ici
  </p>

</footer>

</html>