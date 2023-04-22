<?php

use App\Db\DbConnection;

require_once "../model/Connection.php";

class Utilisateur
{
    #region//Propriétés
    public int $idUtilisateur = -1;
    public string $nom = "";
    public string $prenom = "";
    public string $mail = "";
    public string $password;
    public string $roles = "";
    #endregion

    #region//Constructeur
    public function __construct()
    {
        /*pas de valeurs initiées sinon récupérées par défaut dans les !empty($_POST['id']) du controller modifieUtilisateur et donc affichage par défaut du message
        erreur Tous les champs sont obligatoires à appel page
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->password = $password;
        $this->roles = $roles;
        */
    }
    #endregion

    #region//Méthodes
    public function getUtilisateurs()
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT U.idUtilisateur, U.nom, U.prenom, U.mail, U.password, GROUP_CONCAT(R.libRole SEPARATOR ', ') AS roles 
                    FROM utilisateur U
                    LEFT JOIN posseder P ON U.idUtilisateur = P.idUtilisateur
                    LEFT JOIN role R ON R.idRole = P.idRole
                    GROUP BY U.idUtilisateur");
        $stmt->execute();
        //PDO::FETCH_CLASS, 'Utilisateur' pour récupérer tableau au lieu de lignes
        $utilisateurs = $stmt->fetchAll(PDO::FETCH_CLASS, 'Utilisateur');
        $db->close();
        return $utilisateurs;
    }

    //Rajout :utilisateur pour signifier renvoi instance de la classe(accessible ->) au lieu objet anonyme (utilisateur[''])
    // : Utilisateur -> pour documenter le code et indiquer type de retour = objet utilisateur. Ne change pas le comportement de la méthode, qui renvoi quand même objet utilisateur
    public function getUtilisateur($id): Utilisateur
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT U.idUtilisateur, U.nom, U.prenom, U.mail, U.password, GROUP_CONCAT(R.libRole SEPARATOR ',') AS roles
                                FROM utilisateur U 
                                LEFT JOIN posseder P ON U.idUtilisateur = P.idUtilisateur 
                                LEFT JOIN role R ON R.idRole = P.idRole 
                                WHERE U.idUtilisateur = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $utilisateur = $stmt->fetchObject('Utilisateur');
        $db->close();
        return $utilisateur;
    }

    public static function getUser($id): Utilisateur
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT U.idUtilisateur, U.nom, U.prenom, U.mail, U.password, GROUP_CONCAT(R.libRole SEPARATOR ',') AS roles
                                FROM utilisateur U 
                                LEFT JOIN posseder P ON U.idUtilisateur = P.idUtilisateur 
                                LEFT JOIN role R ON R.idRole = P.idRole 
                                WHERE U.idUtilisateur = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $utilisateur = $stmt->fetchObject('Utilisateur');
        $db->close();
        return $utilisateur;
    }

    public function getUtilisateurByMail($mail)
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT * FROM utilisateur WHERE mail = :mail");
        $stmt->bindParam(":mail", $mail);
        $stmt->execute();
        //PDO::FETCH_CLASS, 'Utilisateur' pour récupérer tableau au lieu de lignes
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

    public function modifieUtilisateur($id)
    {
        $db = DbConnection::getInstance();
        if (!empty($this->password)) {
            $stmt = $db->prepare("UPDATE utilisateur
                                    SET nom=:nom, prenom=:prenom, mail=:mail, password=:password
                                    WHERE idUtilisateur = :id");
            $stmt->bindParam(":password", $this->password);
        } else {
            $stmt = $db->prepare("UPDATE utilisateur
                                    SET nom=:nom, prenom=:prenom, mail=:mail
                                    WHERE idUtilisateur = :id");
        }
    
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":prenom", $this->prenom);
        $stmt->bindParam(":mail", $this->mail);
        $stmt->execute();
        $db->close();
    
        $this->idUtilisateur = $id;
        return $this;
    }

    public function ajouteUtilisateur()
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("INSERT INTO utilisateur (nom, prenom, mail, password) 
                                VALUES (:nom, :prenom, :mail, :password)");
        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":prenom", $this->prenom);
        $stmt->bindParam(":mail", $this->mail);
        $stmt->bindParam(":password", $this->password);
        $stmt->execute();
        $db->close();

        $this->idUtilisateur = $db->lastInsertId();
        return $this;
    }

    public function ajouteRolesUtilisateur(array $idsRoles)
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("INSERT INTO posseder (idRole, idUtilisateur) 
                                VALUES (:idRole, :idUtilisateur)");
        foreach ($idsRoles as $idRole) {
            $stmt->bindParam(":idRole", $idRole);
            $stmt->bindParam(":idUtilisateur", $this->idUtilisateur);
            $stmt->execute();
        }
        $db->close();
    }

    public function deleteUtilisateur()
    {
        $this->deleteRolesUtilisateur();
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("DELETE FROM utilisateur WHERE idUtilisateur = :id");
        $stmt->bindParam(":id", $this->idUtilisateur);
        $stmt->execute();
        $db->close();
    }

    //paramètre array pour effacer des roles spécifiques si besoin
    public function deleteRolesUtilisateur(array $idsRoles = [])
    {
        $rq = "DELETE FROM posseder WHERE idUtilisateur = :idUtilisateur";
        $db = DbConnection::getInstance();
        if (count($idsRoles) > 0) {
            $rq .= " AND idRole=:idRole";
        }
        $stmt = $db->prepare($rq);
        $stmt->bindParam(":idUtilisateur", $this->idUtilisateur);
        foreach ($idsRoles as $idRole) {
            $stmt->bindParam(":idRole", $idRole);
            $stmt->execute();
        }
        if (count($idsRoles) == 0) {
            $stmt->execute();
        }
        $db->close();
    }

    public function getUtilisateurLogin($mail)
    {
        $db = DbConnection::getInstance();
        $stmt = $db->prepare("SELECT U.mail, U.password, P.idRole
                                    FROM utilisateur U 
                                    LEFT JOIN posseder P ON U.idUtilisateur = P.idUtilisateur 
                                    LEFT JOIN role R ON R.idRole = P.idRole 
                                    WHERE U.mail = :mail");
        $stmt->bindParam(":mail", $mail);
        $stmt->execute();
        $utilisateurLogin = $stmt->fetch(PDO::FETCH_ASSOC);
        $db->close();
        return $utilisateurLogin;
    }

    function isPasswordStrong($password)
    {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            return false;
        } else {
            return true;
        }
    }
    #endregion
}