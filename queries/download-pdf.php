<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/queries/validate-session.php";

if (isset($_POST['orderID'])) {
    $orderID = $_POST['orderID'];

    $stmt = $pdo->prepare("SELECT upload_print FROM prints WHERE order_id = :orderID");
    $stmt->execute(['orderID' => $orderID]);
    $print = $stmt->fetch();

    if ($print) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="order_'.$orderID.'.pdf"');
        echo $print['upload_print'];
        exit();
    } else {
        echo "PDF not found!";
    }
} else {
    echo "Invalid request!";
}