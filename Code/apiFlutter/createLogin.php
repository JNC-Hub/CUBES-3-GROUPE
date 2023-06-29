<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
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
        error_log(print_r($newUtilisateur, TRUE));
        $utilisateur_arr = array(
            "idUtilisateur" => $newUtilisateur['idUtilisateur'],
            "nom" => $newUtilisateur['nom'],
            "prenom" => $newUtilisateur['prenom'],
            "mail" => $newUtilisateur['mail'],
        );
        http_response_code(200);
        echo json_encode($utilisateur_arr, JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(404);
        echo json_encode(array('message' => 'La création de l\'utilisateur a échoué.'));
    }
} else {
    http_response_code(404);
    echo json_encode(array('message' => 'Le mail existe déjà!'));
}
