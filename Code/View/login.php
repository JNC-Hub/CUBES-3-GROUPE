<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv=»Content-Type » content=»text/html; charset=utf-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Les Voyageurs Gourmands</title>
</head>

<body>

    <header>
        <?php require_once 'Header.html' ?>
    </header>

    <h1>Nouveau sur Les Voyageurs Gourmands ?</h1>

    <a href="../Controller/loginCreation.php">Créer un compte</a>

    <h1>Déjà enregistré ?</h1>

    <div>
        <form action="../Controller/login.php" method="post">
            <div>
                <div>
                    <label for="mail">Email</label>
                    <input type="text" name="mail" id="mail" value="">
                </div>

                <div>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" value="">
                    <i class="fa fa-eye" onclick="fafaEye()"></i>
                </div>
                <div>
                    <input type="submit" id="submit" value="Me connecter">
                </div>
        </form>
    </div>

    <script src="../Js/scriptPassword.js"></script>

    <?php if (isset($errorMessageLogUtilisateur)) : ?>
        <p style="color:red"><?= $errorMessageLogUtilisateur ?></p>
    <?php endif; ?>

    <footer>
        <?php require_once 'footer.html' ?>
    </footer>

</body>

</html>