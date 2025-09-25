<?php
// Schneller Test ob mail() funktioniert
echo "PHP mail() Test:\n";
echo "================\n\n";

// Check if mail function exists
if (function_exists('mail')) {
    echo "✓ mail() Funktion ist verfügbar\n";

    // Test mail send
    $to = 'test@example.com';
    $subject = 'Test Mail';
    $message = 'Dies ist ein Test';
    $headers = 'From: noreply@test.com';

    $result = mail($to, $subject, $message, $headers);

    if ($result) {
        echo "✓ mail() Aufruf war erfolgreich\n";
    } else {
        echo "✗ mail() Aufruf fehlgeschlagen\n";
    }

} else {
    echo "✗ mail() Funktion ist NICHT verfügbar\n";
}

// Check sendmail path
$sendmail_path = ini_get('sendmail_path');
echo "Sendmail Path: " . ($sendmail_path ?: 'Nicht gesetzt') . "\n";

// Check SMTP settings
echo "SMTP Host: " . (ini_get('SMTP') ?: 'Nicht gesetzt') . "\n";
echo "SMTP Port: " . (ini_get('smtp_port') ?: 'Nicht gesetzt') . "\n";

echo "\nFertig!\n";
?>