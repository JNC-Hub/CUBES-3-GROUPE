<?php
require('fpdf/fpdf.php');

// Vérifier si le format demandé est PDF
if (isset($_GET['format']) && $_GET['format'] == 'pdf') {
    // Créer une instance de la classe FPDF
    $pdf = new FPDF();

    // Ajouter une page
    $pdf->AddPage();

    // Écrire du texte dans le PDF
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Contenu du PDF');

    // Envoyer le PDF au navigateur
    $pdf->Output();
} else {
    // Afficher la page au format HTML
    echo '<a href="page.php?format=pdf">Afficher au format PDF</a>';
}
?>

<!-- Afficher le bouton pour télécharger le PDF, 
Copier le code si dessous à l'endroit du bouton -->
<!-- 
    <form method="post" action="index.php?controller=PdfController&action=generatePdf">
    <input type="submit" value="Télécharger le PDF">
</form> 
-->