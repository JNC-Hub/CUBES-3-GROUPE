<?php

require_once '../Model/fpdf/fpdf.php';

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
        $this->Image('../Images/logoVG.png', 10, 8, 33);

        // Nom du site
        $this->SetFont('Arial', 'BI', 14);
        $this->Cell(40);
        $this->Cell(55, 5, 'Les Voyageurs Gourmands', 0, 0, 'C');

        //Lien du site web
        $link = 'http://localhost:8080/CUBES-3-GROUPE/Code/View/accueil.php';
        $this->SetXY(45, 13);
        $this->SetTextColor(0, 0, 255);
        $this->SetFont('Arial', 'UI', 10); // Définir la police et le style (souligné)
        $this->Write(10, 'www.lesvoyageursgourmands.com', $link);

        // Titre du document
        $this->SetXY(75, 30);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial', 'Bu', 15); // Définir la police et le style (souligné)
        $this->Write(10, (mb_convert_encoding('LISTE DES COURSES', 'ISO-8859-1', 'UTF-8')));

        // Line break
        $this->Ln(50);
    }

    // Page footer
    public function Footer()
    {
        // Marge à 1.5 cm 
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);

        // Numéro de page
        $this->Cell(0, 10, 'Page ' .
            $this->PageNo() . '/{nb} - Recette ' . $this->titreRecette, 0, 0, 'C');
    }
}
