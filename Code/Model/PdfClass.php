<?php

require_once "Connection.php";
require_once 'Fpdf/fpdf.php';

class PDF extends FPDF
{
    private $titreRecette;

    public function setTitreRecette($titre)
    {
        $this->titreRecette = $titre;
    }

    // Page header
    public function Header()
    {
        // Logo
        $this->Image('../Images/LogoSite.png', 5, -5, 100);

        // Line break
        $this->Ln(50);
    }

    // Page footer
    public function Footer()
    {
        // Marge à 1.5 cm 
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);

        // Numéro de page et titre de la recette
        $this->Cell(0, 10, 'Page ' .
            $this->PageNo() . '/{nb} - Recette ' . $this->titreRecette, 0, 0, 'C');
    }
}
