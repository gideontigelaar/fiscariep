function toggleForm() {
    const loginForm = document.querySelector('.login-form');
    const registerForm = document.querySelector('.register-form');

    loginForm.classList.toggle('hidden');
    registerForm.classList.toggle('hidden');
}

function togglePasswordForm() {
    const loginForm = document.querySelector('.login-form');
    const forgotPasswordForm = document.querySelector('.forgot-password-form');

    loginForm.classList.toggle('hidden');
    forgotPasswordForm.classList.toggle('hidden');
}

function loginUser() {
    var email = document.getElementById('login-email').value;
    var password = document.getElementById('login-password').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../../queries/login-user.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                location.reload();
            } else {
                var response = JSON.parse(xhr.responseText);
                showErrorMessage(xhr.status, response.error, 3);
            }
        }
    }
    xhr.send('email=' + email + '&password=' + password);
}

function registerUser() {
    var username = document.getElementById('register-username').value;
    var email = document.getElementById('register-email').value;
    var password = document.getElementById('register-password').value;
    var confirmPassword = document.getElementById('register-password-confirm').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../../queries/register-user.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                location.reload();
            } else {
                var response = JSON.parse(xhr.responseText);
                showErrorMessage(xhr.status, response.error, 3);
            }
        }
    }
    xhr.send('username=' + username + '&email=' + email + '&password=' + password + '&confirmPassword=' + confirmPassword);
}

function forgotPassword() {
    var email = document.getElementById('forgot-email').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../../queries/forgot-password.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                location.reload();
            } else {
                var response = JSON.parse(xhr.responseText);
                showErrorMessage(xhr.status, response.error, 3);
            }
        }
    }
    xhr.send('email=' + email);
}

function resetPassword(token) {
    var password = document.getElementById('reset-password').value;
    var confirmPassword = document.getElementById('reset-password-confirm').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../../queries/reset-password.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                window.location.href = '/login';
            } else {
                var response = JSON.parse(xhr.responseText);
                showErrorMessage(xhr.status, response.error, 3);
            }
        }
    }
    xhr.send('token=' + token + '&password=' + password + '&confirmPassword=' + confirmPassword);
}