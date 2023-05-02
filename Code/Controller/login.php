<?php
require_once '../Model/Utilisateur.php';

session_start(); // Démarre la session

if (isset($_SESSION['user'])) {
    if ($_SESSION['user_idRole'] == 1) {
        header('Location: ../View/index.php');
        exit();
    } elseif (($_SESSION['user_idRole'] == 2)) {
        header('Location: ../Controller/compteUtilisateur.php');
        exit();
    }
}

if (!isset($_SESSION['user'])) {
if (!empty($_POST['mail'])
    && !empty($_POST['password'])) {
        //Utilisation de trim pour enlever les espaces en début et fin de chaine
        $mail = trim($_POST['mail']);
        $password = trim($_POST['password']);

        $utilisateur = new Utilisateur();
        $utilisateurLogin = $utilisateur->getUtilisateurLogin($mail);

        //Récupère le mot de passe haché de l'utilisateur
        if ($utilisateurLogin) {
            $hashpassword = $utilisateurLogin['password'];
        }

        //Vérifie qu'on a bien un utilisateur avec ce mail et vérifie le password haché
        if ($utilisateurLogin && isset($_POST['password']) && password_verify($password, $hashpassword)) {
            session_start();
            $_SESSION['user'] = $utilisateurLogin;
            $_SESSION['user_idRole'] = $utilisateurLogin['idRole'];
            header('Location: ../View/index.php');
            exit();
        } else {
            $errorMessageLogUtilisateur = 'Identifiants invalides';
        }
    }
} 


require_once '../View/login.php';