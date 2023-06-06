<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/cssRecetteD.css">
    <title>Détail Recette</title>

</head>

<body>

    <?php
    require_once "Header.html";
    ?>

    <div class="position-relative">
        <img src="img/cake.jpg" id="img1">

        <h6 id="title1">Histoire / Anecdote :</h6>
        <p class="text-justify" id="blocktext1">dedisse scripsisse iudicaretur. Cras mattis iudicium purus sit amet
            fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter est quasdam res quas ex
            communi. At nos hinc posthac, sitientis piros Afros. Petierunt uti sibi concilium totius Galliae in diem
            certam indicere. Cras mattis iudicium purus sit amet fermentum.</p>
        <h5 id="bigtitle">Préparation</h5>
        <h6 id="title2">Etape 1 :</h6>
        <p class="text-justify" id="blocktext2">Ambitioni dedisse scripsisse iudicaretur. Cras mattis iudicium purus sit
            amet fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter est quasdam res quas ex
            communi. At nos hinc posthac, sitientis piros Afros. Petierunt uti sibi concilium totius Galliae in diem
            certam indicere. Cras mattis iudicium purus sit amet fermentum.</p>
        <h6 id="title3">Etape 2 :</h6>
        <p class="text-justify" id="blocktext3">Ambitioni dedisse scripsisse iudicaretur. Cras mattis iudicium purus sit
            amet fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter est quasdam res quas ex
            communi. At nos hinc posthac, sitientis piros Afros. Petierunt uti sibi concilium totius Galliae in diem
            certam indicere. Cras mattis iudicium purus sit amet fermentum.</p>
        <h6 id="title4">Etape 3 :</h6>
        <p class="text-justify" id="blocktext4">Ambitioni dedisse scripsisse iudicaretur. Cras mattis iudicium purus sit
            amet fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter est quasdam res quas ex
            communi. At nos hinc posthac, sitientis piros Afros. Petierunt uti sibi concilium totius Galliae in diem
            certam indicere. Cras mattis iudicium purus sit amet fermentum.</p>
        <h6 id="title5">Liste des ingrédients :</h6>
        <p class="text-justify" id="ListI"> - Farine : 250g <br> - Chocolat : 30g<br>- sucre : 20g<br>- oeuf : 6<br>-
            levure : 1 sachet<br> - patte d'amande : au
            choix<br>---------------------------<br>--------------------------<br></p>

        <img src="img/DL.png" id="img2">
        <a href="../Controller/pdfRecipe.php?idRecette=2" target="_blank" id="linkpdf">Téléchargez la recette !</a>

        <p id="text1" href="../Controller/login.php">Connectez-vous et donnez votre avis !</p>

    </div>
    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModel" id="shareBtn">
        <svg xmlns=" http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share"
            viewBox="0 0 16 16">
            <path
                d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z">
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
                            <span class="fa fa-facebook"></span>
                        </a>
                        <!-- <a href="#" class="fs-5 d-flex align-items-center justify-content-center">
                                <span class="fa fa-instagram"></span>
                            </a> -->
                        <a href="#" class="fs-5 d-flex align-items-center justify-content-center" id="shareEmail">
                            <span class="fa fa-envelope"></span>
                        </a>
                        <a href="#" class="fs-5 d-flex align-items-center justify-content-center" id="shareLink">
                            <span class="fa fa-link"></span>
                        </a>
                    </div>
                    <div class="address-form">
                        <label for="address">Adresse de destinataire:</label>
                        <div class="input-group">
                            <input type="email" id="address" name="address" class="form-control"
                                placeholder="Entrez votre adresse" required>
                            <div class="input-group-append">
                                <button type="submit" id="submitAddress" class="btn btn-primary">Envoyer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<footer>

    <?php
    require_once "footer.html";
    ?>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
<script src="../Js/partageRecipe.js"></script>

</html>