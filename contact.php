<?php
session_start();

// Security headers
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');

// CORS headers for local development (restrict in production)
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: POST');
//header('Access-Control-Allow-Headers: Content-Type');

// Rate limiting setup
if (!isset($_SESSION['last_submission'])) {
    $_SESSION['last_submission'] = 0;
}
if (!isset($_SESSION['submission_count'])) {
    $_SESSION['submission_count'] = 0;
    $_SESSION['count_reset_time'] = time();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// CSRF Protection
if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Sicherheitsfehler. Seite neu laden.']);
    exit;
}

// Rate limiting (max 3 submissions per 10 minutes)
if (time() - $_SESSION['count_reset_time'] > 600) {
    $_SESSION['submission_count'] = 0;
    $_SESSION['count_reset_time'] = time();
}

if ($_SESSION['submission_count'] >= 3) {
    http_response_code(429);
    echo json_encode(['success' => false, 'message' => 'Zu viele Anfragen. Bitte warten Sie 10 Minuten.']);
    exit;
}

// Minimum time between submissions (10 seconds)
if (time() - $_SESSION['last_submission'] < 10) {
    http_response_code(429);
    echo json_encode(['success' => false, 'message' => 'Bitte warten Sie 10 Sekunden zwischen Anfragen.']);
    exit;
}

// Get form data
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');
$honeypot = $_POST['website'] ?? ''; // Honeypot field

// Honeypot spam protection
if (!empty($honeypot)) {
    // Log potential spam attempt
    $spam_log = date('Y-m-d H:i:s') . " - Spam attempt from IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
    file_put_contents('logs/spam_log.txt', $spam_log, FILE_APPEND | LOCK_EX);

    // Return success to fool bots
    echo json_encode(['success' => true, 'message' => 'Nachricht erfolgreich gesendet']);
    exit;
}

// Validate input
$errors = [];

// Enhanced validation
if (empty($name)) {
    $errors[] = 'Name ist erforderlich';
} elseif (strlen($name) > 100) {
    $errors[] = 'Name ist zu lang (max. 100 Zeichen)';
} elseif (preg_match('/[<>"\']/', $name)) {
    $errors[] = 'Name enthält ungültige Zeichen';
}

if (empty($email)) {
    $errors[] = 'E-Mail ist erforderlich';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Ungültige E-Mail-Adresse';
} elseif (strlen($email) > 254) {
    $errors[] = 'E-Mail-Adresse ist zu lang';
}

if (empty($message)) {
    $errors[] = 'Nachricht ist erforderlich';
} elseif (strlen($message) > 2000) {
    $errors[] = 'Nachricht ist zu lang (max. 2000 Zeichen)';
} elseif (preg_match('/(https?:\/\/|www\.|\[url|\[link)/i', $message)) {
    $errors[] = 'Links sind in der Nachricht nicht erlaubt';
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
$to = 'garschke@gmx.de'; // Development email, change to info@ewi-britz.de for production
//$to = 'EWI-Britz@t-online.de';
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

// Try to send email (simulate success for local development)
//$mail_sent = true; // Set to mail() function for production
$mail_sent = mail($to, $subject, $email_content, implode("\r\n", $headers));

if ($mail_sent) {
    // Update rate limiting counters
    $_SESSION['last_submission'] = time();
    $_SESSION['submission_count']++;

    // Log successful submission with more details (and email content for dev)
    $log_entry = date('Y-m-d H:i:s') . " - Contact form submission from: {$email}, IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
    $log_entry .= "Name: {$name}\n";
    $log_entry .= "Message: " . substr($message, 0, 200) . "\n";
    $log_entry .= "---\n";
    file_put_contents('logs/contact_log.txt', $log_entry, FILE_APPEND | LOCK_EX);

    echo json_encode(['success' => true, 'message' => 'Nachricht erfolgreich gesendet']);
} else {
    // Log failed submission with more details
    $error_log = date('Y-m-d H:i:s') . " - Failed to send email from: {$email}, IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
    file_put_contents('logs/contact_errors.txt', $error_log, FILE_APPEND | LOCK_EX);

    echo json_encode(['success' => false, 'message' => 'Fehler beim Senden der E-Mail']);
}
?>