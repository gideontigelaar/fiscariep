<?php
session_start();
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

$oldPassword = $_POST['oldPassword'] ?? '';
$newPassword = $_POST['newPassword'] ?? '';
$confirmPassword = $_POST['confirmPassword'] ?? '';

if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
    sendError('Alle velden zijn verplicht.');
}

if ($newPassword !== $confirmPassword) {
    sendError('De wachtwoorden komen niet overeen.');
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");
$stmt->execute(['user_id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($oldPassword, $user['password'])) {
    sendError('Huidig wachtwoord is onjuist.');
}

$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("UPDATE users SET password = :password WHERE user_id = :user_id");
$stmt->execute(['password' => $hashedPassword, 'user_id' => $_SESSION['user_id']]);

sendSuccess();
?>