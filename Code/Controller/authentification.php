<?php

//Vérifie que l'utilisateur est bien connecté
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../controller/login.php');
    $_SESSION['user_idUtilisateur'] = $_SESSION['user']['idUtilisateur'];
    $_SESSION['user_idRole'] = $_SESSION['user']['idRole'];
}
