<?php
require_once '../Model/Recette.php';
require_once '../Model/Etape.php';
require_once '../Model/Contenir.php';
require_once '../Model/fpdf/fpdf.php';
require_once '../Model/PdfClass.php';

//Création du pdf A4
$pdf = new PDF('P', 'mm', 'A4');

$idRecette = 2;

$recette = new Recette();
$recette = $recette->getRecipe($idRecette);

// Define alias for number of pages
$pdf->AliasNbPages();
$pdf->AddPage();

//Titre de la recette
$pdf->setTitreRecette($recette->titre);
$pdf->SetXY(10, 30);
$pdf->SetFont('Arial', 'BU', 20);
$pdf->Cell(0, 10, mb_convert_encoding($recette->titre, 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');

//Image de la recette
$idRecette = $recette->idRecette;
$imageFileName = glob('../imageRecipe/' . $idRecette . '.*'); //Récupère le nom de fichier car extension pas connue
$imagePath = '../imageRecipe/' . $imageFileName[0];
//Centrer image
// $pageWidth = $pdf->GetPageWidth();
// $imageWidth = 30;
// $x = ($pageWidth - $imageWidth) / 2;
// $pdf->Image($imagePath, $x, 39, $imageWidth);
$pdf->Image($imagePath, 165, 5, 30);

//Liste des ingrédients
$pdf->SetXY(10, 43);
$pdf->SetFont('Arial', 'U', 12);
$pdf->Write(10, mb_convert_encoding('Liste des ingrédients pour ' . $recette->nbPersonnes . ' personnes', 'ISO-8859-1', 'UTF-8'));

$contenirIngredients = new Contenir();
$ingredientsRecette = $contenirIngredients->getIngredientsRecipe($idRecette);

$numberOfIngredients = count($ingredientsRecette);

foreach ($ingredientsRecette as $ingredient) {
    $quantite = $ingredient->quantite;
    $uniteMesure = $ingredient->libUniteMesure;
    $libIngredient = $ingredient->libIngredient;
    $lineY = $pdf->GetY() + 5;
    $pdf->SetXY(10, $lineY);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Write(10, mb_convert_encoding($quantite . ' ' . $uniteMesure . ' ' . $libIngredient, 'ISO-8859-1', 'UTF-8'));
}

$pdf->Output();
