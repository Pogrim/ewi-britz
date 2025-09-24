<?php
// Alternative contact.php mit PHPMailer
// Ersetze den mail() Aufruf durch:

/*
// Prüfe ob PHPMailer verfügbar ist
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.your-provider.com'; // SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your-email@ewi-britz.de';
        $mail->Password   = 'your-password';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('noreply@ewi-britz.de', 'EWI Britz Website');
        $mail->addAddress($to);
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(false);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body    = $email_content;

        $mail_sent = $mail->send();

    } catch (Exception $e) {
        $mail_sent = false;
        error_log("PHPMailer Error: {$mail->ErrorInfo}");
    }
} else {
    // Fallback zur normalen mail() Funktion
    $mail_sent = mail($to, $subject, $email_content, implode("\r\n", $headers));
}
*/
?>