<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv=»Content-Type » content=»text/html; charset=utf-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Les Voyageurs Gourmands</title>
</head>

<body>

    <header>
        <?php require_once 'Header.html' ?>
    </header>

    <h1 class="h1Login">Nouveau voyageur gourmand ?</h1>

    <div class="linkLogin">
        <a class="link-dark" href="../Controller/loginCreation.php">Créer un compte</a>
    </div>

    <h1 class="h1Login">Déjà enregistré ?</h1>

    <div class="loginFormBox">

        <form action="../Controller/login.php" method="post">
            <div class="loginForm">
                <div class="form-content">
                    <label for="mail">Email</label>
                    <input type="text" name="mail" id="mail" value="">
                </div>

                <div class="form-content">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" value="">
                    <i class="fa fa-eye" onclick="fafaEye()"></i>
                </div>

                <div class="submitLogin">
                    <input type="submit" class="btn btn-light" id="submit" value="Se connecter">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</html>