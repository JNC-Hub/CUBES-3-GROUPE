<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require('fpdf.php');

class PdfController {
    public function generatePdf() {
        // Créer une nouvelle instance de la classe FPDF
        $pdf = new FPDF();

        // Ajouter une nouvelle page au document
        $pdf->AddPage();

        // Définir la police de caractères à utiliser
        $pdf->SetFont('Arial','B',16);

        // Ajouter du contenu
        $pdf->Cell(40,10,'Hello World!');

        // Envoyer le fichier PDF au navigateur pour téléchargement
        $pdf->Output('D', 'RecetteImprimable.pdf');
    }
}
?>

<!-- Afficher le bouton pour télécharger le PDF, 
Copier le code si dessous à l'endroit du bouton -->
<!-- 
    <form method="post" action="index.php?controller=PdfController&action=generatePdf">
    <input type="submit" value="Télécharger le PDF">
</form> 
-->