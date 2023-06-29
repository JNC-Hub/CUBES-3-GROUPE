<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../Model/Utilisateur.php';

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);
$utilisateurLogin = Utilisateur::getUtilisateurLogin(htmlspecialchars(trim($data['mail'])));

$mail = htmlspecialchars(trim($data['mail']));
$password = htmlspecialchars(trim($data['password']));

$hashpassword = $utilisateurLogin['password'];
if ($utilisateurLogin && password_verify($password, $hashpassword)) {
    $utilisateur_arr = array(
        "idUtilisateur" => $utilisateurLogin['idUtilisateur'],
        "nom" => htmlspecialchars($utilisateurLogin['nom']),
        "prenom" => htmlspecialchars($utilisateurLogin['prenom']),
        "mail" => htmlspecialchars($mail),
    );
    http_response_code(200);
    echo json_encode($utilisateur_arr, JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(404);
    echo json_encode("Identifiants invalides.", JSON_UNESCAPED_UNICODE);
}
