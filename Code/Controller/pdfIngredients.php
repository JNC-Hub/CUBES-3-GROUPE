<?php
require_once '../Model/Recette.php';
require_once '../Model/fpdf/fpdf.php';
require_once '../Model/PdfClass.php';

//Création du pdf A4
$pdf = new PDF('P', 'mm', 'A4');

//Titre de la recette
$recette = new Recette();
$titreRecette = $recette->getRecipe(1);
$pdf->setTitreRecette($titreRecette['titre']);

// Define alias for number of pages
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 14);

//Titre du document
$pdf->SetXY(10, 50);
$pdf->SetFont('Arial', 'B', 15);
$pdf->Write(10, (mb_convert_encoding('Recette : ', 'ISO-8859-1', 'UTF-8') . $titreRecette['titre']));

$pdf->SetXY(10, 60);
$pdf->SetFont('Arial', '', 12);
$pdf->Write(10, 'Nombre de personnes : ' . $titreRecette['nbPersonnes']);

for ($i = 1; $i <= 30; $i++)
    $pdf->Cell(0, 10, 'line number '
        . $i, 0, 1);
$pdf->Output();
