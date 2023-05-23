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

//Image de la recette
$idRecette = $recette->idRecette;
$imageFileName = glob('../imageRecipe/' . $idRecette . '.*'); //Récupère le nom de fichier complet avec son extension (extensions différentes)
$imagePath = '../imageRecipe/' . $imageFileName[0];
$pdf->Image($imagePath, 165, 5, 30);

//Titre recette pied de page
$pdf->setTitreRecette(htmlspecialchars($recette->titre));

//Titre de la recette body
$pdf->SetXY(10, 33);
$pdf->SetFont('Arial', 'B', 15);
$pdf->SetFillColor(245, 245, 245);
$pdf->MultiCell(0, 6, htmlspecialchars($recette->titre), 0, 'C', true);

//Histoire de la recette
$yHistoire = $pdf->GetY();
$pdf->SetXY(10, $yHistoire + 5);
$pdf->SetFont('Arial', 'I', 8);
$recetteHistoire = htmlspecialchars($recette->histoire);
$recetteHistoire = str_replace("’", "'", $recetteHistoire); //PB AVEC APOSTROPHES DANS HISTOIRE : refaire un test enregistrement recette avec apostrophes, et vérifier affichage des données
$pdf->MultiCell(0, 4, mb_convert_encoding(htmlspecialchars($recetteHistoire), 'ISO-8859-1', 'UTF-8'), 0, 'L', false);

//Liste des ingrédients
$ylistIngredients = $pdf->GetY();
$pdf->SetXY(10, $ylistIngredients);
$pdf->SetFont('Arial', 'U', 11);
$pdf->Write(10, mb_convert_encoding('Liste des ingrédients pour ' . htmlspecialchars($recette->nbPersonnes) . ' personnes', 'ISO-8859-1', 'UTF-8'));
$contenirIngredients = new Contenir();
$ingredientsRecette = $contenirIngredients->getIngredientsRecipe($idRecette);
$numberOfIngredients = count($ingredientsRecette);
foreach ($ingredientsRecette as $ingredient) {
    $quantite = htmlspecialchars($ingredient->quantite);
    $idUniteMesure = $ingredient->idUniteMesure;
    $idUniteMesure != 12 ? $uniteMesure = htmlspecialchars($ingredient->libUniteMesure) : $uniteMesure = ''; //Enlever unité de mesure si aucune
    $libIngredient = htmlspecialchars($ingredient->libIngredient);
    $yIngredient = $pdf->GetY() + 4.5;
    $pdf->SetXY(10, $yIngredient);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Write(10, mb_convert_encoding(htmlspecialchars($quantite) . ' ' . htmlspecialchars($uniteMesure) . ' ' . htmlspecialchars($libIngredient), 'ISO-8859-1', 'UTF-8'));
}

//Etapes de la recette A GERER
$etapes = new Etape();
$etapes = $etapes->getEtapesRecipe($idRecette);
foreach ($etapes as $etape) {
    $libEtape = htmlspecialchars($etape->libEtape);
}

$pdf->Output();
