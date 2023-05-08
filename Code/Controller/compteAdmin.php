<?php
require_once 'authentification.php';
require_once '../Model/Utilisateur.php';

//Vérifie que l'utilisateur connecté est bien administrateur
if ($_SESSION['user_idRole'] == 1) {
    header('Location: ../View/compteAdmin.php');
} else {
    header('Location: ../index.php');
}
