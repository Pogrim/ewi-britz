<?php
// Schritt-für-Schritt Debug
session_start();
echo "1";

header('Content-Type: application/json');
echo "2";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}
echo "3";

// CSRF Check
if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token'])) {
    echo json_encode(['success' => false, 'message' => 'CSRF fehlt']);
    exit;
}
echo "4";

if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    echo json_encode(['success' => false, 'message' => 'CSRF invalid']);
    exit;
}
echo "5";

echo json_encode(['success' => true, 'message' => 'Bis hier gekommen']);
?>