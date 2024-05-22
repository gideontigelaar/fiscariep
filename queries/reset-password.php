<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/queries/pdo-connect.php";

function sendError($message) {
    header('Content-Type: application/json');
    http_response_code(400);
    echo json_encode(['error' => $message]);
    exit();
}

function sendSuccess() {
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode(['success' => true]);
    exit();
}

$token = $_POST['token'] ?? '';
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirmPassword'] ?? '';

if (empty($token) || empty($password) || empty($confirmPassword)) {
    sendError('Alle velden zijn verplicht.');
}

if ($password !== $confirmPassword) {
    sendError('Wachtwoorden komen niet overeen.');
}

if (strlen($password) > 255) {
    sendError('Wachtwoord is te lang.');
}

if (!preg_match('/^(?=.*[a-z])(?=.*[0-9]).{8,}$/', $password)) {
    sendError('Het wachtwoord voldoet niet aan de verplichte criteria.');
}

$stmt = $pdo->prepare("SELECT token, expires_at FROM reset_password WHERE token = :token AND expires_at > NOW()");
$stmt->execute(['token' => $token]);
$resetPassword = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$resetPassword) {
    sendError('Ongeldige token.');
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("UPDATE users SET password = :password WHERE user_id = (SELECT user_id FROM reset_password WHERE token = :token)");
$stmt->execute(['password' => $hashedPassword, 'token' => $token]);

$stmt = $pdo->prepare("DELETE FROM reset_password WHERE token = :token");
$stmt->execute(['token' => $token]);

sendSuccess();
?>