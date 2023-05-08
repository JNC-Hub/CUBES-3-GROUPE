<?php
require_once '../Model/Utilisateur.php';
require_once '../Model/Role.php';

$newUtilisateur = new Utilisateur();
$newUtilisateur->nom = trim($_POST['nom'] ?? "");
$newUtilisateur->prenom = trim($_POST['prenom'] ?? "");
$newUtilisateur->mail = trim($_POST['mail'] ?? "");
$newUtilisateur->password = trim($_POST['password'] ?? "");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !empty($_POST['nom'])
        && !empty($_POST['prenom'])
        && !empty($_POST['mail'])
        && !empty($_POST['password'])
    ) {
        //Vérifie que le mot de passe n'existe pas déjà
        if ($newUtilisateur->isMailValid()) {
            // Vérifie si le mot de passe est fort
            if ($newUtilisateur->isPasswordStrong($newUtilisateur->password)) {
                // Hacher le mot de passe
                $newUtilisateur->password = password_hash($newUtilisateur->password, PASSWORD_DEFAULT);
                $utilisateur = $newUtilisateur->addUtilisateur();
                $utilisateur->addRoleUtilisateur();

                //Récupère les données login pour connexion active
                $utilisateurLogin = $utilisateur->getUtilisateurLogin($newUtilisateur->mail);
                var_dump($utilisateurLogin);
                session_start();
                $_SESSION['user'] = $utilisateurLogin;
                $_SESSION['user_idRole'] = $utilisateurLogin['idRole'];
                header('Location: ../index.php');
                exit;
            } else {
                $errorMessageUtilisateur = 'Le mot de passe doit contenir au moins 8 caractères, dont une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial';
            }
        } else {
            $errorMessageUtilisateur = "Un utilisateur existe déjà avec cet e-mail !";
        }
    } else {
        $errorMessageUtilisateur = 'Tous les champs sont obligatoires !';
    }
}

require_once '../View/loginCreation.php';
