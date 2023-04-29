<?php

require_once '../Controller/authentification.php';
require_once '../Model/Utilisateur.php';

//Je ne vérifie pas le rôle de l'utilisateur car ce sera fait au niveau du bouton header. A voir si nécessaire
if (isset($_SESSION['user_id'])) {
    $idUtilisateur = ($_SESSION['user_id']);
    $utilisateur = new Utilisateur();
    $utilisateur = $utilisateur->getUtilisateur($idUtilisateur);
}

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

    //Vérifie si le mail existe déjà
    $mail = !empty($_POST['mail']) ? trim($_POST['mail']) : '';
    $utilisateur->mail = $mail;
    if (!$utilisateur->isMailValid()) {
        $errorMessageUtilisateur = 'Un utilisateur existe déjà avec cet email';
        $erreur = true;
    }
    var_dump($mail);

    //Vérifie si le mot de passe est fort
    $password = !empty($_POST['password']) ? trim($_POST['password']) : $utilisateur->password;
    $utilisateur->password = $password;
    if (!$utilisateur->isPasswordStrong($password)) {
        $errorMessageUtilisateur = 'Le mot de passe doit contenir 8 caractères minimum dont au moins une lettre minuscule, une lettre majuscule, un chiffre et 
                    un caractère spécial';
        $erreur = true;
    }

    //Si aucune erreur, met à jour l'utilisateur
    if ($erreur == false) {
        $utilisateur = new Utilisateur();
        $utilisateur->getUtilisateur($_POST['id']);
        $utilisateur->nom = trim($_POST['nom']);
        $utilisateur->prenom = trim($_POST['prenom']);
        $utilisateur->mail = trim($_POST['mail']); // mettre à jour la propriété mail

        if (!empty($_POST['password'])) {
            $password = trim($_POST['password']);
            // Hache le mot de passe
            $utilisateur->password = password_hash($password, PASSWORD_DEFAULT);
        }
        $utilisateur->updateUtilisateur($idUtilisateur);
        header('Location: ../index.php');
        exit;
    }
}
require_once '../View/gestionProfil.php';