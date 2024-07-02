<?php
session_start();
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
$totalPrice = $_POST['totalPrice'] ?? '';

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

$stmt = $pdo->prepare("SELECT email FROM users WHERE role = 'admin'");
$stmt->execute();
$adminMails = $stmt->fetchAll(PDO::FETCH_ASSOC);

$mail = new PHPMailer(true);

$minus10Percent = number_format($totalPrice * 0.9, 2, ',', '');
$plus10Percent = number_format($totalPrice * 1.1, 2, ',', '');

try {
    $stmt = $pdo->prepare("INSERT INTO prints (user_id, print_layout, print_amount, paper_amount, double_sided, print_color, cover_print_color, paper_color, cover_color, paper_weight, staple, upload_print, additional_wishes, total_price) VALUES (:user_id, :print_layout, :print_amount, :paper_amount, :double_sided, :print_color, :cover_print_color, :paper_color, :cover_color, :paper_weight, :staple, :upload_print, :additional_wishes, :total_price)");
    $stmt->execute(['user_id' => $_SESSION['user_id'], 'print_layout' => $printLayout, 'print_amount' => $printAmount, 'paper_amount' => $paperAmount, 'double_sided' => $doubleSided, 'print_color' => $printColor, 'cover_print_color' => $coverPrintColor, 'paper_color' => $paperColor, 'cover_color' => $coverColor, 'paper_weight' => $paperWeight, 'staple' => $staple, 'upload_print' => $uploadPrint, 'additional_wishes' => $additionalWishes, 'total_price' => $totalPrice]);

    $creds = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/creds.json"), true);

    $mail->isSMTP();
    $mail->Host = $creds['mailhost'];
    $mail->SMTPAuth = true;
    $mail->Username = $creds['mailuser'];
    $mail->Password = $creds['mailpass'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $creds['mailport'];

    $mail->setFrom($creds['mailfrom'], 'Fiscariep');
    foreach ($adminMails as $adminMail) {
        $mail->addBcc($adminMail['email']);
    }
    $mail->addReplyTo($creds['mailfrom'], 'No Reply');

    $mail->isHTML(true);
    $mail->Subject = 'Nieuwe printopdracht | Fiscariep';
    $mail->Body = '
    <html>
        <head>
        </head>
        <body style="background: linear-gradient(#F5F5F5, #dadaee);display: flex;place-content: center;height:850px;justify-content: center;border-radius:15px;">
            <div style="width: calc(100% - 30px);background-color: white;height: fit-content;align-self: center;text-align: center;border-radius: 15px;padding-top: 50px;padding-bottom: 50px;place-content:center;max-width:600px;margin:auto;">

            <h1 style="color:black;font-family: sans-serif;">Nieuwe printopdracht</h1>

            <p style="color:black;margin-left:50px;margin-right:50px;font-family: sans-serif;">Er is een nieuwe printopdracht geplaatst. Bekijk de printopdracht in het dashboard.</p>

            <p style="color:black;margin-left:50px;margin-right:50px;font-family: sans-serif;"><b>Gegevens van de printopdracht:</b></p>

            <table style="margin:0 auto;font-family:sans-serif;">
                <tr>
                    <td style="padding:5px;text-align:left;">Printlayout:</td>
                    <td style="padding:5px;text-align:left;">' . $printLayout . '</td>
                </tr>
                <tr>
                    <td style="padding:5px;text-align:left;">Aantal exemplaren:</td>
                    <td style="padding:5px;text-align:left;">' . $printAmount . ' exempla' . ($printAmount == 1 ? "ar" : "ren") . '</td>
                </tr>
                <tr>
                    <td style="padding:5px;text-align:left;">Aantal pagina\'s:</td>
                    <td style="padding:5px;text-align:left;">' . $paperAmount . ' papier' . ($paperAmount == 1 ? "" : "en") . '</td>
                </tr>
                <tr>
                    <td style="padding:5px;text-align:left;">Dubbelzijdig/enkelzijdig:</td>
                    <td style="padding:5px;text-align:left;">' . ($doubleSided ? "Dubbelzijdig" : "Enkelzijdig") . '</td>
                </tr>
                <tr>
                    <td style="padding:5px;text-align:left;">Inktkleur:</td>
                    <td style="padding:5px;text-align:left;">' . ($printColor ? "Gekleurd" : "Zwart-wit") . '</td>
                </tr>
                <tr>
                    <td style="padding:5px;text-align:left;">Kleurprint kaft:</td>
                    <td style="padding:5px;text-align:left;">' . ($coverPrintColor ? "Ja" : "Nee") . '</td>
                </tr>
                <tr>
                    <td style="padding:5px;text-align:left;">Papierkleur:</td>
                    <td style="padding:5px;text-align:left;">' . ucfirst($paperColor) . '</td>
                </tr>
                <tr>
                    <td style="padding:5px;text-align:left;">Kleur papier kaft:</td>
                    <td style="padding:5px;text-align:left;">' . ucfirst($coverColor) . '</td>
                </tr>
                <tr>
                    <td style="padding:5px;text-align:left;">Gewicht papier:</td>
                    <td style="padding:5px;text-align:left;">' . $paperWeight . ' gram</td>
                </tr>
                <tr>
                    <td style="padding:5px;text-align:left;">Nietstatus:</td>
                    <td style="padding:5px;text-align:left;">' . ($staple == "geen" ? "Geen nietjes" : "Nietje " . $staple) . '</td>
                </tr>
                <tr>
                    <td style="padding:5px;text-align:left;">Aanvullende wensen:</td>
                    <td style="padding:5px;text-align:left;">' . ($additionalWishes ? $additionalWishes : "Geen aanvullende wensen") . '</td>
                </tr>
                <tr>
                    <td style="padding:5px;text-align:left;">Prijsindicatie:</td>
                    <td style="padding:5px;text-align:left;">€' . $minus10Percent . " - €" . $plus10Percent . '</td>
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