<?php

//Vérifie que l'utilisateur est bien connecté
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit();
} else {
    //Stocke l'idUtilisateur dans variable de session pour pouvoir l'utiliser dans les fonctionnalités avec connexion
    $_SESSION['user_id'] = $_SESSION['user']['idUtilisateur'];
    //Stocke le rôle de l'utilisateur
    $_SESSION['user_idRole'] = $_SESSION['user']['idRole'];
}