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

$printLayout1 = str_replace(',', '.', number_format($_POST['printLayout1'], 2));
$printLayout2 = str_replace(',', '.', number_format($_POST['printLayout2'], 2));
$printLayout3 = str_replace(',', '.', number_format($_POST['printLayout3'], 2));
$printLayout4 = str_replace(',', '.', number_format($_POST['printLayout4'], 2));
$printLayout5 = str_replace(',', '.', number_format($_POST['printLayout5'], 2));
$printAmount = str_replace(',', '.', number_format($_POST['printAmount'], 2));
$paperAmount = str_replace(',', '.', number_format($_POST['paperAmount'], 2));
$doubleSided = str_replace(',', '.', number_format($_POST['doubleSided'], 2));
$printColor = str_replace(',', '.', number_format($_POST['printColor'], 2));
$coverPrintColor = str_replace(',', '.', number_format($_POST['coverPrintColor'], 2));
$paperColor = str_replace(',', '.', number_format($_POST['paperColor'], 2));
$coverColor = str_replace(',', '.', number_format($_POST['coverColor'], 2));
$paperWeight1 = str_replace(',', '.', number_format($_POST['paperWeight1'], 2));
$paperWeight2 = str_replace(',', '.', number_format($_POST['paperWeight2'], 2));
$paperWeight3 = str_replace(',', '.', number_format($_POST['paperWeight3'], 2));
$paperWeight4 = str_replace(',', '.', number_format($_POST['paperWeight4'], 2));
$stapledPrint = str_replace(',', '.', number_format($_POST['stapledPrint'], 2));

if (empty($printLayout1) || empty($printLayout2) || empty($printLayout3) || empty($printLayout4) || empty($printLayout5) || empty($printAmount) || empty($paperAmount) || empty($doubleSided) || empty($printColor) || empty($coverPrintColor) || empty($paperColor) || empty($coverColor) || empty($paperWeight1) || empty($paperWeight2) || empty($paperWeight3) || empty($paperWeight4) || empty($stapledPrint)) {
    sendError('Alle velden zijn verplicht.');
}

if (!is_numeric($printLayout1) || !is_numeric($printLayout2) || !is_numeric($printLayout3) || !is_numeric($printLayout4) || !is_numeric($printLayout5) || !is_numeric($printAmount) || !is_numeric($paperAmount) || !is_numeric($doubleSided) || !is_numeric($printColor) || !is_numeric($coverPrintColor) || !is_numeric($paperColor) || !is_numeric($coverColor) || !is_numeric($paperWeight1) || !is_numeric($paperWeight2) || !is_numeric($paperWeight3) || !is_numeric($paperWeight4) || !is_numeric($stapledPrint)) {
    sendError('De waarde is te groot of geen geldig getal.');
}

if ($printLayout1 < 0 || $printLayout2 < 0 || $printLayout3 < 0 || $printLayout4 < 0 || $printLayout5 < 0 || $printAmount < 0 || $paperAmount < 0 || $doubleSided < 0 || $printColor < 0 || $coverPrintColor < 0 || $paperColor < 0 || $coverColor < 0 || $paperWeight1 < 0 || $paperWeight2 < 0 || $paperWeight3 < 0 || $paperWeight4 < 0 || $stapledPrint < 0) {
    sendError('Alle velden moeten positief zijn.');
}

$stmt = $pdo->prepare("INSERT INTO pricelist (print_layout_1, print_layout_2, print_layout_3, print_layout_4, print_layout_5, paper_amount, double_sided, print_color, cover_print_color, paper_color, cover_color, paper_weight_1, paper_weight_2, paper_weight_3, paper_weight_4, staple) VALUES (:print_layout_1, :print_layout_2, :print_layout_3, :print_layout_4, :print_layout_5, :paper_amount, :double_sided, :print_color, :cover_print_color, :paper_color, :cover_color, :paper_weight_1, :paper_weight_2, :paper_weight_3, :paper_weight_4, :staple)");
$stmt->execute([ 'print_layout_1' => $printLayout1, 'print_layout_2' => $printLayout2, 'print_layout_3' => $printLayout3, 'print_layout_4' => $printLayout4, 'print_layout_5' => $printLayout5, 'paper_amount' => $paperAmount, 'double_sided' => $doubleSided, 'print_color' => $printColor, 'cover_print_color' => $coverPrintColor, 'paper_color' => $paperColor, 'cover_color' => $coverColor, 'paper_weight_1' => $paperWeight1, 'paper_weight_2' => $paperWeight2, 'paper_weight_3' => $paperWeight3, 'paper_weight_4' => $paperWeight4, 'staple' => $stapledPrint
]);

sendSuccess();
?>