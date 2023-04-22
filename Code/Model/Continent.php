<?php

use App\Db\DbConnection;

require_once "../Model/Connection.php";

class statutRecette
{
    #region//Propriétés
    public int $idContinent;
    public DateTime $libContinent;
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