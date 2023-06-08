<?php

require_once "../Model/Connection.php";

class Role
{
    #region//Propriétés
    private int $idRole = -1;
    private string $libRole;
    #endregion

    #region//Constructeur
    public function __construct(string $libRole = '')
    {
        $this->libRole = $libRole;
    }
    #endregion
    #region//Getters et setters
    public function __get($pParam)
    {
        if (isset($this->$pParam)) {
            return $this->$pParam;
        } else {
            throw new Exception("Parametre inconnu : " . $pParam);
        }
    }

    public function __set($pParam, $pValue)
    {
        if (isset($pParam)) {
            $this->$pParam = $pValue;
        } else {
            throw new Exception("Parametre inconnu : " . $pParam);
        }
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

    public function getRoleByUtilisateur($idUtilisateur)
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT * FROM posseder P INNER JOIN role R on R.idRole = P.idRole WHERE idUtilisateur = :idUtilisateur");
        $stmt->bindValue(":idUtilisateur", $idUtilisateur);
        $stmt->execute();
        $roleByUtilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        $db->close();
        return $roleByUtilisateur;
    }

    public function addRole()
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("INSERT INTO role (libRole) VALUES (:libRole)");
        $stmt->bindValue(":libRole", $this->libRole);
        $stmt->execute();
        $db->close();
    }
    #endregion
}
