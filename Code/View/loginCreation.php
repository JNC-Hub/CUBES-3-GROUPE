<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv=»Content-Type » content=»text/html; charset=utf-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Les voyageurs gourmands</title>
</head>

<body>
    <header>
        
    </header>

    <h2>Créer mon compte</h2>

    <div>

        <form action="../controller/loginCreation.php" method="post">

            <div>
                <div>
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" value="<?= $newUtilisateur->nom?>">
                </div>

                <div>
                    <label for="prenom">Pr&eacute;nom</label>
                    <input type="text" name="prenom" id="prenom" value="<?= $newUtilisateur->prenom?>">
                </div>

                <div>
                    <label for="email">Mail</label>
                    <input type="email" placeholder="mail@example.com" name="mail" id="email" value="<?= $newUtilisateur->mail?>">
                </div>

                <div >
                    <label for="password">Mot de passe</label>
                    <!-- Obligation de rentrer un mot de passe fort -->
                    <input type="password" name="password" id="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" title="Le mot de passe doit contenir 
                    au moins 8 caractères, dont une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial." value="<?= $newUtilisateur->password?>">
                    <i class="fa fa-eye" onclick="fafaEye()"></i>
                </div>

                <div class="btnSubmit">
                    <input type="submit" id="submit" value="Enregistrer">
                </div>
        </form>
    </div>

    <script src="../Js/scriptPassword.js"></script>

    <?php if (isset($errorMessageUtilisateur)) : ?>
        <p style="color:red"><?= $errorMessageUtilisateur ?></p>
    <?php endif; ?>

</body>

</html>