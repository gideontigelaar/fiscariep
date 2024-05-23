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
$stmt = $pdo->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES ((SELECT user_id FROM users WHERE email = :email), :token, DATE_ADD(NOW(), INTERVAL 1 HOUR))");
$stmt->execute(['email' => $email, 'token' => $token]);

$to = $email;
$subject = 'Wachtwoord herstellen | Fiscariep';
$message = '
<html>
    <head>
    </head>
    <body style="background: linear-gradient(#F5F5F5, #EAE5F6);display: flex;place-content: center;height:550px;justify-content: center;border-radius:15px;">
        <div style="width: calc(100% - 30px);background-color: white;height: fit-content;align-self: center;text-align: center;border-radius: 15px;padding-top: 50px;padding-bottom: 50px;place-content:center;max-width:600px;margin:auto;">
        <img src="https://projodyssey.partydoosmedia.com/src/png/OdysseyLogoSmall.png" style="width: 300px;">

        <h1 style="color:black;font-family: sans-serif;">Forgotten your password?</h1>

        <p style="color:black;margin-left:50px;margin-right:50px;font-family: sans-serif;">We have received a request to reset your password. If you did not make the request, just ignore this email. Otherwise, click the button below to reset your password!</p>

        <a href="https://projodyssey.partydoosmedia.com/reset-password?token=' . $token . '" style="text-decoration:none;"><button style="cursor:pointer;background-color: #552dc4;border: none;color: white;padding: 15px 32px;font-size: 16px;margin: 4px 2px;cursor: pointer;border-radius: 10px;">Reset Password</button></a>

        <p style="font-family:sans-serif;width:100%;text-align:center;opacity:40%;color: black;margin-top: 30px;margin-bottom:-10px;">This mail is sent out by Evapay, a PartydoosMedia brand.</p>
    </body>
</html>
';
$headers = 'From: noreply@fiscariep.idsosinga.nl' . "\r\n" .
    'Reply-To: noreply@fiscariep.idsosinga.nl' . "\r\n" .
    'Content-Type: text/html' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>