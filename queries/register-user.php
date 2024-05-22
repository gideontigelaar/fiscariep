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

$userName = $_POST['username'] ?? '';
$email = strtolower($_POST['email']) ?? '';
$password = $_POST['password'] ?? '';
$passwordConfirm = $_POST['confirmPassword'] ?? '';

if (empty($userName) || empty($email) || empty($password) || empty($passwordConfirm)) {
    sendError('Alle velden zijn verplicht.');
}

if (strlen($userName) < 3 || strlen($userName) > 15 || !ctype_alnum($userName)) {
    sendError('De gebruikersnaam voldoet niet aan de verplichte criteria.');
}

$stmt = $pdo->prepare("SELECT username FROM users WHERE username = :username");
$stmt->execute(['username' => $userName]);
if ($stmt->fetch(PDO::FETCH_ASSOC)) {
    sendError('Gebruikersnaam is al bezet.');
}

if (strlen($email) > 100 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    sendError('E-mailadres is niet geldig.');
}

$stmt = $pdo->prepare("SELECT email FROM users WHERE email = :email");
$stmt->execute(['email' => $email]);
if ($stmt->fetch(PDO::FETCH_ASSOC)) {
    sendError('Dit e-mailadres is al in gebruik.');
}

if ($password !== $passwordConfirm) {
    sendError('Wachtwoorden komen niet overeen.');
}

if (strlen($password) > 255) {
    sendError('Wachtwoord is te lang.');
}

if (!preg_match('/^(?=.*[a-z])(?=.*[0-9]).{8,}$/', $password)) {
    sendError('Het wachtwoord voldoet niet aan de verplichte criteria.');
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)");
$stmt->execute(['username' => $userName, 'email' => $email, 'password' => $hashedPassword, 'role' => 'user']);

sendSuccess();
?>