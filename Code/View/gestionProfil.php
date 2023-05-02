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

    <h2>Modifier mes informations</h2>

    <div>

        <form method="post">

            <div class="formulaire">
                <div class="form-content">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" value="<?= $utilisateur->nom ?>">
                </div>

                <div class="form-content">
                    <label for="prenom">Pr&eacute;nom</label>
                    <input type="text" name="prenom" id="prenom" value="<?= $utilisateur->prenom ?>">
                </div>

                <div class="form-content">
                    <label for="email">Mail</label>
                    <input type="email" name="mail" id="email" value="<?= $utilisateur->mail ?>">
                </div>

                <div class="form-content">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" value="">   
                    <i class="fa fa-eye" onclick="fafaEye()"></i>
                    <span class="password-info">(Remplir uniquement si vous souhaitez modifier votre mot de passe)</span>
                </div>

                <div class="btnSubmit">
                    <input type="hidden" name="id" value="<?= $utilisateur->idUtilisateur ?>">
                    <input type="submit" id="submit" value="Modifier">
                </div>
        </form>
    </div>

    <?php if (isset($errorMessageUtilisateur)) : ?>
        <p style="color:red;"><?= $errorMessageUtilisateur ?></p>
    <?php endif; ?>
    
    <script src="../js/scriptPassword.js"></script>

</body>

</html>