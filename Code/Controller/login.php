<?php
require_once '../Model/Utilisateur.php';

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
            header('Location: ../Controller/gestionProfil.php');
            exit();
        } else {
            $errorMessageLogUtilisateur = 'Identifiants invalides';
        }
    }

header('Location: ../View/login.php');
exit();