<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/queries/validate-session.php"; ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiscariep</title>

    <link rel="stylesheet" href="../css/import.css">

    <script src="/assets/js/login.js"></script>
    <script src="/assets/js/showError.js"></script>
</head>

<body>
    <div class="auth_container">
        <div class="login-form auth_form">
            <div style="width:260px;" class="auth_form-left">
                <img src="../assets/svg/logo/fiscariep-logo-white-rgb.svg" alt="Fiscariep Logo">
            </div>
            <div class="auth_form-right">
                <h1>Inloggen</h1>

                <div>
                    <div style="display:inline-grid;width:100%;">
                        <div class="auth_inputfield">
                            <label for="email">E-mail</label>
                            <input type="email" id="login-email">
                        </div>

                        <div class="auth_inputfield">
                            <label for="password">Wachtwoord</label>
                            <input type="password" id="login-password">
                        </div>
                    </div>

                    <button class="but_primary" type="submit" onclick="loginUser()">Inloggen</button>

                    <p style="text-align:center;opacity:70%;margin-top:20px;">Nog geen account? <a href="#" onclick="toggleForm()">Registreren</a></p>

                    <p style="opacity: 70%;text-align: center;line-height: 0;"><a href="#" onclick="togglePasswordForm()">Wachtwoord vergeten?</a></p>
                </div>
            </div>
        </div>

        <div class="register-form auth_form hidden">
            <div style="width:260px;" class="auth_form-left">
                <img src="../assets/svg/logo/fiscariep-logo-white-rgb.svg" alt="Fiscariep Logo">
            </div>
            <div class="auth_form-right">
                <h1>Registreren</h1>

                <div>
                    <div style="display:inline-grid;width:100%;">
                        <div class="auth_inputfield">
                            <label for="username">Gebruikersnaam</label>
                            <input type="text" id="register-username">
                        </div>

                        <div class="auth_inputfield">
                            <label for="email">E-mail</label>
                            <input type="email" id="register-email">
                        </div>

                        <div style="display:flex;column-gap:10px">
                            <div class="auth_inputfield">
                                <label for="password">Wachtwoord</label>
                                <input type="password" id="register-password">
                            </div>

                            <div class="auth_inputfield">
                                <label for="confirm_password">Bevestig <span class="hide-on-mobile">wachtwoord</span></label>
                                <input type="password" id="register-password-confirm">
                            </div>
                        </div>
                    </div>

                    <button style="width: 100%;" class="but_primary" type="submit" onclick="registerUser()">Registreren</button>

                    <p style="text-align:center;opacity:70%;margin-top:20px;">Al een account? <a href="#" onclick="toggleForm()">Inloggen</a></p>
                </div>
            </div>
        </div>

        <div class="forgot-password-form auth_form hidden">
            <div style="width:260px;" class="auth_form-left">
                <img src="../assets/svg/logo/fiscariep-logo-white-rgb.svg" alt="Fiscariep Logo">
            </div>
            <div class="auth_form-right">
                <h1>Wachtwoord vergeten</h1>

                <div>
                    <div style="display:inline-grid;width:100%;">
                        <div class="auth_inputfield">
                            <label for="email">E-mail</label>
                            <input type="email" id="forgot-email">
                        </div>
                    </div>

                    <button class="but_primary" type="submit" onclick="forgotPassword()">Verstuur</button>
                    <button style="margin-top: 25px;" onclick="togglePasswordForm()">Terug</button>
                </div>
            </div>
        </div>

        <span class="auth_copyright-text">Alle rechten voorbehouden.</span>
    </div>
</body>
</html>