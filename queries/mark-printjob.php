<?php
require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/queries/pdo-connect.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

$stmt = $pdo->prepare("SELECT email FROM users WHERE user_id = (SELECT user_id FROM prints WHERE order_id = :orderID)");
$stmt->execute(['orderID' => $orderID]);
$email = $stmt->fetch(PDO::FETCH_ASSOC)['email'];

$stmt = $pdo->prepare("SELECT * FROM prints WHERE order_id = :orderID");
$stmt->execute(['orderID' => $orderID]);
$print = $stmt->fetch(PDO::FETCH_ASSOC);

$mail = new PHPMailer(true);

try {
    $stmt = $pdo->prepare("UPDATE prints SET status = 'afgerond' WHERE order_id = :orderID");
    $stmt->execute(['orderID' => $orderID]);

    $creds = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/creds.json"), true);

    $mail->isSMTP();
    $mail->Host = $creds['mailhost'];
    $mail->SMTPAuth = true;
    $mail->Username = $creds['mailuser'];
    $mail->Password = $creds['mailpass'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $creds['mailport'];

    $mail->setFrom($creds['mailfrom'], 'Fiscariep');
    $mail->addAddress($email);
    $mail->addReplyTo($creds['mailfrom'], 'No Reply');

    $mail->isHTML(true);
    $mail->Subject = 'Printopdracht afgerond | Fiscariep';
    $mail->Body = '
    <html>
        <head>
        </head>
        <body style="background: linear-gradient(#F5F5F5, #dadaee);display: flex;place-content: center;height:750px;justify-content: center;border-radius:15px;">
            <div style="width: calc(100% - 30px);background-color: white;height: fit-content;align-self: center;text-align: center;border-radius: 15px;padding-top: 50px;padding-bottom: 50px;place-content:center;max-width:600px;margin:auto;">

            <h1 style="color:black;font-family: sans-serif;">Printopdracht afgerond</h1>

            <p style="color:black;margin-left:50px;margin-right:50px;font-family: sans-serif;">Je printopdracht (#' . $orderID . ') is afgerond en klaar om opgehaald te worden. Kom langs bij de balie om je printopdracht op te halen!</p>

            <p style="color:black;margin-left:50px;margin-right:50px;font-family: sans-serif;"><b>Ggegevens van de printopdracht:</b></p>

            <table style="margin:0 auto;font-family:sans-serif;">
                <tr>
                    <td style="padding:5px;text-align:left;">Aantal exemplaren:</td>
                    <td style="padding:5px;text-align:left;">' . $print['print_amount'] . ' exempla' . ($print['print_amount'] == 1 ? "ar" : "ren") . '</td>
                </tr>
                <tr>
                    <td style="padding:5px;text-align:left;">Aantal pagina\'s:</td>
                    <td style="padding:5px;text-align:left;">' . $print['paper_amount'] . ' papier' . ($print['paper_amount'] == 1 ? "" : "en") . '</td>
                </tr>
                <tr>
                    <td style="padding:5px;text-align:left;">Dubbelzijdig/enkelzijdig:</td>
                    <td style="padding:5px;text-align:left;">' . ($print['double_sided'] ? "Dubbelzijdig" : "Enkelzijdig") . '</td>
                </tr>
                <tr>
                    <td style="padding:5px;text-align:left;">Inktkleur:</td>
                    <td style="padding:5px;text-align:left;">' . ($print['print_color'] ? "Gekleurd" : "Zwart-wit") . '</td>
                </tr>
                <tr>
                    <td style="padding:5px;text-align:left;">Papierkleur:</td>
                    <td style="padding:5px;text-align:left;">' . ucfirst($print['paper_color']) . '</td>
                </tr>
                <tr>
                    <td style="padding:5px;text-align:left;">Gewicht papier:</td>
                    <td style="padding:5px;text-align:left;">' . $print['paper_weight'] . ' gram</td>
                </tr>
                <tr>
                    <td style="padding:5px;text-align:left;">Nietstatus:</td>
                    <td style="padding:5px;text-align:left;">' . ($print['staple'] == "geen" ? "Geen nietjes" : "Nietje " . $print['staple']) . '</td>
                </tr>
            </table>

            <a href="' . $_SERVER['HTTP_HOST'] . '/dashboard" style="text-decoration:none;"><button style="cursor:pointer;background-color: #2E3192;border: none;color: white;padding: 15px 32px;font-size: 16px;margin: 4px 2px;cursor: pointer;border-radius: 10px;">Bekijk printjob</button></a>

            <p style="font-family:sans-serif;width:100%;text-align:center;opacity:40%;color: black;margin-top: 30px;margin-bottom:-10px;">Verstuurd door Fiscariep.</p>
        </body>
    </html>
    ';

    $mail->send();
} catch (Exception $e) {
    sendError("Bericht kon niet worden verzonden. Probeer het later opnieuw.");
}

sendSuccess();
?>