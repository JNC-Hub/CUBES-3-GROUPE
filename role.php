<?php

use App\Db\DbConnection;

require_once "../model/connection.php";

class Role
{
    #region//Propriétés
    public int $idRole = -1;
    public string $libRole;
    #endregion

    #region//Constructeur
    public function __construct(string $libRole = '')
    {
        $this->libRole = $libRole;
    }
    #endregion

    #region//Méthodes

    public function getRoleByUtilisateur($idUtilisateur)
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT * FROM posseder P INNER JOIN role R on R.idRole = P.idRole WHERE idUtilisateur = :idUtilisateur");
        $stmt->bindParam(":idUtilisateur", $idUtilisateur);
        $stmt->execute();
        $roleByUtilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        $db->close();
        return $roleByUtilisateur;
    }

    public function addRole()
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("INSERT INTO role (libRole) VALUES (:libRole)");
        $stmt->bindParam(":libRole", $this->libRole);
        $stmt->execute();
        $db->close();
    }
    #endregion
}