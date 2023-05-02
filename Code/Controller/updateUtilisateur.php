<?php

require_once '../Controller/auth.php';
require_once '../Model/Utilisateur.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['idUtilisateur'], $_POST['validationProfil'])) {
        if ($utilisateur->validationProfil == 1) {
            $validationProfil = 0;
        } else {
            $validationProfil = 1;
        }

        $idUtilisateur = $_POST['idUtilisateur'];
        $validationProfil = $_POST['validationProfil'];
    }
    $utilisateur = new Utilisateur();


    if ($utilisateur)
    $utilisateur->updateUtilisateur($idUtilisateur);
    header('Location: ../Controller/getUtilisateurs.php');
    exit;
}
require_once '../Controller/getUtilisateurs.php';