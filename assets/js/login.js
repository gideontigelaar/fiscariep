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
    let email = document.getElementById('login-email').value;
    let password = document.getElementById('login-password').value;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../../queries/login-user.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                location.reload();
            } else {
                let response = JSON.parse(xhr.responseText);
                showErrorMessage(xhr.status, response.error, 3);
            }
        }
    }
    xhr.send('email=' + email + '&password=' + password);
}

function registerUser() {
    let username = document.getElementById('register-username').value;
    let email = document.getElementById('register-email').value;
    let password = document.getElementById('register-password').value;
    let confirmPassword = document.getElementById('register-password-confirm').value;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../../queries/register-user.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                location.reload();
            } else {
                let response = JSON.parse(xhr.responseText);
                showErrorMessage(xhr.status, response.error, 3);
            }
        }
    }
    xhr.send('username=' + username + '&email=' + email + '&password=' + password + '&confirmPassword=' + confirmPassword);
}

function forgotPassword() {
    let email = document.getElementById('forgot-email').value;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../../queries/forgot-password.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                location.reload();
            } else {
                let response = JSON.parse(xhr.responseText);
                showErrorMessage(xhr.status, response.error, 3);
            }
        }
    }
    xhr.send('email=' + email);
}

function resetPassword(token) {
    let password = document.getElementById('reset-password').value;
    let confirmPassword = document.getElementById('reset-password-confirm').value;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../../queries/reset-password.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                window.location.href = '/login';
            } else {
                let response = JSON.parse(xhr.responseText);
                showErrorMessage(xhr.status, response.error, 3);
            }
        }
    }
    xhr.send('token=' + token + '&password=' + password + '&confirmPassword=' + confirmPassword);
}