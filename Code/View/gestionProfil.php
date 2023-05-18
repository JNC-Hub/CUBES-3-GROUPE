<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv=»Content-Type » content=»text/html; charset=utf-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Les Voyageurs Gourmands</title>
</head>

<body>

    <header>
        <?php require_once 'Header.html' ?>
    </header>

    <div>
        <a href="../Controller/compteUtilisateur.php"><img src="../Images/back-arrow.png" alt="Go back" class="imgLogin"> </a>
    </div>

    <h1 class="titleGestionProfil">Modifier mes informations</h1>

    <div>

        <form action="../Controller/gestionProfil.php" method="post">

            <div class="loginFormBox">
                <div class="form-content">
                    <label for="nom">Nom *</label>
                    <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($utilisateur->nom) ?>">
                </div>

                <div class="form-content">
                    <label for="prenom">Pr&eacute;nom *</label>
                    <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($utilisateur->prenom) ?>">
                </div>

                <div class="form-content">
                    <label for="email">Mail *</label>
                    <input type="email" name="mail" id="email" value="<?= htmlspecialchars($utilisateur->mail) ?>">
                </div>

                <div class="form-content">
                    <label for="password">Mot de passe *</label>
                    <input type="password" name="password" id="password" value="">
                    <i class="fa fa-eye" onclick="fafaEye()"></i>
                </div>
                <!-- <span class=infoPassword>Mot de passe de 8 caract&egrave;res minimum, dont une lettre minuscule, une lettre majuscule, un chiffre et
                            un caractère spécial différent de & < " ></span> -->
                <div style="margin:auto">
                    <span class=infoPassword>Mot de passe de 8 caract&egrave;res minimum, dont une lettre minuscule, une lettre majuscule, un chiffre et
                        un caractère spécial parmi # ? ! @ € $ % * - + /</span>
                </div>

                <div class="submitLogin">
                    <input type="hidden" class="btn btn-light" name="idUtilisateur" value="<?= $utilisateur->idUtilisateur ?>">
                    <input type="submit" id="submit" value="Modifier">
                </div>
        </form>
    </div>

    <?php if (isset($errorMessageUtilisateur)) : ?>
        <p style="color:red;"><?= $errorMessageUtilisateur ?></p>
    <?php endif; ?>

    <script src="../js/scriptPassword.js"></script>

    <footer>
        <?php require_once 'footer.html' ?>
    </footer>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</html>