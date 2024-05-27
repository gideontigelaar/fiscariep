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

$printLayout = $_POST['printLayout'] ?? '';
$printAmount = $_POST['printAmount'] ?? '';
$paperAmount = $_POST['paperAmount'] ?? '';
$doubleSided = $_POST['doubleSided'] ?? '';
$printColor = $_POST['printColor'] ?? '';
$paperColor = $_POST['paperColor'] ?? '';
$coverColor = $_POST['coverColor'] ?? '';
$paperWeight = $_POST['paperWeight'] ?? '';
$staple = $_POST['staple'] ?? '';
$additionalWishes = $_POST['additionalWishes'] ?? '';

if (empty($printLayout) || empty($printAmount) || empty($paperAmount) || empty($paperColor) || empty($paperWeight)) {
    sendError('Alle verplichte velden zijn verplicht.');
}

if (!in_array($printLayout, ['A3', 'A4', 'A5', 'A4-alt', 'A5-alt'])) {
    sendError('Drukwerk layout is niet geldig.');
}

if (!is_numeric($printAmount) || $printAmount < 1) {
    sendError('Aantal exemplaren is niet geldig.');
}

if (!is_numeric($paperAmount) || $paperAmount < 1) {
    sendError('Aantal papieren per exemplaar is niet geldig.');
}

if (!is_numeric($paperWeight) || $paperWeight < 1) {
    sendError('Gewicht papier is niet geldig.');
}

if (!in_array($doubleSided, ['true', 'false'])) {
    sendError('Dubbelzijdig afdrukken is niet geldig.');
}

if (!in_array($printColor, ['true', 'false'])) {
    sendError('Gekleurd afdrukken is niet geldig.');
}

if (!in_array($staple, ['true', 'false'])) {
    sendError('Geniette afdruk is niet geldig.');
}

if (!empty($_FILES['uploadPrint']) && $_FILES['uploadPrint']['error'] === UPLOAD_ERR_OK) {
    $uploadPrint = file_get_contents($_FILES['uploadPrint']['tmp_name']);
} else {
    sendError('Upload PDF is verplicht.');
}

if ($_FILES['uploadPrint']['size'] > 2097152) {
    sendError('Bestand is te groot.');
}

$stmt = $pdo->prepare("INSERT INTO prints (user_id, print_layout, print_amount, paper_amount, double_sided, print_color, paper_color, cover_color, paper_weight, staple, upload_print, additional_wishes) VALUES (:user_id, :print_layout, :print_amount, :paper_amount, :double_sided, :print_color, :paper_color, :cover_color, :paper_weight, :staple, :upload_print, :additional_wishes)");
$stmt->execute([ 'user_id' => $_SESSION['user_id'], 'print_layout' => $printLayout, 'print_amount' => $printAmount, 'paper_amount' => $paperAmount, 'double_sided' => $doubleSided, 'print_color' => $printColor, 'paper_color' => $paperColor, 'cover_color' => $coverColor, 'paper_weight' => $paperWeight, 'staple' => $staple, 'upload_print' => $uploadPrint, 'additional_wishes' => $additionalWishes
]);

sendSuccess();
?>