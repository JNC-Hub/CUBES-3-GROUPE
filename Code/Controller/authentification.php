<?php

session_start();

//Redirection vers page de login si pas de session utilisateur ou pas de cookie last_activity expiré
if (!isset($_SESSION['user']) || !isset($_COOKIE['last_activity'])) {
    session_unset();
    session_destroy();
    header('Location: ../controller/login.php');
    exit();
}
