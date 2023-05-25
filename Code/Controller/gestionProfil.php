<?php

require_once 'authentification.php';
require_once '../Model/Utilisateur.php';

$utilisateur = new Utilisateur();

//Affiche les données de l'utiisateur connecté
if (isset($_SESSION['user'])) {
    $idUtilisateur = $_SESSION['user']['idUtilisateur'];
    $utilisateur = new Utilisateur();
    $utilisateur = $utilisateur->getUtilisateur($idUtilisateur);
}

//Mettre à jour les données de l'utilisateur connecté
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $utilisateur->nom = htmlspecialchars(trim($_POST['nom']));
    $utilisateur->prenom = htmlspecialchars(trim($_POST['prenom']));
    $utilisateur->mail = htmlspecialchars(trim($_POST['mail']));
    $utilisateur->password = htmlspecialchars(trim($_POST['password']));

    $erreur = false;
    if (empty($utilisateur->nom)) {
        $errorMessageUtilisateur = 'Le nom est obligatoire !';
        $erreur = true;
    }
    if (empty($utilisateur->prenom)) {
        $errorMessageUtilisateur = 'Le prénom est obligatoire !';
        $erreur = true;
    }
    if (empty($utilisateur->mail)) {
        $errorMessageUtilisateur = 'Le mail est obligatoire !';
        $erreur = true;
    }

    //Vérifie que le mail n'existe pas déjà
    if (!$utilisateur->isMailValid()) {
        $errorMessageUtilisateur = 'Un utilisateur existe déjà avec cet email';
        $erreur = true;
    }

    //Vérifie si le mot de passe est fort
    if (strlen($utilisateur->password) > 0 && !$utilisateur->isPasswordStrong()) {
        // $errorMessageUtilisateur = 'Le mot de passe doit contenir 8 caractères minimum, dont au moins une lettre minuscule, une lettre majuscule, un chiffre et 
        //             un caractère spécial différent de & < " ou >';
        $errorMessageUtilisateur = 'Le mot de passe doit contenir 8 caractères minimum, dont au moins une lettre minuscule, une lettre majuscule, un chiffre et 
                    un caractère spécial parmi # ? ! @ € $ % * - + /';
        $erreur = true;
    }

    //Vérifie que les deux mots de passe sont identiques
    if (!empty($_POST['password'])) {
        $passwordConfirm = htmlspecialchars(trim($_POST['passwordConfirm']));
        if ($utilisateur->password != $passwordConfirm) {
            $errorMessageUtilisateur = 'Les deux mots de passe sont différents';
            $erreur = true;
        }
    }

    //Vérifie qu'il y un mot de passe saisi si mot de passe de confirmation
    if (!empty($_POST['passwordConfirm'])) {
        if (empty($_POST['password'])) {
            $errorMessageUtilisateur = 'Vous devez saisir votre mot de passe deux fois';
            $erreur = true;
        }
    }

    //Si aucune erreur, met à jour l'utilisateur    
    if ($erreur == false) {
        // Hache le mot de passe si modifié, sinon récupère le mot de passe existant
        $utilisateurBdd = Utilisateur::getUser($_POST['idUtilisateur']);
        !empty($utilisateur->password) ? $utilisateur->password = password_hash($utilisateur->password, PASSWORD_DEFAULT) : $utilisateur->password = $utilisateurBdd->password;

        $utilisateur->updateUtilisateur($idUtilisateur);
        header('Location: ../Controller/compteUtilisateur.php');
        exit;
    }
}

require_once '../View/gestionProfil.php';
