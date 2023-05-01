<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="PageContinent.css">
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

    <form method="post" action="BoutonImpressionPdfController.php">
        <button type="submit">Générer un PDF</button>
    </form>

    <button onclick="location.href='BoutonImpressionPdfController.php'">Imprimer en PDF</button>


  </div>
    
    <div class="image-container">
        <?php
            $files = glob('Images/*.{jpg,jpeg,png,gif}', GLOB_BRACE); // Récupération des noms de fichiers d'images
            $count = count($files); // Comptage du nombre d'images

                echo '<div class="image-row">'; // Ouverture de la première ligne d'images

            for ($i = 0; $i < $count; $i++) {
                echo '<div class="image-cell">'; // Ouverture de la cellule d'image
                echo '<img src="' . $files[$i] . '" width="250px; height: 250px;">'; // Affichage de chaque image avec une largeur de 300 pixels
                echo '</div>'; // Fermeture de la cellule d'image

    // Si le numéro d'image est divisible par 3 (i.e. on a affiché 3 images), on ferme la ligne et on en ouvre une nouvelle
            if (($i + 1) % 3 == 0) {
                echo '</div><div class="image-row">';
            }
        }

                echo '</div>'; // Fermeture de la dernière ligne d'images
        ?>
    </div>

<!-- <div class="imageContainerForBdd>
<?php foreach ($images as $image): ?>
      <div class='images-block'>
        <img src='<?php echo $image['chemin_image']; ?>'>
      </div>
    <?php endforeach; ?>
</div> -->


</body>



<footer>

        <p>
        Le footer va apparaitre ici
        </p>

</footer>


</html>