<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv=»Content-Type » content=»text/html; charset=utf-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/compteAdmin.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Les Voyageurs Gourmands</title>
</head>

<body>

    <header>
        <?php require_once 'Header.html' ?>
    </header>

    <div>
        <div><a href="../Controller/compteAdmin.php"><img src="../Images/back-arrow.png" alt="Go back" class="imgLogin">
            </a></div>
    </div>

    <a href="../Controller/login.php"><img src="../Images/avatar.png" id="imageuser"></a>
    <h2 class="tableTitle">Liste des utilisateurs</h2>

    <div class="tableUsers">
        <table class="table table-hover">
            <tr>
                <th>Nom</th>
                <th>Pr&eacute;nom</th>
                <th>Mail</th>
                <th>Statut du compte</th>
                <th>Modifier statut</th>
            </tr>

            <?php
            foreach ($utilisateurs as $utilisateur) :
                if ($utilisateur->idRole == 2) : ?>
            <tr>
                <td><?= htmlspecialchars($utilisateur->nom) ?></td>
                <td><?= htmlspecialchars($utilisateur->prenom) ?></td>
                <td><?= htmlspecialchars($utilisateur->mail) ?></td>
                <td><?= $utilisateur->validationProfil == 1 ? 'Actif' : 'Inactif' ?></td>

                <td>
                    <form action="../Controller/updateActivationProfil.php" method="post">
                        <input type="hidden" name="idUtilisateur" value="<?= $utilisateur->idUtilisateur ?>">
                        <button type="submit" style="border:none; background-color:transparent"><img
                                src="../Images/person-lock.svg"></button>
                    </form>
                </td>
            </tr>
            <?php endif;
            endforeach; ?>
        </table>
    </div>

    <footer>
        <?php require_once 'footer.html' ?>
    </footer>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>

</html>