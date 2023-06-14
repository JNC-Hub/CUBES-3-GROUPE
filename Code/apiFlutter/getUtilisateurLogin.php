<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../Model/Utilisateur.php';

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

$utilisateurLogin = Utilisateur::getUtilisateurLogin($data['mail']);

$hashpassword = $utilisateurLogin['password'];

$idUtilisateur = $utilisateurLogin['idUtilisateur'];
$nom = $utilisateurLogin['nom'];
$prenom = $utilisateurLogin['prenom'];
$mail = $utilisateurLogin['mail'];

if ($utilisateurLogin && password_verify($data['password'], $hashpassword)) {
    $utilisateur_arr = array(
        "id" => $idUtilisateur,
        "nom" => htmlspecialchars($nom),
        "prenom" => htmlspecialchars($prenom),
        "mail" => htmlspecialchars($mail),
    );
    http_response_code(200);
    echo json_encode($utilisateur_arr, JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(404);
    echo json_encode("Identifiants invalides.", JSON_UNESCAPED_UNICODE);
}
