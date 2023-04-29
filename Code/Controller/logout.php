<?php
require_once '../Model/Utilisateur.php';

session_start();
session_unset();
session_destroy();
header("Location: ../index.php");
exit;