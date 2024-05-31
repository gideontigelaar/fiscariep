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

$userName = htmlspecialchars($_POST['username']) ?? '';
$email = strtolower($_POST['email']) ?? '';
$address = htmlspecialchars($_POST['address']) ?? '';
$postal_code = htmlspecialchars($_POST['postal_code']) ?? '';
$city = htmlspecialchars($_POST['city']) ?? '';
$province = htmlspecialchars($_POST['province']) ?? '';
$country = htmlspecialchars($_POST['country']) ?? '';
$phone_number = htmlspecialchars($_POST['phone_number']) ?? '';

if (empty($userName) || empty($email)) {
    sendError('Gebruikersnaam en e-mailadres zijn verplicht.');
}

if (strlen($userName) < 3 || strlen($userName) > 15 || !ctype_alnum($userName)) {
    sendError('De gebruikersnaam voldoet niet aan de verplichte criteria.');
}

$stmt = $pdo->prepare("SELECT username FROM users WHERE username = :username AND user_id != :user_id");
$stmt->execute(['username' => $userName, 'user_id' => $_SESSION['user_id']]);
if ($stmt->fetch(PDO::FETCH_ASSOC)) {
    sendError('Gebruikersnaam is al bezet.');
}

if (strlen($email) > 100 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    sendError('E-mailadres is niet geldig.');
}

$stmt = $pdo->prepare("SELECT email FROM users WHERE email = :email AND user_id != :user_id");
$stmt->execute(['email' => $email, 'user_id' => $_SESSION['user_id']]);
if ($stmt->fetch(PDO::FETCH_ASSOC)) {
    sendError('Dit e-mailadres is al in gebruik.');
}

$stmt = $pdo->prepare("UPDATE users SET username = :username, email = :email, address = :address, postal_code = :postal_code, city = :city, province = :province, country = :country, phone_number = :phone_number WHERE user_id = :user_id");
$stmt->execute(['username' => $userName, 'email' => $email, 'address' => $address, 'postal_code' => $postal_code, 'city' => $city, 'province' => $province, 'country' => $country, 'phone_number' => $phone_number, 'user_id' => $_SESSION['user_id']]);

sendSuccess();
?>