<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../vendor/autoload.php';

function sendMail($to, $subject, $message) {

    $mail = new PHPMailer(true);


    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Change if using another provider
        $mail->SMTPAuth   = true;
        $mail->Username   = ''; //mail id sender
        $mail->Password   = ''; // Use app password, NOT your real password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        // Recipients
        $mail->setFrom('', 'VomyChat'); // Sender
        $mail->addAddress($to);


        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;
        
        // Send email

        // $mail->SMTPDebug = 2; // Set to 3 or 4 for more debugging
        // $mail->Debugoutput = 'html';

        $mail->send();
        
        return true;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}
?>
