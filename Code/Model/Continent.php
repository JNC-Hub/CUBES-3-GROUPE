<?php

use App\Db\DbConnection;

require_once "../model/Connection.php";

class statutRecette
{
    #region//Propriétés
    public int $idContinent;
    public string $libContinent;
    #endregion

    #region//Constructeur
    public function __construct(string $libContinent)
    {
        $this->libContinent = $libContinent;
    }
    #endregion

    #region//Méthodes

    #endregion
}