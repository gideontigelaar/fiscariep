function submitPrintOrder(event) {
    event.preventDefault();

    let printLayout = document.getElementById('printLayout').value;
    let printAmount = document.getElementById('printAmount').value;
    let paperAmount = document.getElementById('paperAmount').value;
    let doubleSided = document.getElementById('doubleSided').checked ? 'true' : 'false';
    let printColor = document.getElementById('printColor').checked ? 'true' : 'false';
    let coverPrintColor = document.getElementById('coverPrintColor').checked ? 'true' : 'false';
    let paperColor = document.getElementById('paperColor').value;
    let coverColor = document.getElementById('coverColor').value;
    let paperWeight = document.getElementById('paperWeight').value;
    let staple = document.getElementById('staple').value;
    let uploadPrint = document.getElementById('uploadPrint').files[0];
    let additionalWishes = document.getElementById('additionalWishes').value;
    let totalPrice = document.getElementById('priceAmount').innerHTML;

    let formData = new FormData();
    formData.append('printLayout', printLayout);
    formData.append('printAmount', printAmount);
    formData.append('paperAmount', paperAmount);
    formData.append('doubleSided', doubleSided);
    formData.append('printColor', printColor);
    formData.append('coverPrintColor', coverPrintColor);
    formData.append('paperColor', paperColor);
    formData.append('coverColor', coverColor);
    formData.append('paperWeight', paperWeight);
    formData.append('staple', staple);
    formData.append('uploadPrint', uploadPrint);
    formData.append('additionalWishes', additionalWishes);
    formData.append('totalPrice', totalPrice);

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../../queries/submit-print-order.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                nextPopupStep('Gelukt!', 'Je hebt met succes een nieuwe printjob toegevoegd.', 'general-success');
            } else {
                let response = JSON.parse(xhr.responseText);
                showErrorMessage(xhr.status, response.error, 3);
            }
        }
    };
    xhr.send(formData);
}