<?php
try {
    $creds = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/creds.json"), true);
    $dbhost = $creds['dbhost'];
    $dbname = $creds['dbname'];
    $dbuser = $creds['dbuser'];
    $dbpass = $creds['dbpass'];

    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo "Er is een fout opgetreden. Probeer het later opnieuw.";
    exit();
}
?>