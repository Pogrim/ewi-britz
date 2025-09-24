<?php
// Simple mail test
$to = 'garschke@gmx.de';
$subject = 'Mail Test von EWI-Britz Server';
$message = 'Dies ist ein Test der mail() Funktion vom Server.';
$headers = [
    'From: noreply@ewi-britz.de',
    'Content-Type: text/plain; charset=UTF-8'
];

if (mail($to, $subject, $message, implode("\r\n", $headers))) {
    echo "Mail erfolgreich gesendet!";
} else {
    echo "Mail konnte nicht gesendet werden.";
}

// Server info
echo "<br><br>PHP Version: " . phpversion();
echo "<br>Sendmail path: " . ini_get('sendmail_path');
echo "<br>SMTP: " . ini_get('SMTP');
echo "<br>smtp_port: " . ini_get('smtp_port');
?>