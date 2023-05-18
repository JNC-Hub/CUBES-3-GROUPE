<?php

require_once 'authentification.php';
require_once '../Model/Utilisateur.php';

//Affiche les données de l'utiisateur connecté
if (isset($_SESSION['user'])) {
    $idUtilisateur = $_SESSION['user']['idUtilisateur'];
    $utilisateur = new Utilisateur();
    $utilisateur = $utilisateur->getUtilisateur($idUtilisateur);
}

//Mettre à jour les données de l'utilisateur connecté
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $erreur = false;
    if (empty($_POST['nom'])) {
        $errorMessageUtilisateur = 'Le nom est obligatoire !';
        $erreur = true;
    }
    if (empty($_POST['prenom'])) {
        $errorMessageUtilisateur = 'Le prénom est obligatoire !';
        $erreur = true;
    }
    if (empty($_POST['mail'])) {
        $errorMessageUtilisateur = 'Le mail est obligatoire !';
        $erreur = true;
    }

    //Vérifie que le mail n'existe pas déjà
    $mail = !empty($_POST['mail']) ? htmlspecialchars(trim($_POST['mail'])) : '';
    $utilisateur->mail = $mail;
    if (!$utilisateur->isMailValid()) {
        $errorMessageUtilisateur = 'Un utilisateur existe déjà avec cet email';
        $erreur = true;
    }

    //Vérifie si le mot de passe est fort
    $password = !empty($_POST['password']) ? htmlspecialchars(trim($_POST['password'])) : $utilisateur->password;
    $utilisateur->password = $password;
    if (!$utilisateur->isPasswordStrong($password)) {
        // $errorMessageUtilisateur = 'Le mot de passe doit contenir 8 caractères minimum, dont au moins une lettre minuscule, une lettre majuscule, un chiffre et 
        //             un caractère spécial différent de & < " ou >';
        $errorMessageUtilisateur = 'Le mot de passe doit contenir 8 caractères minimum, dont au moins une lettre minuscule, une lettre majuscule, un chiffre et 
                    un caractère spécial parmi # ? ! @ € $ % * - + /';
        $erreur = true;
    }

    //Si aucune erreur, met à jour l'utilisateur    
    if ($erreur == false) {
        $utilisateur = new Utilisateur();
        $utilisateur = $utilisateur->getUtilisateur($idUtilisateur);
        $utilisateur->nom = htmlspecialchars(trim($_POST['nom']));
        $utilisateur->prenom = htmlspecialchars(trim($_POST['prenom']));
        $utilisateur->mail = htmlspecialchars(trim($_POST['mail']));

        if (!empty($_POST['password'])) {
            $password = htmlspecialchars(trim($_POST['password']));
            // Hache le mot de passe
            $utilisateur->password = password_hash($password, PASSWORD_DEFAULT);
        }
        $utilisateur->updateUtilisateur($idUtilisateur);
        header('Location: ../index.php');
        exit;
    }
}

require_once '../View/gestionProfil.php';
