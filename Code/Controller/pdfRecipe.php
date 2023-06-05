<?php
require_once '../Model/Recette.php';
require_once '../Model/Etape.php';
require_once '../Model/Contenir.php';
require_once '../Model/Fpdf/fpdf.php';
require_once '../Model/PdfClass.php';

if (isset($_GET['idRecette'])) {

    $idRecette = $_GET['idRecette'];

    //Création du pdf A4
    $pdf = new PDF('P', 'mm', 'A4');

    $recette = new Recette();
    $recette = $recette->getRecipe($idRecette);

    // Définir alias pour nombre de pages
    $pdf->AliasNbPages();
    $pdf->AddPage();

    //Image de la recette
    $idRecette = $recette->idRecette;
    $imageFile = glob('../imageRecipe/' . $idRecette . '.*'); //Récupère le chemin complet vers fichier, avec son extension (extension inconnue)
    $pdf->Image($imageFile[0], 150, 5, 50);

    //Titre de la recette body
    $pdf->SetXY(10, 45);
    $pdf->SetFont('Arial', 'B', 25);
    $pdf->SetFillColor(245, 245, 245);
    $pdf->MultiCell(0, 8, iconv('UTF-8', 'windows-1252', htmlspecialchars($recette->titre)), 0, 'C', true); //iconv pour afficher correctement les caractères spéciaux

    //Histoire de la recette
    $yHistoire = $pdf->GetY();
    $pdf->SetXY(10, $yHistoire + 5);
    $pdf->SetFont('Arial', 'I', 10);
    $recetteHistoire = htmlspecialchars($recette->histoire);
    $pdf->MultiCell(0, 4, iconv('UTF-8', 'windows-1252', (htmlspecialchars($recetteHistoire))), 0, 'L', false);

    //Pays
    $yPays = $pdf->GetY();
    $pdf->SetXY(10, $yPays + 2);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Write(10, iconv('UTF-8', 'windows-1252', 'Continent : ' . htmlspecialchars($recette->libContinent)));

    //Pays
    $yContinent = $pdf->GetY();
    $pdf->SetXY(10, $yContinent + 5);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Write(10, iconv('UTF-8', 'windows-1252', 'Pays : ' . htmlspecialchars($recette->libPays)));

    //Liste des ingrédients
    $yTitreIngredients = $pdf->GetY();
    $pdf->SetXY(10, $yTitreIngredients + 10);
    $pdf->SetFont('Arial', 'U', 14);
    $pdf->Write(10, iconv('UTF-8', 'windows-1252', 'Liste des ingrédients pour ' . htmlspecialchars($recette->nbPersonnes) . ' personnes'));
    $contenirIngredients = new Contenir();
    $ingredientsRecette = $contenirIngredients->getIngredientsRecipe($idRecette);
    $yListIngredients = $pdf->GetY();
    $pdf->setY($yListIngredients + 1.5);
    foreach ($ingredientsRecette as $ingredient) {
        $quantite = htmlspecialchars($ingredient->quantite);
        $idUniteMesure = $ingredient->idUniteMesure;
        $libUniteMesure = $ingredient->libUniteMesure;
        $libIngredient = htmlspecialchars($ingredient->libIngredient);
        $yIngredient = $pdf->GetY() + 5;
        $pdf->SetXY(10, $yIngredient);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Write(10, iconv('UTF-8', 'windows-1252', htmlspecialchars($quantite) . ' ' . htmlspecialchars($libUniteMesure) . ' ' . htmlspecialchars($libIngredient)));
    }

    //Etapes de la recette
    $yTitreEtapes = $pdf->getY() + 12;
    $pdf->setY($yTitreEtapes);
    $pdf->SetFont('Arial', 'U', 14);
    $pdf->Write(10, iconv('UTF-8', 'windows-1252', 'Préparation'));
    $etapes = new Etape();
    $etapes = $etapes->getEtapesRecipe($idRecette);
    $listEtapes = $pdf->GetY();
    $pdf->setY($listEtapes + 8);
    foreach ($etapes as $etape) {
        $libEtape = htmlspecialchars($etape->libEtape);
        $yEtape = $pdf->GetY() + 2;
        $pdf->SetXY(10, $yEtape);
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(0, 4, iconv('UTF-8', 'windows-1252', (htmlspecialchars($libEtape))), 0, 'L', false);
    }

    //Titre recette pied de page
    $pdf->setTitreRecette(iconv('UTF-8', 'windows-1252', htmlspecialchars($recette->titre)));

    $pdf->Output();
}
