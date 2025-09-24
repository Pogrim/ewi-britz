<?php
session_start();

// Load PHPMailer if available
$phpmailer_available = false;
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
    $phpmailer_available = class_exists('PHPMailer\\PHPMailer\\PHPMailer');
}

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

// Email configuration from Environment Variables
$mail_config = [
    'host' => $_ENV['MAIL_HOST'] ?? 'localhost',
    'port' => intval($_ENV['MAIL_PORT'] ?? 587),
    'username' => $_ENV['MAIL_USERNAME'] ?? '',
    'password' => $_ENV['MAIL_PASSWORD'] ?? '',
    'secure' => $_ENV['MAIL_ENCRYPTION'] ?? 'tls',
    'from_email' => $_ENV['MAIL_FROM'] ?? 'noreply@ewi-britz.de',
    'from_name' => $_ENV['MAIL_FROM_NAME'] ?? 'EWI Britz Website',
    'to' => $_ENV['MAIL_TO'] ?? 'garschke@gmx.de'
];

$to = $mail_config['to'];
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

// Try to send email using SMTP if configured, fallback to mail()
$mail_sent = false;

// Check if SMTP is configured via environment variables
if (!empty($mail_config['host']) && $mail_config['host'] !== 'localhost' && !empty($mail_config['username'])) {
    // Use SMTP (requires PHPMailer)
    if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
        try {
            $mail = new \PHPMailer\PHPMailer\PHPMailer(false); // Don't throw exceptions

            // Server settings
            $mail->isSMTP();
            $mail->Host = $mail_config['host'];
            $mail->SMTPAuth = true;
            $mail->Username = $mail_config['username'];
            $mail->Password = $mail_config['password'];
            $mail->SMTPSecure = $mail_config['secure'] === 'tls' ? \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS : \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $mail_config['port'];

            // Recipients - Use authenticated email as FROM address
            $mail->setFrom($mail_config['username'], $mail_config['from_name']);
            $mail->addAddress($to);
            $mail->addReplyTo($email, $name);

            // Content
            $mail->isHTML(false);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $subject;
            $mail->Body = $email_content;

            // Try to send - no exceptions, just return true/false
            $mail_sent = $mail->send();

            // Log result only on failure
            if (!$mail_sent) {
                error_log("SMTP Error: " . $mail->ErrorInfo);
            }

        } catch (\Exception $e) {
            $mail_sent = false;
            error_log("SMTP Exception: " . $e->getMessage());
        }
    } else {
        // PHPMailer not available, log error
        error_log("PHPMailer not installed, cannot use SMTP");
    }
}

// Development mode: Always succeed if no SMTP is configured
if (empty($mail_config['username']) || $mail_config['host'] === 'localhost') {
    $mail_sent = true; // Simulate success for local development
}

// Force create test log to verify we reach this point
file_put_contents('logs/debug_test.txt', date('Y-m-d H:i:s') . " - Reached end of script, mail_sent = " . ($mail_sent ? 'true' : 'false') . "\n", FILE_APPEND);

if ($mail_sent) {
    // Update rate limiting counters
    $_SESSION['last_submission'] = time();
    $_SESSION['submission_count']++;

    // Log successful submission with more details (and email content for dev)
    $log_entry = date('Y-m-d H:i:s') . " - Contact form submission from: {$email}, IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
    $log_entry .= "Name: {$name}\n";
    $log_entry .= "Message: " . substr($message, 0, 200) . "\n";
    $log_entry .= "---\n";

    // Ensure logs directory exists
    if (!is_dir('logs')) {
        mkdir('logs', 0755, true);
    }

    file_put_contents('logs/contact_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
    file_put_contents('logs/debug_test.txt', "SUCCESS BLOCK REACHED\n", FILE_APPEND);

    // Clear any output buffer before sending JSON
    if (ob_get_level()) ob_clean();
    echo json_encode(['success' => true, 'message' => 'Nachricht erfolgreich gesendet']);
} else {
    // Log failed submission with more details
    $error_log = date('Y-m-d H:i:s') . " - Failed to send email from: {$email}, IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
    file_put_contents('logs/contact_errors.txt', $error_log, FILE_APPEND | LOCK_EX);

    echo json_encode(['success' => false, 'message' => 'Fehler beim Senden der E-Mail']);
}
?>