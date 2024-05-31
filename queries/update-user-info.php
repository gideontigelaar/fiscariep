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

$address = $_POST['address'] ?? '';
$postal_code = $_POST['postal_code'] ?? '';
$city = $_POST['city'] ?? '';
$province = $_POST['province'] ?? '';
$country = $_POST['country'] ?? '';
$phone_number = $_POST['phone_number'] ?? '';

if (empty($address) || empty($postal_code) || empty($city) || empty($province) || empty($country) || empty($phone_number)) {
    sendError('Alle velden zijn verplicht.');
}

$stmt = $pdo->prepare("UPDATE users SET address = :address, postal_code = :postal_code, city = :city, province = :province, country = :country, phone_number = :phone_number WHERE user_id = :user_id");
$stmt->execute(['address' => $address, 'postal_code' => $postal_code, 'city' => $city, 'province' => $province, 'country' => $country, 'phone_number' => $phone_number, 'user_id' => $_SESSION['user_id']]);
sendSuccess();
?>