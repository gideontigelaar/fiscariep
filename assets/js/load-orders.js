function changeMonth(delta) {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../../queries/order-list.php', true);
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
    xhr.send('delta=' + delta);
}