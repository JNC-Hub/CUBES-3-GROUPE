<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../Model/Utilisateur.php';
require_once '../Model/Role.php';

$utilisateur = new Utilisateur();
$data = json_decode(file_get_contents("php://input"));
$utilisateur->nom = htmlspecialchars(trim($data->nom));
$utilisateur->prenom = htmlspecialchars(trim($data->prenom));
$utilisateur->mail = htmlspecialchars(trim($data->mail));

$password = htmlspecialchars(trim($data->password));
$utilisateur->password = password_hash($password, PASSWORD_DEFAULT);

if ($utilisateur->isMailValid()) {
    $utilisateur->addUtilisateur();
    $utilisateur->addRoleUtilisateur();
    $newUtilisateur = Utilisateur::getUtilisateurLogin($utilisateur->mail);
    if ($newUtilisateur) {
        echo "Utilisateur ajouté avec succès.";
    } else {
        echo "La création de l'utilisateur a échoué.";
    }
} else {
    echo "La création de l'utilisateur a échoué.";
}
