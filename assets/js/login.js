function toggleForm() {
    const loginForm = document.querySelector('.login-form');
    const registerForm = document.querySelector('.register-form');

    loginForm.classList.toggle('hidden');
    registerForm.classList.toggle('hidden');
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
                alert(response.error);
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
                alert(response.error);
            }
        }
    }
    xhr.send('username=' + username + '&email=' + email + '&password=' + password + '&confirmPassword=' + confirmPassword);
}