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
        || !empty($_POST['prenom'])
        || !empty($_POST['mail'])
        || !empty($_POST['password'])
    ) {

        $erreur = false;
        if (empty($newUtilisateur->nom) || empty($newUtilisateur->prenom) || empty($newUtilisateur->mail)) {
            $errorMessageUtilisateur = 'Tous les champs sont obligatoires !';
            $erreur = true;
        }

        //Vérifie si le mail existe déjà
        if (!$newUtilisateur->isMailValid()) {
            $errorMessageUtilisateur = 'Un utilisateur existe déjà avec cet email';
            $erreur = true;
        }

        //Vérifie si le mot de passe est fort
        if (!$newUtilisateur->isPasswordStrong()) {
            // $errorUtilisateur = 'Le mot de passe doit contenir 8 caractères minimum, dont au moins une lettre minuscule, une lettre majuscule, un chiffre et 
            //             un caractère spécial différent de & < " ou >';
            $errorMessageUtilisateur = 'Le mot de passe doit contenir 8 caractères minimum, dont au moins une lettre minuscule, une lettre majuscule, un chiffre et 
                        un caractère spécial parmi # ? ! @ € $ % * - + /';
            $erreur = true;
        }

        //Vérifie que les deux mots de passe sont identiques
        if (!empty($_POST['password'])) {
            $passwordConfirm = htmlspecialchars(trim($_POST['passwordConfirm']));
            if ($newUtilisateur->password != $passwordConfirm) {
                $errorMessageUtilisateur = 'Les deux mots de passe sont différents';
                $erreur = true;
            }
        }

        //Vérifie mot de passe saisi si mot de passe de confirmation saisi
        if (!empty($_POST['passwordConfirm'])) {
            if (empty($_POST['password'])) {
                $errorMessageUtilisateur = 'Vous devez saisir le mot de passe deux fois';
                $erreur = true;
            }
        }

        if ($erreur == false) {
            // Hacher le mot de passe
            $newUtilisateur->password = password_hash($newUtilisateur->password, PASSWORD_DEFAULT);
            $newUtilisateur->addUtilisateur();
            $newUtilisateur->addRoleUtilisateur();

            //Récupère les données login pour connexion active
            $utilisateurLogin = Utilisateur::getUtilisateurLogin($newUtilisateur->mail);
            session_start();
            $_SESSION['user'] = $utilisateurLogin;
            $_SESSION['user_id'] = $utilisateurLogin['idUtilisateur'];
            $_SESSION['user_idRole'] = $utilisateurLogin['idRole'];

            //Création cookie pour déconnexion automatique au bout 30mn d'inactivité
            setcookie('last_activity', session_id(), time() + 1800, '/', '', false, true);
            header('Location: ../index.php');
            exit;
        }
    }
}

require_once '../View/loginCreation.php';
