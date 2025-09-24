<?php
// Mail Debug - Nur für Entwicklung verwenden, dann löschen!

if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
}

echo "Environment Variables Debug:\n";
echo "MAIL_HOST: " . ($_ENV['MAIL_HOST'] ?? 'not set') . "\n";
echo "MAIL_USERNAME: " . ($_ENV['MAIL_USERNAME'] ?? 'not set') . "\n";
echo "MAIL_PASSWORD: " . (empty($_ENV['MAIL_PASSWORD']) ? 'not set' : '***set***') . "\n";
echo "PHPMailer available: " . (class_exists('PHPMailer\\PHPMailer\\PHPMailer') ? 'YES' : 'NO') . "\n";

// Test SMTP Connection
if (!empty($_ENV['MAIL_HOST']) && !empty($_ENV['MAIL_USERNAME'])) {
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_USERNAME'];
        $mail->Password = $_ENV['MAIL_PASSWORD'] ?? '';
        $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = intval($_ENV['MAIL_PORT'] ?? 587);
        $mail->SMTPDebug = 2; // Enable verbose debug output

        // Test connection
        if ($mail->smtpConnect()) {
            echo "SMTP Connection: SUCCESS\n";
            $mail->smtpClose();
        } else {
            echo "SMTP Connection: FAILED\n";
        }

    } catch (\PHPMailer\PHPMailer\Exception $e) {
        echo "SMTP Error: " . $e->getMessage() . "\n";
    }
} else {
    echo "SMTP not configured\n";
}

echo "\nPHP Error Log (last 10 lines):\n";
if (file_exists('logs/contact_errors.txt')) {
    $lines = file('logs/contact_errors.txt');
    $lastLines = array_slice($lines, -10);
    foreach ($lastLines as $line) {
        echo $line;
    }
}
?>