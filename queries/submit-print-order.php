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
$coverPrintColor = $_POST['coverPrintColor'] ?? '';
$paperColor = $_POST['paperColor'] ?? '';
$coverColor = $_POST['coverColor'] ?? '';
$paperWeight = $_POST['paperWeight'] ?? '';
$staple = $_POST['staple'] ?? '';
$additionalWishes = htmlspecialchars($_POST['additionalWishes'] ?? '');

if (empty($printAmount) || empty($paperAmount) || empty($paperWeight)) {
    sendError('Alle velden zijn verplicht.');
}

if (!is_numeric($printAmount) || $printAmount < 1 || empty($printAmount)) {
    sendError('Aantal exemplaren is niet geldig.');
}

if (!is_numeric($paperAmount) || $paperAmount < 1 || empty($paperAmount)) {
    sendError('Aantal papieren per exemplaar is niet geldig.');
}

if (!is_numeric($paperWeight) || $paperWeight < 1 || empty($paperWeight)) {
    sendError('Gewicht papier is niet geldig.');
}

if ($additionalWishes && strlen($additionalWishes) > 200) {
    sendError('Aanvullende wensen mogen maximaal 200 tekens bevatten.');
}

if (!empty($_FILES['uploadPrint']) && $_FILES['uploadPrint']['error'] === UPLOAD_ERR_OK) {
    $uploadPrint = file_get_contents($_FILES['uploadPrint']['tmp_name']);
} else {
    sendError('Upload PDF is verplicht.');
}

if ($_FILES['uploadPrint']['size'] > 2097152) {
    sendError('Bestand is te groot.');
}

$stmt = $pdo->prepare("INSERT INTO prints (user_id, print_layout, print_amount, paper_amount, double_sided, print_color, cover_print_color, paper_color, cover_color, paper_weight, staple, upload_print, additional_wishes) VALUES (:user_id, :print_layout, :print_amount, :paper_amount, :double_sided, :print_color, :cover_print_color, :paper_color, :cover_color, :paper_weight, :staple, :upload_print, :additional_wishes)");
$stmt->execute([ 'user_id' => $_SESSION['user_id'], 'print_layout' => $printLayout, 'print_amount' => $printAmount, 'paper_amount' => $paperAmount, 'double_sided' => $doubleSided, 'print_color' => $printColor, 'cover_print_color' => $coverPrintColor, 'paper_color' => $paperColor, 'cover_color' => $coverColor, 'paper_weight' => $paperWeight, 'staple' => $staple, 'upload_print' => $uploadPrint, 'additional_wishes' => $additionalWishes
]);

sendSuccess();
?>