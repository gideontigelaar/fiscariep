<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiscariep</title>

    <link rel="stylesheet" href="../css/import.css">

    <script src="/assets/js/login.js"></script>
</head>

<body>
    <div class="auth_container">
        <div class="login-form auth_form">
            <div style="width:260px;" class="auth_form-left">
                <img src="../assets/svg/logo/fiscariep-logo-white-rgb.svg" alt="Fiscariep Logo">
            </div>
            <div style="width:50%;padding:50px;" class="auth_form-right">
                <h1>Login</h1>

                <div>
                    <div style="display:inline-grid;width:100%;">
                        <div class="auth_inputfield">
                            <label for="email">Email</label>
                            <input type="email" id="login-email">
                        </div>

                        <div class="auth_inputfield">
                            <label for="password">Password</label>
                            <input type="password" id="login-password">
                        </div>
                    </div>

                    <button class="but_primary" type="submit"onclick="loginUser()">Login</button>

                    <p style="text-align:center;opacity:70%;margin-top:20px;">Don't have an account? <a href="#" onclick="toggleForm()">Register</a></p>
                </div>
            </div>
        </div>

        <div class="register-form auth_form hidden">
            <div style="width:260px;" class="auth_form-left">
                <img src="../assets/svg/logo/fiscariep-logo-white-rgb.svg" alt="Fiscariep Logo">
            </div>
            <div style="width:50%;padding:50px;" class="auth_form-right">
                <h1>Register</h1>

                <div>
                    <div style="display:inline-grid;width:100%;">
                        <div class="auth_inputfield">
                            <label for="username">Username</label>
                            <input type="text" id="register-username">
                        </div>

                        <div class="auth_inputfield">
                            <label for="email">Email</label>
                            <input type="email" id="register-email">
                        </div>

                        <div style="display:flex;column-gap:10px">
                            <div class="auth_inputfield">
                                <label for="password">Password</label>
                                <input type="password" id="register-password">
                            </div>

                            <div class="auth_inputfield">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" id="register-password-confirm">
                            </div>
                        </div>
                    </div>

                    <p>Already have an account? <a href="#" onclick="toggleForm()">Login</a></p>

                    <button style="width: 100%;" class="but_primary" type="submit" onclick="registerUser()">Register</button>
                </div>
            </div>      
        </div>
        <span class="auth_copyright-text">Alle rechten voorbehouden.</span>
    </div>
</body>
</html>