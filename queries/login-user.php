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

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    sendError('Alle velden zijn verplicht.');
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute(['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user['password'])) {
    sendError('Ongeldig e-mailadres of wachtwoord.');
}

$sessionToken = bin2hex(random_bytes(32));
$hashedSessionToken = hash('sha256', $sessionToken);

$stmt = $pdo->prepare("INSERT INTO sessions (session_token, user_id, user_agent, ip_address) VALUES (:session_token, :user_id, :user_agent, :ip_address)");
$stmt->execute(['session_token' => $hashedSessionToken, 'user_id' => $user['user_id'], 'user_agent' => $_SERVER['HTTP_USER_AGENT'], 'ip_address' => $_SERVER['REMOTE_ADDR']]);

$expirationTime = strtotime('+1 month');
setcookie('session_token', $sessionToken, $expirationTime, "/");
sendSuccess();
?>