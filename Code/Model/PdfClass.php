<?php

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
        $this->Image('../Images/logoVG.png', 10, 8, 15);

        // Nom du site
        $this->SetXY(25, 4);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial', 'BI', 10);
        $this->Write(10, 'Les Voyageurs Gourmands');

        //Lien vers site web
        $link = 'http://localhost:8080/CUBES-3-GROUPE/Code/View/accueil.php';
        $this->SetXY(25, 8);
        $this->SetTextColor(0, 0, 255);
        $this->SetFont('Arial', 'UI', 8);
        $this->Write(10, 'www.lesvoyageursgourmands.com', $link);

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
