<?php
require_once '../Model/Utilisateur.php';
require_once '../Model/Role.php';

$newUtilisateur = new Utilisateur();
$newUtilisateur->nom = htmlspecialchars(trim($_POST['nom'] ?? ""));
$newUtilisateur->prenom = htmlspecialchars(trim($_POST['prenom'] ?? ""));
$newUtilisateur->mail = htmlspecialchars(trim($_POST['mail'] ?? ""));
$newUtilisateur->password = htmlspecialchars(trim($_POST['password'] ?? ""));

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
                session_start();
                $_SESSION['user'] = $utilisateurLogin;
                $_SESSION['user_idRole'] = $utilisateurLogin['idRole'];
                //Création cookie pour déconnexion automatique au bout 30mn d'inactivité
                setcookie('last_activity', session_id(), time() + 1800, '/', '', false, true);
                header('Location: ../index.php');
                exit;
            } else {
                $errorMessageUtilisateur = 'Le mot de passe doit contenir 8 caractères minimum, dont au moins une lettre minuscule, une lettre majuscule, un chiffre et 
                un caractère spécial parmi # ? ! @ € $ % * - + /';
            }
        } else {
            $errorMessageUtilisateur = "Un utilisateur existe déjà avec cet e-mail !";
        }
    } else {
        $errorMessageUtilisateur = 'Tous les champs sont obligatoires !';
    }
}

require_once '../View/loginCreation.php';
