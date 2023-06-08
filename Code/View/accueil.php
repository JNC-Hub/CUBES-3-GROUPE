<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv=»Content-Type » content=»text/html; charset=utf-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/accueil.css">
    <link rel="stylesheet" type="text/css" href="../css/affichageEtoile.css">
    <link rel="stylesheet" type="text/css" href="../css/etoileNote.css">
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

        <div class="lastRecipeAccueil">
            <?php include_once "../Controller/affichageImageRecetteUnique.php"; ?>
            <img src="../Controller/affichageImageRecetteUnique.php" alt="Image recette">
            <h1>Titre recette</h1>
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