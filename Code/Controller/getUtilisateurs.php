<?php

require_once 'authentification.php';
require_once '../Model/Utilisateur.php';

//Vérifie que l'utilisateur connecté est bien administrateur
if ($_SESSION['user_idRole'] == 1) {
    $utilisateur = new Utilisateur();
    $utilisateurs = $utilisateur->getUtilisateurs();
    var_dump($utilisateurs);
    exit();
    require_once '../View/getUtilisateurs.php';
} else {
    header('Location:../index.php');
}
