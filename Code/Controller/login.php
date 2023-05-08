<?php
require_once '../Model/Utilisateur.php';
session_start();

//Selon le role utilisateur, redirige vers la page de gestion
if (isset($_SESSION['user'])) {
    if ($_SESSION['user_idRole'] == 1) {
        header('Location: ../Controller/compteAdmin.php');
        exit();
    } elseif (($_SESSION['user_idRole'] == 2)) {
        header('Location: ../Controller/compteUtilisateur.php');
        exit();
    }
}

//Formulaire de connextion si pas d'utilisateur connecté
if (!isset($_SESSION['user'])) {
    if (
        !empty($_POST['mail'])
        && !empty($_POST['password'])
    ) {
        $mail = trim($_POST['mail']);
        $password = trim($_POST['password']);

        $utilisateur = new Utilisateur();
        $utilisateurLogin = $utilisateur->getUtilisateurLogin($mail);

        //Récupère le mot de passe haché de l'utilisateur
        if ($utilisateurLogin) {
            $hashpassword = $utilisateurLogin['password'];
        }

        //Vérifie que l'utilisateur existe et le mot de passe haché
        if ($utilisateurLogin && isset($_POST['password']) && password_verify($password, $hashpassword)) {
            $_SESSION['user'] = $utilisateurLogin;
            $_SESSION['user_idRole'] = $utilisateurLogin['idRole'];
            setcookie('user_id', $_SESSION['user']['idUtilisateur'], time() + 3600, '/');
            header('Location: ../index.php');
            exit();
        } else {
            $errorMessageLogUtilisateur = 'Identifiants invalides';
        }
    }
}

require_once '../View/login.php';
