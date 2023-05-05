<?php

//Vérifie que l'utilisateur est bien connecté
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../controller/login.php');
}
