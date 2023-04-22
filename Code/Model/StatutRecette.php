<?php

use App\Db\DbConnection;

require_once "../model/Connection.php";

class statutRecette
{
    #region//Propriétés
    public int $idStatut;
    public DateTime $libStatut;
    #endregion

    #region//Constructeur
    public function __construct(string $libStatut)
    {
        $this->libStatut = $libStatut;
    }
    #endregion

    #region//Méthodes

    #endregion
}