<?php

require_once '../Model/Utilisateur.php';

session_start();

//Redirection vers page de login si pas de session utilisateur ou pas de cookie last_activity expiré
if (!isset($_SESSION['user']) || !isset($_COOKIE['last_activity'])) {
    session_unset();
    session_destroy();
    header('Location: ../Controller/login.php');
    exit();
}

//Vérifie que le compte est toujours existant ou actif pendant la navigation
if (isset($_SESSION['user'])) {
    $utilisateurActif = Utilisateur::getUtilisateurActif($_SESSION['user_id']);
    if (!$utilisateurActif) {
        session_unset();
        session_destroy();
        header('Location: ../Controller/login.php');
        exit();
    }
}
