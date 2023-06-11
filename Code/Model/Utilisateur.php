<?php

require_once "../Model/Connection.php";

class Utilisateur
{
    #region//Propriétés
    public int $idUtilisateur = -1;
    public string $nom = "";
    public string $prenom = "";
    public string $mail = "";
    public string $password;
    public string $roles = "";
    public bool $validationProfil = true;
    public int $idRole = -1;
    #endregion

    #region//Constructeur
    public function __construct()
    {
    }
    #endregion

    #region//Méthodes
    public function getUtilisateurs()
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT U.idUtilisateur, U.nom, U.prenom, U.mail, U.password, U.validationProfil, R.idRole 
                                FROM utilisateur U
                                INNER JOIN posseder P ON U.idUtilisateur = P.idUtilisateur
                                INNER JOIN role R ON R.idRole = P.idRole");
        $stmt->execute();
        $utilisateurs = $stmt->fetchAll(PDO::FETCH_CLASS, 'Utilisateur');
        $db->close();
        return $utilisateurs;
    }

    public function getUtilisateur($id): Utilisateur
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT U.idUtilisateur, U.nom, U.prenom, U.mail, U.password, U.validationProfil, P.idRole
                                FROM utilisateur U 
                                INNER JOIN posseder P ON U.idUtilisateur = P.idUtilisateur 
                                INNER JOIN role R ON R.idRole = P.idRole 
                                WHERE U.idUtilisateur = :id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $utilisateur = $stmt->fetchObject('Utilisateur');
        $db->close();
        return $utilisateur;
    }

    public static function getUtilisateurActif($id)
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = :id AND validationProfil = 1");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $utilisateur = $stmt->fetchObject('Utilisateur');
        $db->close();
        return $utilisateur;
    }

    public function getUtilisateurByMail($mail)
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT * FROM utilisateur WHERE mail = :mail");
        $stmt->bindValue(":mail", $mail);
        $stmt->execute();
        $utilisateurByMail = $stmt->fetchAll(PDO::FETCH_CLASS, 'Utilisateur');
        $db->close();
        return $utilisateurByMail;
    }

    public function isMailValid()
    {
        $utilisateursMail = $this->getUtilisateurByMail($this->mail);
        foreach ($utilisateursMail as $utilisateurMail) {
            if ($utilisateurMail->mail == $this->mail && $utilisateurMail->idUtilisateur != $this->idUtilisateur) {
                return false;
            }
        }
        return true;
    }

    public function updateActivationProfil($id)
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("UPDATE utilisateur
                                SET validationProfil = NOT validationProfil
                                WHERE idUtilisateur = :id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $db->close();

        $this->idUtilisateur = $id;
        return $this;
    }

    public function updateUtilisateur($id)
    {
        $db = DbConnection::getInstance();

        $stmt = $db->prepare("UPDATE utilisateur
                                SET nom=:nom, prenom=:prenom, mail=:mail, password=:password
                                WHERE idUtilisateur = :id");
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":nom", $this->nom);
        $stmt->bindValue(":prenom", $this->prenom);
        $stmt->bindValue(":mail", $this->mail);
        $stmt->bindValue(":password", $this->password);
        $stmt->execute();
        $db->close();

        $this->idUtilisateur = $id;
        return $this;
    }

    public function addUtilisateur()
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("INSERT INTO utilisateur (nom, prenom, mail, password, validationProfil) 
                                VALUES (:nom, :prenom, :mail, :password, 1)");
        $stmt->bindValue(":nom", $this->nom);
        $stmt->bindValue(":prenom", $this->prenom);
        $stmt->bindValue(":mail", $this->mail);
        $stmt->bindValue(":password", $this->password);
        $stmt->execute();
        $db->close();

        $this->idUtilisateur = $db->lastInsertId();
        return $this;
    }

    public function addRoleUtilisateur()
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("INSERT INTO posseder (idRole, idUtilisateur) 
                                VALUES (2, :idUtilisateur)");
        $stmt->bindValue(":idUtilisateur", $this->idUtilisateur);
        $stmt->execute();
        $db->close();
    }

    public static function getUtilisateurLogin($mail)
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT U.idUtilisateur, U.mail, U.password, U.nom, U.prenom, P.idRole, U.validationProfil
                                    FROM utilisateur U 
                                    INNER JOIN posseder P ON U.idUtilisateur = P.idUtilisateur 
                                    INNER JOIN role R ON R.idRole = P.idRole 
                                    WHERE U.mail = :mail AND U.validationProfil = 1");
        $stmt->bindValue(":mail", $mail);
        $stmt->execute();
        $utilisateurLogin = $stmt->fetch(PDO::FETCH_ASSOC);
        $db->close();
        return $utilisateurLogin;
    }

    public function isPasswordStrong()
    {
        $uppercase = preg_match('@[A-Z]@', $this->password);
        $lowercase = preg_match('@[a-z]@', $this->password);
        $number    = preg_match('@[0-9]@', $this->password);
        // $specialChars = preg_match('@[^\w]@', $password);
        $specialChars = preg_match('@[#?!\@€$%*-+/]@', $this->password);

        if (htmlspecialchars($this->password) != $this->password || !$uppercase || !$lowercase || !$number || !$specialChars || strlen($this->password) < 8) {
            return false;
        } else {
            return true;
        }
    }
    #endregion
}
