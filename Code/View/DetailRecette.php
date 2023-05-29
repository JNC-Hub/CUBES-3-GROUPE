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
    require_once "./Header.html";
    ?>

    <div class="position-relative">
        <?php
        include_once "../Controller/affichageImageRecetteUnique.php";
        ?>

        <h6 id="title1">Histoire / Anecdote :</h6>
        <p class="text-justify" id="blocktext1">dedisse scripsisse iudicaretur. Cras mattis iudicium purus sit amet fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter est quasdam res quas ex communi. At nos hinc posthac, sitientis piros Afros. Petierunt uti sibi concilium totius Galliae in diem certam indicere. Cras mattis iudicium purus sit amet fermentum.</p>
        <h5 id="bigtitle">Préparation</h5>
        <h6 id="title2">Etape 1 :</h6>
        <p class="text-justify" id="blocktext2">Ambitioni dedisse scripsisse iudicaretur. Cras mattis iudicium purus sit amet fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter est quasdam res quas ex communi. At nos hinc posthac, sitientis piros Afros. Petierunt uti sibi concilium totius Galliae in diem certam indicere. Cras mattis iudicium purus sit amet fermentum.</p>
        <h6 id="title3">Etape 2 :</h6>
        <p class="text-justify" id="blocktext3">Ambitioni dedisse scripsisse iudicaretur. Cras mattis iudicium purus sit amet fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter est quasdam res quas ex communi. At nos hinc posthac, sitientis piros Afros. Petierunt uti sibi concilium totius Galliae in diem certam indicere. Cras mattis iudicium purus sit amet fermentum.</p>
        <h6 id="title4">Etape 3 :</h6>
        <p class="text-justify" id="blocktext4">Ambitioni dedisse scripsisse iudicaretur. Cras mattis iudicium purus sit amet fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter est quasdam res quas ex communi. At nos hinc posthac, sitientis piros Afros. Petierunt uti sibi concilium totius Galliae in diem certam indicere. Cras mattis iudicium purus sit amet fermentum.</p>
        <h6 id="title5">Liste des ingrédients :</h6>
        <p class="text-justify" id="ListI"> - Farine : 250g <br> - Chocolat : 30g<br>- sucre : 20g<br>- oeuf : 6<br>- levure : 1 sachet<br> - patte d'amande : au choix<br>---------------------------<br>--------------------------<br></p>

        <img src="img/DL.png" id="img2">
        <a href="../Controller/pdfRecipe.php?idRecette=2" target="_blank">Téléchargez la recette !</a>
        <!-- <a href="../Controller/pdfRecipe.php?idRecette=<?= $recette->idRecette ?>" target="_blank">Téléchargez la recette !</a> -->
        <p id="text1" href="../Controller/login.php">Connectez-vous et donnez votre avis !</p>

    </div>

</body>

<footer>

    <?php
    require_once "./Footer.html";
    ?>

</footer>

</html>