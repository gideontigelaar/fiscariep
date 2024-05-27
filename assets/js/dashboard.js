function submitPrintOrder(event) {
    event.preventDefault();

    var printLayout = document.getElementById('printLayout').value;
    var printAmount = document.getElementById('printAmount').value;
    var paperAmount = document.getElementById('paperAmount').value;
    var doubleSided = document.getElementById('doubleSided').checked ? 'true' : 'false';
    var printColor = document.getElementById('printColor').checked ? 'true' : 'false';
    var paperColor = document.getElementById('paperColor').value;
    var paperWeight = document.getElementById('paperWeight').value;
    var staple = document.getElementById('staple').checked ? 'true' : 'false';
    var uploadPrint = document.getElementById('uploadPrint').files[0];
    var additionalWishes = document.getElementById('additionalWishes').value;

    var formData = new FormData();
    formData.append('printLayout', printLayout);
    formData.append('printAmount', printAmount);
    formData.append('paperAmount', paperAmount);
    formData.append('doubleSided', doubleSided);
    formData.append('printColor', printColor);
    formData.append('paperColor', paperColor);
    formData.append('paperWeight', paperWeight);
    formData.append('staple', staple);
    formData.append('uploadPrint', uploadPrint);
    formData.append('additionalWishes', additionalWishes);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../../queries/submit-print-order.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                nextPopupStep('Gelukt!', 'Je hebt met succes een nieuwe printjob toegevoegd.');
            } else {
                var response = JSON.parse(xhr.responseText);
                showErrorMessage(xhr.status, response.error, 3);
            }
        }
    };
    xhr.send(formData);
}