<?php

use App\Db\DbConnection;

require_once "../Model/Connection.php";

class Recette
{
    #region//Propriétés
    public int $idRecette;
    public DateTime $dateRecette;
    public string $titre;
    public int $nbPersonnes;
    public string $histoire;
    public string $image;
    #endregion

    #region//Constructeur
    public function __construct(DateTime $dateRecette, string $titre, int $nbPersonnes, string $histoire, string $image)
    {
        $this->dateRecette = $dateRecette;
        $this->titre = $titre;
        $this->nbPersonnes = $nbPersonnes;
        $this->histoire = $histoire;
        $this->image = $image;
    }
    #endregion

    #region//Méthodes

    #endregion
}