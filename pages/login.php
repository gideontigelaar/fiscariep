<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiscariep</title>

    <link rel="stylesheet" href="../css/import.css">

    <script src="/assets/js/login.js"></script>
</head>

<body>
    <div class="container">
        <div class="login-form">
            <h1>Login</h1>

            <form action="login.php" method="post">
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="login-email" required>
                </div>

                <div>
                    <label for="password">Password</label>
                    <input type="password" id="login-password" required>
                </div>

                <p>Don't have an account? <a href="#" onclick="toggleForm()">Register</a></p>

                <button type="submit"onclick="loginUser()">Login</button>
            </form>
        </div>

        <div class="register-form hidden">
            <h1>Register</h1>

            <form action="register.php" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" id="register-username" required>
                </div>

                <div>
                    <label for="email">Email</label>
                    <input type="email" id="register-email" required>
                </div>

                <div>
                    <label for="password">Password</label>
                    <input type="password" id="register-password" required>
                </div>

                <div>
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="register-password-confirm" required>
                </div>

                <p>Already have an account? <a href="#" onclick="toggleForm()">Login</a></p>

                <button type="submit" onclick="registerUser()">Register</button>
            </form>
        </div>
    </div>
</body>
</html>