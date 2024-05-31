function submitOnboardingForm() {
    let address = document.getElementById('address').value;
    let postal_code = document.getElementById('postal_code').value;
    let city = document.getElementById('city').value;
    let province = document.getElementById('province').value;
    let country = document.getElementById('country').value;
    let phone_number = document.getElementById('phone_number').value;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../../queries/update-user-info.php', true);
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
    xhr.send('address=' + address + '&postal_code=' + postal_code + '&city=' + city + '&province=' + province + '&country=' + country + '&phone_number=' + phone_number);
}