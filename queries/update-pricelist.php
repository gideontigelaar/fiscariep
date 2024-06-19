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

$printLayout = str_replace(',', '.', number_format($_POST['printLayout'], 2));
$printAmount = str_replace(',', '.', number_format($_POST['printAmount'], 2));
$paperAmount = str_replace(',', '.', number_format($_POST['paperAmount'], 2));
$doubleSided = str_replace(',', '.', number_format($_POST['doubleSided'], 2));
$printColor = str_replace(',', '.', number_format($_POST['printColor'], 2));
$coverPrintColor = str_replace(',', '.', number_format($_POST['coverPrintColor'], 2));
$paperColor = str_replace(',', '.', number_format($_POST['paperColor'], 2));
$coverColor = str_replace(',', '.', number_format($_POST['coverColor'], 2));
$paperWeight = str_replace(',', '.', number_format($_POST['paperWeight'], 2));
$stapledPrint = str_replace(',', '.', number_format($_POST['stapledPrint'], 2));
$additionalWishes = str_replace(',', '.', number_format($_POST['additionalWishes'], 2));

if (empty($printLayout) || empty($printAmount) || empty($paperAmount) || empty($doubleSided) || empty($printColor) || empty($coverPrintColor) || empty($paperColor) || empty($coverColor) || empty($paperWeight) || empty($stapledPrint) || empty($additionalWishes)) {
    sendError('Alle velden zijn verplicht.');
}

// check if each value is a number, and if its max 3 digits long before the comma
if (!preg_match('/^\d{1,3}(\.\d{1,2})?$/', $printLayout) || !preg_match('/^\d{1,3}(\.\d{1,2})?$/', $printAmount) || !preg_match('/^\d{1,3}(\.\d{1,2})?$/', $paperAmount) || !preg_match('/^\d{1,3}(\.\d{1,2})?$/', $doubleSided) || !preg_match('/^\d{1,3}(\.\d{1,2})?$/', $printColor) || !preg_match('/^\d{1,3}(\.\d{1,2})?$/', $coverPrintColor) || !preg_match('/^\d{1,3}(\.\d{1,2})?$/', $paperColor) || !preg_match('/^\d{1,3}(\.\d{1,2})?$/', $coverColor) || !preg_match('/^\d{1,3}(\.\d{1,2})?$/', $paperWeight) || !preg_match('/^\d{1,3}(\.\d{1,2})?$/', $stapledPrint)) {
    sendError('De waarde is te groot of geen geldig getal.');
}

if ($printLayout < 0 || $printAmount < 0 || $paperAmount < 0 || $doubleSided < 0 || $printColor < 0 || $coverPrintColor < 0 || $paperColor < 0 || $coverColor < 0 || $paperWeight < 0 || $stapledPrint < 0) {
    sendError('Alle velden moeten positief zijn.');
}

$stmt = $pdo->prepare("INSERT INTO pricelist (print_layout, print_amount, paper_amount, double_sided, print_color, cover_print_color, paper_color, cover_color, paper_weight, staple, additional_wishes) VALUES (:print_layout, :print_amount, :paper_amount, :double_sided, :print_color, :cover_print_color, :paper_color, :cover_color, :paper_weight, :staple, :additional_wishes)");
$stmt->execute([ 'print_layout' => $printLayout, 'print_amount' => $printAmount, 'paper_amount' => $paperAmount, 'double_sided' => $doubleSided, 'print_color' => $printColor, 'cover_print_color' => $coverPrintColor, 'paper_color' => $paperColor, 'cover_color' => $coverColor, 'paper_weight' => $paperWeight, 'staple' => $stapledPrint, 'additional_wishes' => $additionalWishes
]);

sendSuccess();
?>