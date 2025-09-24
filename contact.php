<?php
header('Content-Type: application/json');

// CORS headers for local development
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get form data
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

// Validate input
$errors = [];

if (empty($name)) {
    $errors[] = 'Name ist erforderlich';
}

if (empty($email)) {
    $errors[] = 'E-Mail ist erforderlich';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Ungültige E-Mail-Adresse';
}

if (empty($message)) {
    $errors[] = 'Nachricht ist erforderlich';
}

if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// Sanitize input
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

// Email configuration
$to = 'info@ewi-britz.de'; // Change this to your email
$subject = 'Neue Kontaktanfrage von ' . $name;

// Email content
$email_content = "
Neue Kontaktanfrage über die Webseite

Name: {$name}
E-Mail: {$email}

Nachricht:
{$message}

---
Gesendet über das Kontaktformular von ewi-britz.de
Datum: " . date('d.m.Y H:i:s');

// Email headers
$headers = [
    'From: noreply@ewi-britz.de',
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion(),
    'Content-Type: text/plain; charset=UTF-8'
];

// Try to send email
$mail_sent = mail($to, $subject, $email_content, implode("\r\n", $headers));

if ($mail_sent) {
    // Log successful submission (optional)
    $log_entry = date('Y-m-d H:i:s') . " - Contact form submission from: {$email}\n";
    file_put_contents('contact_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
    
    echo json_encode(['success' => true, 'message' => 'Nachricht erfolgreich gesendet']);
} else {
    // Log failed submission (optional)
    $error_log = date('Y-m-d H:i:s') . " - Failed to send email from: {$email}\n";
    file_put_contents('contact_errors.txt', $error_log, FILE_APPEND | LOCK_EX);
    
    echo json_encode(['success' => false, 'message' => 'Fehler beim Senden der E-Mail']);
}
?>