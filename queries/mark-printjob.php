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

$orderID = $_POST['orderID'];

$stmt = $pdo->prepare("UPDATE prints SET status = 'afgerond' WHERE order_id = :orderID");
$stmt->execute(['orderID' => $orderID]);

sendSuccess();
?>