function loadMonth(difference) {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../../queries/order-list.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                console.log(difference);
            }
        }
    }
    xhr.send('difference=' + difference);
}