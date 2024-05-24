function updateSettings() {
    var username = document.getElementById('username').value;
    var email = document.getElementById('email').value;
    var address = document.getElementById('address').value;
    var postal_code = document.getElementById('postal_code').value;
    var city = document.getElementById('city').value;
    var province = document.getElementById('province').value;
    var country = document.getElementById('country').value;
    var phone_number = document.getElementById('phone_number').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../../queries/update-settings.php', true);
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
    xhr.send('username=' + username + '&email=' + email + '&address=' + address + '&postal_code=' + postal_code + '&city=' + city + '&province=' + province + '&country=' + country + '&phone_number=' + phone_number);
}

function changePassword() {
    var oldPassword = document.getElementById('oldPassword').value;
    var newPassword = document.getElementById('newPassword').value;
    var confirmPassword = document.getElementById('confirmPassword').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../../queries/change-password.php', true);
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
    xhr.send('oldPassword=' + oldPassword + '&newPassword=' + newPassword + '&confirmPassword=' + confirmPassword);
}