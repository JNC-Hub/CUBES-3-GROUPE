<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../Model/Utilisateur.php';

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

$mail = $data['mail'];
$password = $data['password'];

$utilisateurLogin = Utilisateur::getUtilisateurLogin($mail);
$hashpassword = $utilisateurLogin['password'];

if ($utilisateurLogin && password_verify($password, $hashpassword)) {
    $utilisateur_arr = array(
        "id" => $utilisateurLogin['idUtilisateur'],
        "nom" => htmlspecialchars($utilisateurLogin['nom']),
        "prenom" => htmlspecialchars($utilisateurLogin['prenom']),
        "mail" => $utilisateurLogin['mail'],
        // "password" => $utilisateurLogin['password'],
    );
    http_response_code(200);
    echo json_encode($utilisateur_arr, JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(404);
    echo json_encode("Identifiants invalides.", JSON_UNESCAPED_UNICODE);
}
