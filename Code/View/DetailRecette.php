<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/cssRecetteD.css">
    <title>Détail Recette</title>

</head>

<body>

    <?php
    require_once "Header.html";
    ?>

    <div class="position-relative">

        <h1><?= htmlspecialchars($recette->titre) ?></h1>

        <img src="<?= $image ?>" id="img1">

        <p>Continent : <?= htmlspecialchars($recette->libContinent) ?></p>
        <p>Pays : <?= htmlspecialchars($recette->libPays) ?></p>

        <h2 id="title1">Histoire / Anecdote sur la recette :</h2>
        <p class="text-justify" id="blocktext1"><?= htmlspecialchars($recette->histoire) ?></p>

        <h2 id="bigtitle">Préparation</h2>

        <?php
        $numeroEtape = 0;
        foreach ($etapes as $etape) : ?>
            <h3 id="title2">Etape <?= $numeroEtape += 1 ?> :</h3>
            <p class="text-justify" id="blocktext2"> <?= htmlspecialchars($etape->libEtape) ?></p>
        <?php endforeach; ?>

        <h2 id="title5">Liste des ingrédients :</h2>
        <?php
        foreach ($ingredients as $ingredient) : ?>
            <p class="text-justify" id="ListI"> <?= htmlspecialchars($ingredient->libIngredient) ?></p>
        <?php endforeach; ?>

        <a href="../Controller/pdfRecipe.php?idRecette=<?= $recette->idRecette ?>" target="_blank" class="btn btn-light">Téléchargez la recette !</a>
        <a href="../Controller/login.php" class="btn btn-light">Connectez-vous et donnez votre avis !</a>

    </div>
</body>

<footer>

    <?php
    require_once "footer.html";
    ?>

</footer>

</html>