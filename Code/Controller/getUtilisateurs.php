<?php

// require_once '../controller/auth.php';
require_once '../Model/Utilisateur.php';

$utilisateur = new Utilisateur();
$utilisateurs = $utilisateur->getUtilisateurs();

require_once '../View/getUtilisateurs.php';