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

    <h2>Liste des utilisateurs</h2>

    <table>
        <tr>
            <th>Nom</th>
            <th>Pr&eacute;nom</th>
            <th>Mail</th>
            <th>Statut du compte</th>
            <th>Activer/D&eacute;sactiver le profil</th>
        </tr>

        <?php
        foreach ($utilisateurs as $utilisateur) :
            if ($utilisateur->idRole == 2) : ?>
                <tr>
                    <td><?= $utilisateur->nom ?></td>
                    <td><?= $utilisateur->prenom ?></td>
                    <td><?= $utilisateur->mail ?></td>
                    <td><?= $utilisateur->validationProfil == 1 ? 'Actif' : 'Inactif' ?></td>

                    <td>
                        <form action="../Controller/updateUtilisateur.php" method="post">
                            <input type="hidden" name="idUtilisateur" value="<?= $utilisateur->idUtilisateur ?>">
                            <button type="submit"><img src="../images/person-lock.svg"></button>
                        </form>
                    </td>
                </tr>
        <?php endif;
        endforeach; ?>
    </table>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</html>