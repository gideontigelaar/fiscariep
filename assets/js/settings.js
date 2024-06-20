function updateSettings() {
    let username = document.getElementById('username').value;
    let email = document.getElementById('email').value;
    let address = document.getElementById('address').value;
    let postal_code = document.getElementById('postal_code').value;
    let city = document.getElementById('city').value;
    let province = document.getElementById('province').value;
    let country = document.getElementById('country').value;
    let phone_number = document.getElementById('phone_number').value;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../../queries/update-settings.php', true);
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
    xhr.send('username=' + username + '&email=' + email + '&address=' + address + '&postal_code=' + postal_code + '&city=' + city + '&province=' + province + '&country=' + country + '&phone_number=' + phone_number);
}

function changePassword() {
    let oldPassword = document.getElementById('oldPassword').value;
    let newPassword = document.getElementById('newPassword').value;
    let confirmPassword = document.getElementById('confirmPassword').value;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../../queries/change-password.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                removePopupContainer();
                nextPopupStep('Gelukt!', 'Je wachtwoord is succesvol gewijzigd.', 'general-success');
            } else {
                let response = JSON.parse(xhr.responseText);
                showErrorMessage(xhr.status, response.error, 3);
            }
        }
    }
    xhr.send('oldPassword=' + oldPassword + '&newPassword=' + newPassword + '&confirmPassword=' + confirmPassword);
}

function updatePricelist() {
    let printLayout1 = document.getElementById('printLayout1').value;
    let printLayout2 = document.getElementById('printLayout2').value;
    let printLayout3 = document.getElementById('printLayout3').value;
    let printLayout4 = document.getElementById('printLayout4').value;
    let printLayout5 = document.getElementById('printLayout5').value;
    let printAmount = document.getElementById('printAmount').value;
    let paperAmount = document.getElementById('paperAmount').value;
    let doubleSided = document.getElementById('doubleSided').value;
    let printColor = document.getElementById('printColor').value;
    let coverPrintColor = document.getElementById('coverPrintColor').value;
    let paperColor = document.getElementById('paperColor').value;
    let coverColor = document.getElementById('coverColor').value;
    let paperWeight = document.getElementById('paperWeight').value;
    let stapledPrint = document.getElementById('stapledPrint').value;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../../queries/update-pricelist.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                removePopupContainer()
                nextPopupStep('Gelukt!', 'De prijslijst is nu gewijzigd.', 'general-success');
            } else {
                let response = JSON.parse(xhr.responseText);
                showErrorMessage(xhr.status, response.error, 3);
            }
        }
    }
    xhr.send('printLayout1=' + printLayout1 + '&printLayout2=' + printLayout2 + '&printLayout3=' + printLayout3 + '&printLayout4=' + printLayout4 + '&printLayout5=' + printLayout5 + '&printAmount=' + printAmount + '&paperAmount=' + paperAmount + '&doubleSided=' + doubleSided + '&printColor=' + printColor + '&coverPrintColor=' + coverPrintColor + '&paperColor=' + paperColor + '&coverColor=' + coverColor + '&paperWeight=' + paperWeight + '&stapledPrint=' + stapledPrint);
}