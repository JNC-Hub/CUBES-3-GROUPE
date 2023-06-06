<?php
// Headers requis
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

// On vérifie que la méthode utilisée est correcte
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // On récupère les informations envoyées
    $pdf = $_FILES['pdf']; // Récupérer le fichier PDF
    $address = $_POST['address'];
    if (!empty($pdf) && !empty($address)) {
        error_log($address);
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Host = "smtp.gmail.com";
        $mail->Username = "lesvoyageursgourmandscesi@gmail.com";
        $mail->Password = "pilsxjdkpmcxcxui";
        $mail->IsHTML(true);
        $mail->AddAddress($address);

        $mail->SetFrom("lesvoyageursgourmandscesi@gmail.com", "LesVoyageurs Gourmands");

        $mail->addAttachment($pdf['tmp_name'], $pdf['name']);

        $mail->Subject = "Recette pâtissière";
        $subjectEncoded = mb_encode_mimeheader($mail->Subject, 'UTF-8', 'Q');
        $mail->Subject = $subjectEncoded;
        $content = "Ci joint vous trouverez la recette que vous voulez partager su site les voyageurs gourmands";
        $mail->MsgHTML($content);

        if (!$mail->Send()) {
            echo "Erreur lors de l'envoi de l'e-mail : " . $mail->ErrorInfo;
            error_log($mail->ErrorInfo);
        } else {
            echo "Email sent successfully";
        }
    }
}
