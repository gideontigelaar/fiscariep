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

$email = strtolower($_POST['email']) ?? '';

if (empty($email)) {
    sendError('E-mailadres is verplicht.');
}

if (strlen($email) > 100 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    sendError('E-mailadres is niet geldig.');
}

$stmt = $pdo->prepare("SELECT email FROM users WHERE email = :email");
$stmt->execute(['email' => $email]);
if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
    sendSuccess();
}

$token = bin2hex(random_bytes(32));

$mail = new PHPMailer(true);

try {
    $stmt = $pdo->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES ((SELECT user_id FROM users WHERE email = :email), :token, DATE_ADD(NOW(), INTERVAL 1 HOUR))");
    $stmt->execute(['email' => $email, 'token' => $token]);

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
    $mail->Subject = 'Wachtwoord herstellen | Fiscariep';
    $mail->Body = '
    <html>
        <head>
        </head>
        <body style="background: linear-gradient(#F5F5F5, #dadaee);display: flex;place-content: center;height:550px;justify-content: center;border-radius:15px;">
            <div style="width: calc(100% - 30px);background-color: white;height: fit-content;align-self: center;text-align: center;border-radius: 15px;padding-top: 50px;padding-bottom: 50px;place-content:center;max-width:600px;margin:auto;">

            <h1 style="color:black;font-family: sans-serif;">Wachtwoord vergeten?</h1>

            <p style="color:black;margin-left:50px;margin-right:50px;font-family: sans-serif;">We hebben een verzoek ontvangen om jouw wachtwoord te resetten. Als je dit verzoek niet hebt gedaan, negeer dan deze e-mail. Klik anders op de onderstaande knop om je wachtwoord te resetten!</p>

            <a href="' . $_SERVER['HTTP_HOST'] . '/login?token=' . $token . '" style="text-decoration:none;"><button style="cursor:pointer;background-color: #2E3192;border: none;color: white;padding: 15px 32px;font-size: 16px;margin: 4px 2px;cursor: pointer;border-radius: 10px;">Wachtwoord resetten</button></a>

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