<?php

require_once 'authentification.php';
require_once '../Model/Utilisateur.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['idUtilisateur'])) {
        $idUtilisateur = $_POST['idUtilisateur'];
        $utilisateur = new Utilisateur();
        $utilisateur->updateActivationProfil($idUtilisateur);
        header('Location: ../Controller/getUtilisateurs.php');
        exit;
    }
}
require_once '../Controller/getUtilisateurs.php';
