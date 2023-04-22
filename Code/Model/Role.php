<?php

use App\Db\DbConnection;

require_once "../model/Connection.php";

class Role
{
    #region//Propriétés
    public int $idRole = -1;
    public string $libRole;
    #endregion

    #region//Constructeur
    public function __construct(string $libRole = '')
    {
        // $this->libRole = $libRole; //pas de valeur sinon récupérée par défaut dans modifier un utilisateur
    }
    #endregion

    #region//Méthodes
    public function getRoles()
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT * FROM role");
        $stmt->execute();
        $roles = $stmt->fetchAll(PDO::FETCH_CLASS, 'Role');
        $db->close();
        return $roles;
    }

    public function getRole($id)
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT * FROM role WHERE idRole = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $role = $stmt->fetchObject('Role');
        $db->close();
        return $role;
    }

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

    public function ajouteRole()
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("INSERT INTO role (libRole) VALUES (:libRole)");
        $stmt->bindParam(":libRole", $this->libRole);
        $stmt->execute();
        $db->close();
    }

    public function modifieRole($id)
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("UPDATE role SET libRole=:libRole WHERE idRole = :id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":libRole", $this->libRole);
        $stmt->execute();
        $db->close();
        
        $this->idRole = $id;
        return $this;
    }

    public function deleteRole($id)
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("DELETE FROM role WHERE idRole = :id;");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $db->close();
    }
    #endregion
}