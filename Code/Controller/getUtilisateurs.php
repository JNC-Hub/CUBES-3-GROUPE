<?php

require_once 'authentification.php';
require_once '../Model/Utilisateur.php';

$utilisateur = new Utilisateur();
$utilisateurs = $utilisateur->getUtilisateurs();

require_once '../View/getUtilisateurs.php';
