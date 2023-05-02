<?php

//Vérifie que l'utilisateur est bien connecté
session_start(); // Démarre la session
if (!isset($_SESSION['user'])) { // Vérifie si la variable de session 'user' est définie
    header('Location: ../controller/login.php'); // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
} else {
    $_SESSION['user_idUtilisateur'] = intval($_SESSION['user']['idUtilisateur']);
    $_SESSION['user_idRole'] = intval($_SESSION['user']['idRole']);
}