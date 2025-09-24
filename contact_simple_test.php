<?php
session_start();
header('Content-Type: application/json');

// Simple test - no fancy features
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get basic data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

// Basic validation
if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Alle Felder sind erforderlich']);
    exit;
}

// Create logs directory
if (!is_dir('logs')) {
    mkdir('logs', 0755, true);
}

// Always log the attempt
$log = date('Y-m-d H:i:s') . " - Simple test from: $email\n";
file_put_contents('logs/simple_test.txt', $log, FILE_APPEND | LOCK_EX);

// Try to send email with PHPMailer if available
$mail_sent = false;

if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';

    $smtp_host = $_ENV['MAIL_HOST'] ?? '';
    $smtp_user = $_ENV['MAIL_USERNAME'] ?? '';
    $smtp_pass = $_ENV['MAIL_PASSWORD'] ?? '';

    if (!empty($smtp_host) && !empty($smtp_user)) {
        try {
            $mail = new \PHPMailer\PHPMailer\PHPMailer(false);
            $mail->isSMTP();
            $mail->Host = $smtp_host;
            $mail->SMTPAuth = true;
            $mail->Username = $smtp_user;
            $mail->Password = $smtp_pass;
            $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($smtp_user, 'Test Form');
            $mail->addAddress($smtp_user);
            $mail->addReplyTo($email, $name);

            $mail->Subject = 'Test from: ' . $name;
            $mail->Body = "Name: $name\nEmail: $email\nMessage: $message";

            $mail_sent = $mail->send();

        } catch (Exception $e) {
            file_put_contents('logs/simple_test.txt', "Error: " . $e->getMessage() . "\n", FILE_APPEND);
        }
    }
}

// Log result
file_put_contents('logs/simple_test.txt', "Mail sent: " . ($mail_sent ? 'YES' : 'NO') . "\n", FILE_APPEND);

// Always return success for now
echo json_encode(['success' => true, 'message' => 'Test completed']);
?>